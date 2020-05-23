<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    //  $students = DB::select("select * from students");
        $students = DB::table('students')->get();
        return view('student.index', [
            'students' => $students,
            'pageTitle' => 'Student'
        ]);
    }

    public function create(){
        return view ('student.create', [
            'pageTitle' => 'Create Student'
        ]);
    }
    //Required inputs
    public function add(Request $request){
        $validateData = $request->validate([
            'full_name' => 'required',
            'roll_number' => 'required'
        ]);

        Student::create($request->all());

        return redirect('/student');
    }
    
    public function show($id){
        $student = DB::table('students')->where(
            'id', $id
        )->first();

        return view('student.show', [
            'student' => $student,
            'pageTitle' => 'Student Profile'
        ]);
    }

    public function delete($id){
        DB::table('students')->where('id', '=', $id)->delete();//delete students whose id matched 'id'
        return redirect('/student');
    }

    public function edit($id){
        $student = DB::table('students')->where(
            'id', $id
        )->first();

        return view('student.edit', [
            'student' => $student,
            'pageTitle' => 'Student Profile'
        ]);

    }

    public function update(Request $request){
        $validateData = $request->validate([
            'full_name' => 'required',
            'roll_number' => 'required'
        ]);

        $student = [
            'full_name' => $request->all()['full_name'],
            'roll_number' => $request->all()['roll_number']
        ];

        $id = $request->all()['id'];
        $affected = DB::table('students')
            ->where('id', $id)
            ->update($student);

        return redirect('/student');

    }
}
