@extends('layouts.index')

@section('title', 'Logout')

@section('content')
    <div class="page-header">
        <h1><small>Logout</small></h1>
    </div>
    <div class="card card-body mt-4">
        <p>ログアウトしますか？</p>
        <form action="{{ route('logout') }}" method="POST">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary btn-block">Logout</button>
        </form>
    </div>
@endsection
