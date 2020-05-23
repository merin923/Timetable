<?php

namespace App\Http\Controllers;

use App\Course;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $teachers = DB::table('teachers')->get();

        $viewTeachers = [];

        foreach($teachers as $teacher){
            $tempTeachers = new stdClass();
            $courses = json_decode($teacher->courses);
            $tempCourse = [];
            foreach ($courses as $course){
                $data = DB::table('courses')->where('id', $course)->value('course_name');
                array_push($tempCourse, $data);
            }
            $teacher->courses = $tempCourse;
        }
        return view('teacher.index',[
            'teachers' => $teachers,
            'pageTitle' => 'Teachers'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = DB::table('courses')
            ->where('assigned', false)
            ->orWhere('assigned', null)
            ->get();
        return view ('teacher.create', [
            'courses' => $courses,
            'pageTitle' => 'Create Teacher'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'full_name' => 'required'

        ]);

        $data = $request->all();

        $courses = [];

        foreach ($data as $key => $value){
            if(strstr($key, 'course')){
                array_push($courses, (int) $value);
            }
        }

        foreach ($courses as $id){
            DB::table('courses')
                ->where('id', $id)
                ->update([
                    'assigned' => 1
                ]);
        }

        Teacher::create([
            'full_name' => $data['full_name'],
            'courses' => json_encode($courses)
        ]);

        return redirect(
            '/teacher'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teacher = DB::table('teachers')->where(
            'id', $id
        )->first();

        $courses = json_decode($teacher->courses);

        $tempCourse = [];

        foreach ($courses as $course){
            $data = DB::table('courses')->where('id', $course)->get()->toArray()[0];
            array_push($tempCourse, $data);
        }
        $id = [0];
        foreach ($tempCourse as $key => $value){
            if($value)
                array_push($id, $value->id);
        }

        $courses = DB::select("select * from courses where (assigned = false or assigned is null) and (id not in (". implode(',', $id)."))");


        $tempCourse = array_merge($tempCourse, $courses);
        $teacher->courses = $tempCourse;

        return view('teacher.edit', [
            'teachers' => $teacher,
            'pageTitle' => 'Teacher edit'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $dbCourses = DB::table('teachers')->where('id', $request->all()['id'])->value('courses');
        $dbCourses = json_decode($dbCourses);

        $validateData = $request->validate([
            'full_name' => 'required'
        ]);

        $data = $request->all();
        $courses = [];

        foreach ($data as $key => $value){
            if(strstr($key, 'course')){
                array_push($courses, (int) $value);
            }
        }

        $difference = array_diff($dbCourses, $courses);

        foreach ($difference as $id){
            DB::table('courses')
                ->where('id', $id)
                ->update([
                    'assigned' => 0
                ]);
        }

        foreach ($courses as $course){
            DB::table('courses')
                ->where('id', $course)
                ->update([
                    'assigned'=> 1
                ]);
        }
        $teacher = [
            'full_name' => $data['full_name'],
            'courses' => json_encode($courses)
        ];

        DB::table('teachers')
            ->where('id', $request->all()['id'])
            ->update($teacher);

        return redirect('/teacher');

    }

    /**
     * Delete Teacher from list
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy($teacher)
    {
        $teacher = DB::table('teachers')->where('id', '=', $teacher);//select the teacher that matches the one stored

        //remove courses
        $courses = json_decode($teacher->value('courses'));//select courses from teacher

        foreach ($courses as $id){//as we can have multiple courses
            DB::table('courses')
                ->where('id', $id)
                ->update([
                    'assigned' => 0
                ]);
        }
        $teacher->delete();

        return redirect('/teacher');
    }
}
