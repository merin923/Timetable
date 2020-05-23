<?php

namespace App\Http\Controllers;

use App\Enroll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnrollController extends Controller
{
    public function index(){
        $students = DB::table('students')->get()->toArray();
        $courses = DB::table('courses')->get()->toArray();
        $enrolls = DB::table('enrolls')->get()->toArray();

        return view('enroll.index', [
            'pageTitle' => "Enroll Student",
            'students' => $students,
            'courses' => $courses,
            'enrolls' => $enrolls,
        ]);

    }

    public function store(Request $request){
        $data = $request->all();

        $studentId = $data['student_id'];
        $courses = [];

        foreach ($data as $key => $value){
            if(strstr($key, 'course')){
                array_push($courses, (int) $value);
            }
        }

        foreach($courses as $course){
            $enrollExist = DB::table('enrolls')
                ->where('course_id', $course)
                ->where('student_id', $studentId)
                ->get()
                ->count();
            if(!$enrollExist){
                Enroll::create([
                    'student_id' => $studentId,
                    'course_id' => $course,
                ]);
            }
        }

        return redirect('/enroll');

    }

    public function destroy($id){
        DB::table('enrolls')
            ->where('id', $id)
            ->delete();

        return redirect('/enroll');
    }
}
