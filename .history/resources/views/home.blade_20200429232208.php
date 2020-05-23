@extends('layouts.app')

@section('content')
    <h1></h1>
    <ul>
    @foreach($teachers as $teacher)
        <li>{{ $teacher->full_name }}</li>
    @endforeach
    </ul>
@endsection
