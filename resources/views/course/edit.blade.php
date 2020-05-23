@extends('layouts.app')

@section('content')

    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark mb-0">{{ $pageTitle }}</h3>
        <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="{{ route('course') }}">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i>&nbsp;All Courses
        </a>
    </div>
    <form method="post" action="/course/edit">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{ $course->id }}" />
        <div class="form-group">
            <label for="course-name">Course Name:</label>
            <input type="text" value="{{ $course->course_name }}"name="course_name" class="form-control" id="course-name" aria-describedby="courseNameHelp" placeholder="Enter course name">
            <small id="studentNameHelp" class="form-text text-muted">Please enter the full name of the course.</small>
        </div>
        <div class="form-group">
            <label for="course-date-time">Course Schedule:</label>
            <input type="time" value="{{ $course->course_date_time}}"name="course_date_time" class="form-control" id="course-date-time" aria-describedby="courseTimeHelpText" placeholder="00:00 00r">
            <small id="courseTimeHelpText" class="form-text text-muted">Please select the course time.</small>
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
        <button type="submit" class="btn btn-primary">Edit Course</button>
    </form>
@endsection
