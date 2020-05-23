@extends('layouts.app')

@section('content')

    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark mb-0">{{ $pageTitle }}</h3>
        <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="{{ route('course_create') }}">
            <i class="fas fa-plus fa-sm text-white-50"></i>&nbsp;Add Course
        </a>
    </div>
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header py-3">
                    <p class="text-primary m-0 font-weight-bold">Course List</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                        <table class="table dataTable my-0" id="students-list-table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Roll Number</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($courses as $course)
                                <tr>
                                    <td>{{ $course->id }}</td>
                                    <td><a href="{{ route('course') }}/show/{{ $course->id }}" >{{ $course->course_name}} </a></td>
                                    <td>{{ $course->course_date_time }}</td>
                                    <td>
                                        <a class="btn" href="{{ route('course') }}/edit/{{ $course->id }}"><i class="fa fa-edit"></i></a>
                                        <a class="btn" href="{{ route('course') }}/delete/{{ $course->id }}"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                            <th>ID</th>
                                <th>Name</th>
                                <th>Roll Number</th>
                                <th>Actions</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
