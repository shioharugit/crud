@extends('layouts.index')

@section('title', 'Register-Complete')

@section('content')
    <div class="page-header">
        <h1><small>Register-Complete</small></h1>
    </div>
    <div class="card card-body mt-4">
        <p>本登録が完了しました。</p>
        <button type="submit" onclick="location.href='{{route('login')}}'" class="btn btn-secondary btn-block">Login</button>
    </div>
@endsection