@extends('layouts.app')

@section('content')
    <h1>School Scheduling System</h1>
    <p>
        This App lets you add Teachers, Students and courses to a Database.
</p>
        You can then enroll students Teachers to courses.
        In a future version the Dashboard would contain a auto-generated weekly timetable.

    </p>
    <ul>
    <!-- @foreach($teachers as $teacher)
        <li>{{ $teacher->full_name }}</li>
    @endforeach -->

    </ul>
@endsection
