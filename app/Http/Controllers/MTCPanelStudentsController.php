<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Student;
use App\StudentResult;
use App\College;

class MTCPanelStudentsController extends Controller
{

    private $view;
    private $folder;
    private $model;
    private $paginate;
    private $privName;

    public function __construct(){
        $this->view = 'mtCPanel.students';
        $this->route = 'mtCPanel.students';
        $this->model = new Student;
        $this->folder = '/includes/students/';
        $this->paginate = 25;
        $this->privName = 'students';
    }

    // ------------------------------- Main View ----------------------------------------------
    public function index(){
        
        $privName = $this->privName;
        $model = $this->model;
        
        if(auth()->guard('admin')->user()->hasListPriv($privName)){
            $privArray = auth()->guard('admin')->user()->getListPriv($privName);
            $privText = implode(',',$privArray);
            $model = $model->whereRaw('id IN ('.$privText.')');
        }
        
        $data = $model->orderBy('id','desc')->paginate($this->paginate);
        
        return view($this->view.'.index', ['data' => $data]);
    }

    // ------------------------------- Display View ----------------------------------------------
    public function show($id = null){
        $data = $this->model->findOrFail($id);
        $results = StudentResult::where('student_number', $data->student_number)->get();
        return view($this->view.'.display',['data'=>$data, 'results'=>$results]);  
    }

    // ------------------------------- Add View ----------------------------------------------
    public function create(){
        $colleges = College::orderBy('name_ar','asc')->get();
        return view($this->view.'.create', compact('colleges'));
    }

    // ------------------------------- Edit View ----------------------------------------------
    public function edit($id = null){
        $data = $this->model->findOrFail($id);
        $colleges = College::orderBy('name_ar','asc')->get();
        return view($this->view.'.edit',['data'=>$data, 'colleges'=>$colleges]);        
    }

    // ------------------------------- Add Action ----------------------------------------------
    public function store(Request $request){
        
        $rules = [
            'student_number' => 'required|max:50|unique:students,student_number',
            'name_ar' => 'required|max:255',
        ];

        $validator = Validator::make($request->all(), $rules)->validate();
        $data = $request->all();

        $data = $this->model->create( $data );
        return redirect()->route($this->view.'.index')->withInput(['added' => true, 'id' => $data->id]);

    }

    // ------------------------------- Edit Action ----------------------------------------------
    public function update(Request $request, $id = null){

        $rules = [
            'student_number' => 'required|max:50|unique:students,student_number,'.$id,
            'name_ar' => 'required|max:255',
        ];

        $validator = Validator::make($request->all(), $rules)->validate();
        $data = $request->all();

        $this->model->findOrFail( $id )->update( $data );
                
        return redirect()->route($this->view.'.show',['id'=>$id])->withInput(['updated' => true]);

    }

    // ------------------------------- Delete Action ----------------------------------------------
    public function destroy(Request $request, $id = null){      

        $data = $this->model->findOrFail( $id );
        $data->delete();
        return redirect()->route($this->view.'.index')->withInput(['deleted' => true])->status(200);
    }

    // ------------------------------- Student Results Management ----------------------------------------------
    public function results($id = null){
        $student = $this->model->findOrFail($id);
        $results = StudentResult::where('student_number', $student->student_number)->orderBy('semester','asc')->orderBy('subject_name','asc')->get();
        return view($this->view.'.results',['student'=>$student, 'results'=>$results]);
    }

    public function addResult(Request $request, $id = null){
        $student = $this->model->findOrFail($id);

        $admin = auth()->guard('admin')->user();

        // Enforce college-scoped RBAC: only admins assigned to the student's college (or DBA) can add results
        if(!$admin->isDBA() && !$admin->hasCollegeAccess($student->college_id)){
            abort(403, 'You are not authorized to add results for this college.');
        }

        // Enforce results period
        if(!$admin->isDBA() && !\App\Period::isOpen('results', $student->college_id)){
            return redirect()->back()->with('error', 'Results period is currently closed.');
        }
        
        $rules = [
            'subject_name' => 'required|max:255',
            'marks' => 'nullable|numeric',
            'grade' => 'nullable|max:10',
            'semester' => 'nullable|max:100',
        ];

        $validator = Validator::make($request->all(), $rules)->validate();
        
        StudentResult::create([
            'student_number' => $student->student_number,
            'subject_name' => $request->subject_name,
            'marks' => $request->marks,
            'grade' => $request->grade,
            'semester' => $request->semester,
        ]);

        return redirect()->route($this->view.'.results',['id'=>$id])->withInput(['added' => true]);
    }

    public function deleteResult(Request $request, $id = null){
        $result = StudentResult::findOrFail($id);
        $student = Student::where('student_number', $result->student_number)->first();

        $admin = auth()->guard('admin')->user();

        if($student){
            // Enforce college-scoped RBAC
            if(!$admin->isDBA() && !$admin->hasCollegeAccess($student->college_id)){
                abort(403, 'You are not authorized to delete results for this college.');
            }

            // Enforce results period
            if(!$admin->isDBA() && !\App\Period::isOpen('results', $student->college_id)){
                return redirect()->back()->with('error', 'Results period is currently closed.');
            }
        }

        $result->delete();
        if($student){
            return redirect()->route($this->view.'.results',['id'=>$student->id])->withInput(['deleted' => true]);
        }
        return redirect()->route($this->view.'.index');
    }

}