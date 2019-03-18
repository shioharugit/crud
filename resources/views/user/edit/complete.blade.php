@extends('layouts.index')

@section('title', 'User')

@section('content')
    <div class="page-header">
        <h1><small>User-Edit-Complete</small></h1>
    </div>
    <div class="card card-body mt-4">
        <p>更新が完了しました。</p>
        <button type="submit" onclick="location.href='{{route('user.list')}}'" class="btn btn-secondary btn-block">List</button>
    </div>
@endsection