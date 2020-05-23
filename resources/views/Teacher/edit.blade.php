@extends('layouts.app')

@section('content')

    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark mb-0">{{ $pageTitle }}</h3>
        <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="{{ route('student') }}">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i>&nbsp;Teachers List
        </a>
    </div>
    <form method="post" action="/teacher/edit">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{ $teachers->id }}"/>
        <div class="form-group">
            <label for="student-name">Teacher Full Name:</label>
            <input type="text" value="{{ $teachers->full_name }}" name="full_name" class="form-control" id="teacher-name" aria-describedby="teacherNameHelp" placeholder="Enter Teacher Full Name">
            <small id="teacherNameHelp" class="form-text text-muted">Please enter the full name of the teacher.</small>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect2">Courses</label>
            @foreach( $teachers->courses as $course )
                <div class="form-check">
                    <input class="form-check-input" value="{{ $course->id }}" name="course_{{ $course->id }}" type="checkbox" value="" id="defaultCheck{{ $course->id }}" checked>
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
        <button type="submit" class="btn btn-primary">Update Teacher</button>
    </form>
@endsection
