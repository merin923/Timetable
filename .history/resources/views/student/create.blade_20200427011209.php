@extends('layouts.app')

@section('content')

    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark mb-0">{{ $pageTitle }}</h3>
        <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="{{ route('student') }}">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i>&nbsp;Student List
        </a>
    </div>
    <form method="post" action="/student">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="student-name">Student Full Name:</label>
            <input type="text" name="full_name" class="form-control" id="student-name" aria-describedby="studentNameHelp" placeholder="Enter Student Full Name">
            <small id="studentNameHelp" class="form-text text-muted">Please enter the full name of the student.</small>
        </div>
        <div class="form-group">
            <label for="student-roll-number">Student Roll Number:</label>
            <input type="text" name="roll_number" class="form-control" id="student-roll-number" aria-describedby="studentRollNumberHelp" placeholder="Enter Student Roll Number">
            <small id="studentRollNumberHelp" class="form-text text-muted">Please enter ST followed by the roll number of the student.</small>
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
       <button type="submit" class="btn btn-primary">Add Student</button>
    </form>
@endsection
