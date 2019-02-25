@extends('layouts.index')

@section('title', 'User')

@section('content')
    <div class="page-header">
        <h1><small>User-Register-Complete</small></h1>
    </div>

    <button type="submit" onclick="location.href='{{route('user.list')}}'" class="btn btn-default">List</button>

@endsection