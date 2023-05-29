<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Libraries\BaseApi;

class StudentController extends Controller
{
    public function index()
    {
        $data = (new BaseApi)->index('/students');
        $students = $data->json();

        return view('students.index')->with('students' , $students['data']);
    }

    public function create()
    {
        return view('students.create');
    }
}
