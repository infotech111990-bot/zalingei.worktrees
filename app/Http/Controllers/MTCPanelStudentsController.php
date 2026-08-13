<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Validator;
use App\Student;
use App\StudentResult;
use App\College;
use App\CollegesDepartments;

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

    public function index(){
        $privName = $this->privName;
        $model = $this->model->with(['college', 'department']);

        if(auth()->guard('admin')->user()->hasListPriv($privName)){
            $privArray = auth()->guard('admin')->user()->getListPriv($privName);
            $privText = implode(',',$privArray);
            $model = $model->whereRaw('id IN ('.$privText.')');
        }

        $data = $model->orderBy('id','desc')->paginate($this->paginate);
        return view($this->view.'.index', ['data' => $data]);
    }

    public function show($id = null){
        $data = $this->model->with(['college', 'department'])->findOrFail($id);
        $results = StudentResult::where('student_number', $data->student_number)->get();
        return view($this->view.'.display',['data'=>$data, 'results'=>$results]);
    }

    public function create(){
        $colleges = College::orderBy('name_ar','asc')->get();
        return view($this->view.'.create', compact('colleges'));
    }

    public function edit($id = null){
        $data = $this->model->with(['college', 'department'])->findOrFail($id);
        $colleges = College::orderBy('name_ar','asc')->get();
        return view($this->view.'.edit',['data'=>$data, 'colleges'=>$colleges]);
    }

    public function store(Request $request){
        $rules = [
            'student_number' => 'required|max:50|unique:students,student_number',
            'name_ar' => 'required|max:255',
        ];

        $validator = Validator::make($request->all(), $rules)->validate();
        $data = $request->all();
        $data = $this->model->create($data);
        return redirect()->route($this->view.'.index')->withInput(['added' => true, 'id' => $data->id]);
    }

    public function update(Request $request, $id = null){
        $rules = [
            'student_number' => 'required|max:50|unique:students,student_number,'.$id,
            'name_ar' => 'required|max:255',
        ];

        $validator = Validator::make($request->all(), $rules)->validate();
        $data = $request->all();
        $this->model->findOrFail($id)->update($data);
        return redirect()->route($this->view.'.show',['id'=>$id])->withInput(['updated' => true]);
    }

    public function destroy(Request $request, $id = null){
        $data = $this->model->findOrFail($id);
        $data->delete();
        return redirect()->route($this->view.'.index')->withInput(['deleted' => true])->status(200);
    }

    // ------------------------------- Student Import ----------------------------------------------

    public function importForm()
    {
        $colleges = College::orderBy('name_ar')->get();
        return view($this->view.'.import', compact('colleges'));
    }

    public function importPreview(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:csv,txt,xlsx', 'max:10240'],
        ]);

        $file = $request->file('file');
        $extension = strtolower($file->getClientOriginalExtension());
        $token = (string) Str::uuid();
        $path = $file->storeAs('student-imports', $token.'.'.$extension, 'local');

        try {
            $rows = $this->parseStudentImportFile($path, $extension);
            $validated = $this->validateStudentImportRows($rows);

            session([
                'student_import_token' => $token,
                'student_import_extension' => $extension,
                'student_import_rows' => $validated['rows'],
                'student_import_errors' => $validated['errors'],
            ]);

            return view($this->view.'.import-preview', [
                'rows' => $validated['rows'],
                'errors' => $validated['errors'],
                'token' => $token,
            ]);
        } catch (\Throwable $e) {
            Storage::disk('local')->delete($path);
            return redirect()->back()->withInput()->withErrors(['file' => $e->getMessage()]);
        }
    }

    public function importStore(Request $request)
    {
        $token = (string) $request->input('token');
        abort_unless($token !== '' && hash_equals((string) session('student_import_token'), $token), 419);

        $rows = session('student_import_rows', []);
        $errors = session('student_import_errors', []);
        abort_if(empty($rows), 422, 'No valid rows are available for import.');

        if (!empty($errors)) {
            return redirect()->route('mtCPanel.students.import')
                ->withErrors(['file' => 'Please correct all validation errors before importing the file.']);
        }

        $created = 0;
        $updated = 0;

        DB::transaction(function () use ($rows, &$created, &$updated) {
            foreach ($rows as $row) {
                $student = Student::where('student_number', $row['student_number'])->first();
                $payload = collect($row)->only([
                    'student_number', 'national_id', 'name_ar', 'name_en', 'email', 'phone',
                    'college_id', 'department_id', 'academic_year', 'level',
                ])->all();

                if ($student) {
                    $student->update($payload);
                    $updated++;
                } else {
                    $student = Student::create($payload + ['status' => 1]);
                    $created++;
                }
            }
        });

        $extension = (string) session('student_import_extension');
        $path = 'student-imports/'.$token.'.'.$extension;
        Storage::disk('local')->delete($path);
        session()->forget([
            'student_import_token',
            'student_import_extension',
            'student_import_rows',
            'student_import_errors',
        ]);

        return redirect()->route($this->view.'.index')
            ->with('success', "Student import completed. Created: {$created}, Updated: {$updated}.");
    }

    private function parseStudentImportFile(string $path, string $extension): array
    {
        $absolutePath = Storage::disk('local')->path($path);

        if ($extension === 'csv' || $extension === 'txt') {
            $handle = fopen($absolutePath, 'r');
            if (!$handle) {
                throw new \RuntimeException('Unable to open the uploaded CSV file.');
            }

            $headers = fgetcsv($handle);
            if (!$headers) {
                fclose($handle);
                throw new \RuntimeException('The CSV file is empty.');
            }

            $headers = array_map([$this, 'normalizeImportHeader'], $headers);
            $rows = [];
            while (($values = fgetcsv($handle)) !== false) {
                if (count(array_filter($values, fn($v) => trim((string) $v) !== '')) === 0) {
                    continue;
                }
                $row = [];
                foreach ($headers as $i => $header) {
                    if ($header !== '') {
                        $row[$header] = trim((string) ($values[$i] ?? ''));
                    }
                }
                $rows[] = $row;
            }
            fclose($handle);
            return $rows;
        }

        if ($extension !== 'xlsx') {
            throw new \RuntimeException('Only CSV and XLSX files are supported.');
        }

        if (!class_exists('ZipArchive')) {
            throw new \RuntimeException('XLSX import requires the PHP Zip extension on the server.');
        }

        $zip = new \ZipArchive();
        if ($zip->open($absolutePath) !== true) {
            throw new \RuntimeException('Unable to read the XLSX file.');
        }

        $sharedStrings = [];
        $sharedXml = $zip->getFromName('xl/sharedStrings.xml');
        if ($sharedXml !== false) {
            $xml = simplexml_load_string($sharedXml);
            if ($xml !== false) {
                $ns = $xml->children('http://schemas.openxmlformats.org/spreadsheetml/2006/main');
                foreach ($ns->si as $item) {
                    $text = '';
                    foreach ($item->children('http://schemas.openxmlformats.org/spreadsheetml/2006/main')->t as $t) {
                        $text .= (string) $t;
                    }
                    $sharedStrings[] = $text;
                }
            }
        }

        $sheetXml = $zip->getFromName('xl/worksheets/sheet1.xml');
        $zip->close();
        if ($sheetXml === false) {
            throw new \RuntimeException('The first worksheet could not be read.');
        }

        $xml = simplexml_load_string($sheetXml);
        if ($xml === false) {
            throw new \RuntimeException('The XLSX worksheet is invalid.');
        }

        $mainNs = 'http://schemas.openxmlformats.org/spreadsheetml/2006/main';
        $sheet = $xml->children($mainNs);
        $rawRows = [];
        foreach ($sheet->sheetData->row as $rowXml) {
            $values = [];
            foreach ($rowXml->c as $cell) {
                $attrs = $cell->attributes();
                $ref = (string) ($attrs['r'] ?? '');
                preg_match('/([A-Z]+)\\d+/', $ref, $match);
                $column = $match[1] ?? '';
                $index = $this->excelColumnIndex($column);
                $type = (string) ($attrs['t'] ?? '');
                $value = isset($cell->v) ? (string) $cell->v : '';
                if ($type === 's') {
                    $value = $sharedStrings[(int) $value] ?? '';
                } elseif ($type === 'inlineStr') {
                    $value = isset($cell->is->t) ? (string) $cell->is->t : '';
                }
                $values[$index] = trim($value);
            }
            if (!empty($values)) {
                ksort($values);
                $rawRows[] = array_values($values);
            }
        }

        if (empty($rawRows)) {
            throw new \RuntimeException('The XLSX file is empty.');
        }

        $headers = array_map([$this, 'normalizeImportHeader'], array_shift($rawRows));
        $rows = [];
        foreach ($rawRows as $values) {
            $row = [];
            foreach ($headers as $i => $header) {
                if ($header !== '') {
                    $row[$header] = trim((string) ($values[$i] ?? ''));
                }
            }
            if (count(array_filter($row, fn($v) => $v !== '')) > 0) {
                $rows[] = $row;
            }
        }
        return $rows;
    }

    private function normalizeImportHeader($header): string
    {
        $header = trim(mb_strtolower((string) $header));
        $aliases = [
            'student number' => 'student_number', 'student_number' => 'student_number', 'رقم الطالب' => 'student_number',
            'national id' => 'national_id', 'national_id' => 'national_id', 'الرقم الوطني' => 'national_id',
            'name ar' => 'name_ar', 'name_ar' => 'name_ar', 'arabic name' => 'name_ar', 'الاسم' => 'name_ar', 'الاسم بالعربي' => 'name_ar',
            'name en' => 'name_en', 'name_en' => 'name_en', 'english name' => 'name_en', 'الاسم بالانجليزية' => 'name_en',
            'email' => 'email', 'البريد الإلكتروني' => 'email', 'البريد الالكتروني' => 'email',
            'phone' => 'phone', 'الهاتف' => 'phone', 'رقم الهاتف' => 'phone',
            'college' => 'college', 'college_id' => 'college_id', 'الكلية' => 'college', 'كلية' => 'college',
            'department' => 'department', 'department_id' => 'department_id', 'القسم' => 'department',
            'academic year' => 'academic_year', 'academic_year' => 'academic_year', 'العام الدراسي' => 'academic_year',
            'level' => 'level', 'المستوى' => 'level',
        ];
        return $aliases[$header] ?? str_replace([' ', '-'], '_', $header);
    }

    private function excelColumnIndex(string $column): int
    {
        $column = strtoupper($column);
        $index = 0;
        for ($i = 0, $len = strlen($column); $i < $len; $i++) {
            $index = $index * 26 + ord($column[$i]) - 64;
        }
        return max(0, $index - 1);
    }

    private function validateStudentImportRows(array $rows): array
    {
        $errors = [];
        $seen = [];
        $normalizedRows = [];

        foreach ($rows as $index => $row) {
            $line = $index + 2;
            $row['student_number'] = trim((string) ($row['student_number'] ?? ''));
            $row['name_ar'] = trim((string) ($row['name_ar'] ?? ''));

            if ($row['student_number'] === '') {
                $errors[] = "Row {$line}: student number is required.";
            } elseif (isset($seen[$row['student_number']])) {
                $errors[] = "Row {$line}: duplicate student number {$row['student_number']} in the file.";
            }
            $seen[$row['student_number']] = true;

            if ($row['name_ar'] === '') {
                $errors[] = "Row {$line}: Arabic name is required.";
            }

            $college = null;
            if (!empty($row['college_id'])) {
                $college = College::find((int) $row['college_id']);
            } elseif (!empty($row['college'])) {
                $college = College::where('name_ar', $row['college'])
                    ->orWhere('name_en', $row['college'])
                    ->orWhere('slug', $row['college'])->first();
            }
            if (!$college) {
                $errors[] = "Row {$line}: college is required and must match an existing college.";
            }

            $department = null;
            if (!empty($row['department_id'])) {
                $department = CollegesDepartments::find((int) $row['department_id']);
            } elseif (!empty($row['department'])) {
                $department = CollegesDepartments::where('title', $row['department'])
                    ->orWhere('titleEn', $row['department'])->first();
            }
            if ($department && $college && (int) $department->college_id !== (int) $college->id) {
                $errors[] = "Row {$line}: department does not belong to the selected college.";
            }
            if (!$department && (!empty($row['department']) || !empty($row['department_id']))) {
                $errors[] = "Row {$line}: department does not match an existing department.";
            }

            if (!empty($row['email']) && !filter_var($row['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Row {$line}: invalid email address.";
            }

            $existing = $row['student_number'] !== '' ? Student::where('student_number', $row['student_number'])->first() : null;
            if ($existing && !auth()->guard('admin')->user()->isDBA() && !$authHasCollegeAccess = auth()->guard('admin')->user()->hasCollegeAccess($existing->college_id)) {
                $errors[] = "Row {$line}: you are not authorized to update this student's college record.";
            }

            $row['college_id'] = $college?->id;
            $row['department_id'] = $department?->id;
            unset($row['college'], $row['department']);
            $normalizedRows[] = $row;
        }

        return ['rows' => $normalizedRows, 'errors' => $errors];
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

        if(!$admin->isDBA() && !$admin->hasCollegeAccess($student->college_id)){
            abort(403, 'You are not authorized to add results for this college.');
        }
        if(!$admin->isDBA() && !\App\Period::isOpen('results', $student->college_id)){
            return redirect()->back()->with('error', 'Results period is currently closed.');
        }

        $rules = [
            'subject_name' => 'required|max:255',
            'marks' => 'nullable|numeric',
            'grade' => 'nullable|max:10',
            'semester' => 'nullable|max:100',
        ];

        Validator::make($request->all(), $rules)->validate();
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
            if(!$admin->isDBA() && !$admin->hasCollegeAccess($student->college_id)){
                abort(403, 'You are not authorized to delete results for this college.');
            }
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
