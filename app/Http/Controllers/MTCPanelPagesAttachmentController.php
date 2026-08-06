<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Storge;
use Response;
use App\Page;
use App\PageAttachment;

class MTCPanelPagesAttachmentController extends Controller
{

    private $view;
    private $folder;
    private $model;
    private $paginate;
    private $privName;
    private $parentModel;
    private $parent_id;

    public function __construct(){
        $this->view = 'mtCPanel.pages.attachments';
        $this->route = 'mtCPanel.pages.attachments';
        $this->model = new PageAttachment;
        $this->folder = '/includes/pageAttachments/';
        $this->paginate = 25;
        $this->privName = 'pages';
        $this->parentModel = new Page;
   }

    // ------------------------------- Main View ----------------------------------------------
    public function index($parent_id = null){

        $privName = $this->privName;
        $model    = $this->model;
        
        if(auth()->guard('admin')->user()->hasListPriv($privName)){
            $privArray = auth()->guard('admin')->user()->getListPriv($privName);
            $privText = implode(',',$privArray);
            $model = $model->whereRaw('id IN ('.$privText.')');
        }
        
        $model  = $model->where('page_id', $parent_id);
        $parent = $this->parentModel->find($parent_id);
        $data   = $model->orderBy('id','desc')->paginate($this->paginate);
        
        return view($this->view.'.index', ['data' => $data, 'parent' => $parent]);
    }

    // ------------------------------- Display View ----------------------------------------------
    public function show($parent_id = null, $id = null){
        $data = $this->model->findOrFail($id);
        return view($this->view.'.display',['data'=>$data]);  
    }

    // ------------------------------- Add View ----------------------------------------------
    public function create($parent_id = null){
        $parent = $this->parentModel->find($parent_id);
        return view($this->view.'.create', ['parent' => $parent]);
    }

    // ------------------------------- Edit View ----------------------------------------------
    public function edit($parent_id = null, $id = null){
        $data = $this->model->findOrFail($id);
        return view($this->view.'.edit',['data'=>$data]);        
    }

    // ------------------------------- Add Action ----------------------------------------------
    public function store(Request $request, $parent_id = null){
        
        $rules = [
            'title' => 'required|max:255',
        ];

        $validator = Validator::make($request->all(), $rules)->validate();
        // dd($request->all());
        $data = [
            'page_id'  => $parent_id,
            'title'   => $request->input('title'),
            'title_en' => $request->input('title_en'),
            'desc'    => $request->input('desc'),
            'desc_en'  => $request->input('desc_en'),
            'url'     => $request->input('url'),
            'ext'     => $request->input('ext'),
            'publish' => $request->input('publish'),
        ];

        $data = $this->model->create( $data );
        return redirect()->route($this->view.'.index',['parent_id'=>$parent_id])->withInput(['added' => true, 'id' => $data->id]);

    }

    // ------------------------------- Edit Action ----------------------------------------------
    public function update(Request $request, $parent_id = null, $id = null){
        $rules = [
            'title' => 'required|max:255',
        ];

        $validator = Validator::make($request->all(), $rules)->validate();
        // dd($request->all());
        $data = [
            'id'      => $id,
            'page_id'  => $parent_id,
            'title'   => $request->input('title'),
            'title_en' => $request->input('title_en'),
            'desc'    => $request->input('desc'),
            'desc_en'  => $request->input('desc_en'),
            'url'     => $request->input('url'),
            'ext'     => $request->input('ext'),
            'publish' => $request->input('publish'),
        ];

        $this->model->findOrFail( $id )->update( $data );
        return redirect()->route($this->view.'.show',['parent_id'=>$parent_id, 'id'=>$id])->withInput(['updated' => true]);

    }

    // ------------------------------- Delete Action ----------------------------------------------
    public function destroy(Request $request, $parent_id = null, $id = null){
        $data = $this->model->findOrFail( $id );
        $data->delete();
        return redirect()->route($this->view.'.index', ['parent_id'=>$this->parent_id])->withInput(['deleted' => true])->status(200);
    }

    // ------------------------------- Dropzone ----------------------------------------------
    public function dropzone(Request $request){
        $id = $request->input('id');
        $data = $this->model->find($id);
        $response = [];
        if(isset($data->pdf)){
            $response = [
                [
                    'name' => $data->pdf,
                    'path' => $data->getPdf(),
                    'size' => filesize(public_path($this->folder.$data->pdf))
                ]
            ];
        }
        return json_encode($response);
    }

     // ------------------------------- Dropzone ----------------------------------------------
     public function dropzoneRemove(Request $request){
        $id = $request->input('id');
        $file_name = $request->input('name');
        $file = public_path($this->folder.$file_name);
        unlink($file);
        
        $data = $this->model->find($id);
        $data->pdf = null;
        $data->save();

       exit;
    }

}
