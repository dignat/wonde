<?php

namespace App\Http\Controllers;

use App\Services\SchoolService;
use Illuminate\Http\Request;
use Wonde\Client;

class ClassesController extends Controller
{
    protected $client;
    protected $school;

    public function __construct(SchoolService $schoolService) {
        $this->school = $schoolService->client();
    }
    
    public function getSchool() {

         $employees = $this->school->employees->all(['classes'], ['has_class']);
         $data = ['employees' => $employees];

        return view('employees', compact('data'));
    }

    public function getClass($classId) {

       $class = $this->school->classes->get($classId, ['lessons', 'students', 'students.registration'], ['has_lessons', 'has_students']);
  
        
       $data = ['lessons' => $class->lessons->data, 'students' => $class->students->data];
       return view('lessons', compact('data'));
    }
}
