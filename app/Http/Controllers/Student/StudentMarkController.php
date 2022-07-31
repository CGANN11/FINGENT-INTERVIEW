<?php

namespace App\Http\Controllers\Student;

use App\Models\StudentMarkDetail;
use App\Models\Subject;
use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\StudentMarkRepository;

class StudentMarkController extends Controller
{
    public function __construct(StudentMarkRepository $studentMarkRepository)
    {
        $this->studentMarkRepository = $studentMarkRepository;
    }
    public function index()
    {
        $subjects = Subject::pluck('subject_name', 'id')->toArray();
        $students = StudentMarkDetail::with(['studentName', 'subjectName'])->get();
        $studentDetails = [];

        foreach($students as $student) {
            if(!isset($studentDetails[$student->studentName->id][$student->term]['student_name'])) {
                $studentDetails[$student->studentName->id][$student->term] = [
                    'mark_id' => $student->id,
                    'student_name' => $student->studentName->name,
                    'student_id' => $student->studentName->id,
                    'term' => $student->term,
                    'created_on' => date('M d, Y H:i a', strtotime($student->created_at))
                ];
            }
            $studentDetails[$student->studentName->id][$student->term]['subject'][$student->subjectName->id] = $student->mark;
        }
        return view('student_mark.list_mark_details', ['studentDetails' => $studentDetails, 'subjects' => $subjects]);
    }

    public function addStudentMark()
    {
        $students = Student::pluck('name','id')->toArray();
        $subjects = Subject::pluck('subject_name','id')->toArray();
        return view('student_mark.add_students_mark', ['students' => $students, 'subjects' => $subjects]);
    }

    public function saveStudentMark(Request $request)
    {
        try {
            DB::beginTransaction();
            $message = "Student mark saved successfully.";

            if ($request->has('student_mark_id') && $request->student_mark_id) {
                $studentInfo = $this->studentMarkRepository->updateStudentMark($request->all());
                $message = "Student mark details updated successfully.";
            } else {
                $studentInfo = $this->studentMarkRepository->createNew($request->all());
            }
            DB::commit();
            return redirect()->route('students.mark.list')->with('commonSuccess', $message);
        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()->with('commonError', $e->getMessage());
        }
    }

    public function editStudentMarkDetails(Request $request)
    {
        $students = Student::pluck('name','id')->toArray();
        $subjects = Subject::pluck('subject_name','id')->toArray();
        $marks = StudentMarkDetail::with(['studentName', 'subjectName'])->where('student_id', $request->student_id)->where('term', $request->term)->get();
        // $studentMarks = [];
        foreach($marks as $data) {
            if(!isset($studentMarks['student_id'])) {
                $studentMarks['student_id'] = $data->student_id;
                $studentMarks['term'] = $data->term;
            }
            $studentMarks['subjects_and_marks'][$data->subject_id] = [
                'subject' => $data->subjectName->subject_name,
                'mark' => $data->mark,
                'mark_id' => $data->id
            ];
        }
        return view('student_mark.edit_students_mark', ['students' => $students, 'subjects' => $subjects, 'studentMarks' => $studentMarks]);
    }

    public function deleteStudentMarkDetails(Request $request)
    {
        try {
            $mark = StudentMarkDetail::find($request->mark_id)->delete();

            return redirect()->route('students.mark.list')->with('commonSuccess', 'Student Mark Details deleted successfully!');

        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()->with('commonError', $e->getMessage());
        }
    }
}
