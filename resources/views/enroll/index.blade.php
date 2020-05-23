@extends('layouts.app')

@section('content')

    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark mb-0">{{ $pageTitle }}</h3>
        <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="{{ route('student') }}">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i>&nbsp;Student List
        </a>
    </div>
    <form method="post" action="/enroll">
        {{ csrf_field() }}
        <div class="form-group">
            <label  for="exampleFormControlSelect1">Select a student</label>
            <select name="student_id"  class="form-control" id="exampleFormControlSelect1">
                @foreach($students as $student)
                    <option value="{{$student->id}}">{{$student->full_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect2">Courses</label>
            @foreach( $courses as $course )
                <div class="form-check">
                    <input class="form-check-input" value="{{ $course->id }}" name="course_{{ $course->id }}" type="checkbox" value="" id="defaultCheck{{ $course->id }}">
                    <label class="form-check-label" for="defaultCheck{{ $course->id }}">
                        {{ $course->course_name }}
                    </label>
                </div>
            @endforeach
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <button type="submit" class="btn btn-primary">Enroll</button>
    </form>

    <div class="row mt-5">
        <div class="col">
            <div class="card shadow">
                <div class="card-header py-3">
                    <p class="text-primary m-0 font-weight-bold">Enrollments</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                        <table class="table dataTable my-0" id="students-list-table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Student ID</th>
                                <th>Course ID</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($enrolls as $enroll)
                                <tr>
                                    <td>{{ $enroll->id }}</td>
                                    <td>
                                        @foreach($students as $student)
                                            @if($student->id == $enroll->student_id)
                                                {{ $student->full_name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($courses as $course)
                                            @if($course->id == $enroll->course_id)
                                                {{ $course->course_name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <a class="btn" href="{{ route('enroll') }}/delete/{{ $enroll->id }}"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td><strong>ID</strong></td>
                                <td><strong>Student ID</strong></td>
                                <td><strong>Course ID</strong></td>
                                <td><strong>Actions</strong></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
