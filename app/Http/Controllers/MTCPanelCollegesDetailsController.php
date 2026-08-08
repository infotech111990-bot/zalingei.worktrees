<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\College;
use App\CollegeDetails;

class MTCPanelCollegesDetailsController extends Controller
{

    private $view;
    private $folder;
    private $model;
    private $paginate;
    private $privName;
    private $parentModel;
    private $parent_id;

    public function __construct(){
        $this->view = 'mtCPanel.colleges.details';
        $this->route = 'mtCPanel.colleges.details';
        $this->model = new CollegeDetails;
        $this->folder = '/includes/colleges/details';
        $this->paginate = 25;
        $this->privName = 'details';
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
        $data = $this->payload($request, $parent_id);
        $data['college_id'] = $parent_id;

        // A college has one academic profile.  Updating it here prevents
        // conflicting dean messages and duplicate public records.
        $data = $this->model->updateOrCreate(['college_id' => $parent_id], $data);
        return redirect()->route($this->view.'.index',['parent_id'=>$parent_id])->withInput(['added' => true, 'id' => $data->id]);

    }

    // ------------------------------- Edit Action ----------------------------------------------
    public function update(Request $request, $parent_id = null, $id = null){
        $rules = $this->rules();

        $validator = Validator::make($request->all(), $rules)->validate();
        // dd($request->all());
        $data = $this->payload($request, $parent_id);

        $this->model->where('college_id', $parent_id)->findOrFail($id)->update($data);
        return redirect()->route($this->view.'.show',['parent_id'=>$parent_id, 'id'=>$id])->withInput(['updated' => true]);

    }

    private function rules(): array
    {
        return [
            'dean_name' => 'nullable|string|max:255',
            'dean_name_en' => 'nullable|string|max:255',
            'dean_title' => 'nullable|string|max:255',
            'dean_title_en' => 'nullable|string|max:255',
            'dean_email' => 'nullable|email|max:255',
            'dean_picture' => 'nullable|image|max:4096',
            'dean_bio' => 'nullable|string',
            'dean_bio_en' => 'nullable|string',
        ];
    }

    private function payload(Request $request, $collegeId): array
    {
        $data = $request->except(['_token', '_method', 'dean_picture']);
        if ($request->hasFile('dean_picture')) {
            $folder = public_path('includes/colleges/deans');
            if (!is_dir($folder)) {
                mkdir($folder, 0755, true);
            }
            $file = $request->file('dean_picture');
            $filename = $collegeId . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($folder, $filename);
            $data['dean_picture'] = $filename;
        }
        return $data;
    }

    // ------------------------------- Delete Action ----------------------------------------------
    public function destroy(Request $request, $parent_id = null, $id = null){
        $data = $this->model->where('college_id', $parent_id)->findOrFail($id);
        $data->delete();
        return redirect()->route($this->view.'.index', ['college' => $parent_id])->withInput(['deleted' => true]);
    }

    // ------------------------------- Dropzone ----------------------------------------------
    public function dropzone(Request $request){
        $id = $request->input('id');
        $data = $this->model->find($id);
        $response = [];
        if(isset($data->picture)){
            $response = [
                [
                    'name' => $data->picture,
                    'path' => $data->getPicture(),
                    'size' => filesize(public_path($this->folder.$data->picture))
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
        $data->picture = null;
        $data->save();

       exit;
    }

}
