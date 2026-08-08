<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\College;
use App\CollegesNews;

class MTCPanelCollegesNewsController extends Controller
{

    private $view;
    private $folder;
    private $model;
    private $paginate;
    private $privName;
    private $parentModel;
    private $parent_id;

    public function __construct(){
        $this->view = 'mtCPanel.colleges.news';
        $this->route = 'mtCPanel.colleges.news';
        $this->model = new CollegesNews;
        $this->folder = '/includes/colleges/news';
        $this->paginate = 25;
        $this->privName = 'news';
        $this->parentModel = new College;
   }

    // ------------------------------- Main View ----------------------------------------------
    public function index($parent_id = null){

        $privName = $this->privName;
        $model = $this->model;
        
        // if(auth()->guard('admin')->user()->hasListPriv($privName)){
        //     $privArray = auth()->guard('admin')->user()->getListPriv($privName);
        //     $privText = implode(',',$privArray);
        //     $model = $model->whereRaw('id IN ('.$privText.')');
        // }
        
        $model = $model->where('college_id', $parent_id);
        $parent = $this->parentModel->find($parent_id);
        $data = $model->orderBy('id','desc')->paginate($this->paginate);
        
        return view($this->view.'.index', ['data' => $data, 'parent' => $parent]);
    }

    // ------------------------------- Display View ----------------------------------------------
    public function show($parent_id = null, $id = null){
        $data = $this->model->where('college_id', $parent_id)->findOrFail($id);
        return view($this->view.'.display',['data'=>$data]);  
    }

    // ------------------------------- Add View ----------------------------------------------
    public function create($parent_id = null){
        $parent = $this->parentModel->find($parent_id);
        return view($this->view.'.create', ['parent' => $parent]);
    }

    // ------------------------------- Edit View ----------------------------------------------
    public function edit($parent_id = null, $id = null){
        $data = $this->model->where('college_id', $parent_id)->findOrFail($id);
        return view($this->view.'.edit',['data'=>$data]);        
    }

    // ------------------------------- Add Action ----------------------------------------------
    public function store(Request $request, $parent_id = null){
        $rules = $this->rules();

        $validator = Validator::make($request->all(), $rules)->validate();
        // dd($request->all());
        $data = $this->payload($request);
        $data['college_id'] = $parent_id;

        $data = $this->model->create( $data );
        return redirect()->route($this->view.'.index',['college'=>$parent_id])->withInput(['added' => true, 'id' => $data->id]);

    }

    // ------------------------------- Edit Action ----------------------------------------------
    public function update(Request $request, $parent_id = null, $id = null){
        $rules = $this->rules();

        $validator = Validator::make($request->all(), $rules)->validate();
        // dd($request->all());
        $data = $this->payload($request);

        $this->model->where('college_id', $parent_id)->findOrFail($id)->update($data);
        return redirect()->route($this->view.'.show',['college'=>$parent_id, 'news'=>$id])->withInput(['updated' => true]);

    }

    // ------------------------------- Delete Action ----------------------------------------------
    public function destroy(Request $request, $parent_id = null, $id = null){
        $data = $this->model->where('college_id', $parent_id)->findOrFail($id);
        $data->delete();
        return redirect()->route($this->view.'.index', ['college'=>$parent_id])->withInput(['deleted' => true]);
    }

    // ------------------------------- Dropzone ----------------------------------------------
    public function dropzone(Request $request){
        $id = $request->input('id');
        $data = $this->model->findOrFail($id);
        $response = [];
        if(isset($data->picture)){
            $response = [
                [
                    'name' => $data->picture,
                    'path' => $data->getPicture(),
                    'size' => $this->pictureSize($data)
                ]
            ];
        }
        return json_encode($response);
    }

     // ------------------------------- Dropzone ----------------------------------------------
     public function dropzoneRemove(Request $request){
        $id = $request->input('id');
        $file_name = $request->input('name');
        $data = $this->model->findOrFail($id);
        $file = public_path('includes/colleges/'.$data->college_id.'/news/'.$file_name);
        if (is_file($file)) {
            unlink($file);
        }
        
        $data->picture = null;
        $data->save();

        return response()->json(['success' => true]);
    }

    private function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'txt' => 'nullable|string',
            'news_date' => 'required|date',
            'lang' => 'nullable|in:1,2',
            'picture' => 'nullable|string|max:255',
        ];
    }

    private function payload(Request $request): array
    {
        $data = [
            'newsDate' => $request->input('news_date'),
            'picture' => $request->input('picture'),
        ];

        // The legacy database keeps Arabic and English in separate columns;
        // the old form sent non-existent `lang` and `news_date` columns.
        if ((int) $request->input('lang', 1) === 2) {
            $data['titleEn'] = $request->input('title');
            $data['txtEn'] = $request->input('txt');
        } else {
            $data['title'] = $request->input('title');
            $data['txt'] = $request->input('txt');
        }

        return $data;
    }

    private function pictureSize(CollegesNews $news): int
    {
        $path = public_path('includes/colleges/'.$news->college_id.'/news/'.$news->picture);
        return is_file($path) ? filesize($path) : 0;
    }

}
