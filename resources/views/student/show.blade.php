@extends('layouts.app')

@section('content')

    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark mb-0">{{ $pageTitle }}</h3>
        <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="{{ route('student') }}">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i>&nbsp;Student List
        </a>
    </div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $student->full_name }}</h4>
            <h6 class="card-text">{{ $student->roll_number }}</h6>
            <a href="#" class="card-link">Add Course</a>
            <a href="#" class="card-link">View Time Table</a>
        </div>
    </div>
@endsection
