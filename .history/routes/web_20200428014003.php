<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/student', 'StudentController@index')->name('student');
Route::get('/student/create', 'StudentController@create')->name('student_create');
Route::post('/student', 'StudentController@add')->name('student_add');
Route::get('/student/show/{id}', 'StudentController@show')->name('student_show');
Route::get('/student/delete/{id}', 'StudentController@delete')->name('student_delete');
Route::get('/student/edit/{id}','StudentController@edit')->name('student_edit');
Route::post('/student/edit','StudentController@update')->name('student_edit');

Route::get('/course', 'CourseController@index')->name('course');
Route::get('/course/create', 'CourseController@create')->name('course_create');
Route::post('/course', 'CourseController@add')->name('course_add');
Route::get('/course/delete/{id}', 'CourseController@delete')->name('course_delete');
Route::get('/course/edit/{id}','CourseController@edit')->name('course_edit');
Route::post('/course/edit','CourseController@update')->name('course_edit');

Route::get('/enroll', 'EnrollController@index')->name('enroll');
Route::post('/enroll', 'EnrollController@store')->name('enroll_add');
Route::get('/enroll/delete/{id}', 'EnrollController@destroy')->name('enroll_delete');

Route::get('/teacher', 'TeacherController@index')->name('teacher');
Route::get('/teacher/create', 'TeacherController@create')->name('teacher_create');
Route::post('/teacher', 'TeacherController@store')->name('teacher_add');
Route::get('/teacher/delete/{id}', 'TeacherController@destroy')->name('teacher_delete');
Route::get('/teacher/show/{id}', 'TeacherController@show')->name('teacher_show');
Route::post('/teacher/edit', 'TeacherController@update')->name('teacher_update');
Route::get('/teacher/edit/{id}', 'TeacherController@edit')->name('teacher_edit');

