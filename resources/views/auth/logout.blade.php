@extends('layouts.index')

@section('title', 'Login')

@section('content')
    <div class="page-header">
        <h1><small>Logout</small></h1>
    </div>

    <form action="{{ route('logout') }}" method="POST">
        {{ csrf_field() }}
        <div class="form-group mt-4">
            <div class="col-md-8 col-md-offset-4">
                <button type="submit" class="btn btn-primary">Logout</button>
            </div>
        </div>
    </form>

@endsection
