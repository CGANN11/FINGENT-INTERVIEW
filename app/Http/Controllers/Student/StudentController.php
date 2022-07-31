<?php

namespace App\Http\Controllers\Student;

use App\Models\Student;
use App\Models\Teacher;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\StudentRepository;


use Exception;

class StudentController extends Controller
{
    public function __construct(StudentRepository $studentRepository)
    {
        // parent::__construct();
        $this->studentRepository = $studentRepository;
    }

    public function __invoke(Request $request)
    {
        return "";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::with(['reportingTeacher'])->orderBy('name')->get();
        return view('student.list_student', ['students' => $students->toArray()]);
    }

    public function addStudent()
    {
        $teachers = Teacher::pluck('name','id')->toArray();
        return view('student.add_new_student', ['teachers' => $teachers]);
    }

    public function saveStudent(Request $request)
    {
        try {
            DB::beginTransaction();
            $message = "Student created successfully.";

            if ($request->has('student_id') && $request->student_id) {
                $student = Student::find($request->student_id);

                $studentInfo = $this->studentRepository->updateStudent($student, $request->all());
                $message = "Student details updated successfully.";
            } else {
                $studentInfo = $this->studentRepository->createNew($request->all());
            }
            DB::commit();
            return redirect()->route('students.list')->with('commonSuccess', $message);
        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()->with('commonError', $e->getMessage());
        }
    }

    public function editStudent(Request $request)
    {
        $teachers = Teacher::pluck('name','id')->toArray();
        $student = Student::find($request->student_id);
        return view('student.edit_student', ['teachers' => $teachers, 'student' => $student]);
    }

    public function deleteStudent(Request $request)
    {
        try {
            $student = Student::find($request->student_id)->delete();

            return redirect()->route('students.list')->with('commonSuccess', 'Student deleted successfully!');

        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()->with('commonError', $e->getMessage());
        }
    }
}
