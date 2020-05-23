<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index(){
        $courses = DB::table('courses')->get();
        return view('course.index', [
            'courses' => $courses,
            'pageTitle' => 'Courses'
        ]);
    }

    public function create(){
        return view('course.create', [
            'pageTitle' => 'Create Course'
        ]);
    }

    public function add(Request $request){
        $validateData = $request->validate([
            'course_name' => 'required',
            'course_date_time' => 'required',

        ]);

        Course::create($request->all());

        return redirect('/course');
    }

    public function delete($id){
        DB::table('courses')->where('id', '=', $id)->delete();
        return redirect('/course');
    }

    public function edit($id){
        $course = DB::table('courses')->where(
            'id', $id
        )->first();

        return view('course.edit', [
            'course' => $course,
            'pageTitle' => 'course edit'
        ]);

    }

    public function update(Request $request){
        $validateData = $request->validate([
            'course_name' => 'required',
            'course_date_time' => 'required'
        ]);

        $course = [
            'course_name' => $request->all()['course_name'],
            'course_date_time' => $request->all()['course_date_time']
        ];

        $id = $request->all()['id'];

        $affected = DB::table('courses')
            ->where('id', $id)
            ->update($course);




        return redirect('/course');

    }
}
