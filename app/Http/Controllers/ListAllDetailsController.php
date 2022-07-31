<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Subject;

class ListAllDetailsController extends Controller
{
    public function listTeachers()
    {
        $teachers = Teacher::pluck('name','id')->toArray();

        return view('list.list_teachers', ['teachers' => $teachers]);
    }

    public function listSubjects()
    {
        $subjects = Subject::pluck('subject_name', 'id')->toArray();
        return view('list.list_subjects', ['subjects' => $subjects]);

    }
}
