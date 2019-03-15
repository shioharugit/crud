@extends('layouts.index')

@section('title', 'User')

@section('content')
    <div class="page-header">
        <h1><small>User-Register-Confirm</small></h1>
    </div>

    <form action="{{ route('user.register.complete')}}" method="POST">
        {{ csrf_field() }}
        
        <dl class="row">
            <dt class="col-md-2">name</dt>
            <dd class="col-md-10">
                {{$user->name}}
                <input type="hidden" name="name" value="{{$user->name}}">
            </dd>
            <dt class="col-md-2">email</dt>
            <dd class="col-md-10">
                {{$user->email}}
                <input type="hidden" name="email" value="{{$user->email}}">
            </dd>
            <dt class="col-md-2">password</dt>
            <dd class="col-md-10">
                (入力したパスワード)
                <input type="hidden" name="password" value="{{$user->password}}">
                <input type="hidden" name="confirm_password" value="{{$user->confirm_password}}">
            </dd>
            <dt class="col-md-2">age</dt>
            <dd class="col-md-10">
                {{$user->age}}
                <input type="hidden" name="age" value="{{$user->age}}">
            </dd>
        </dl>
        <button type="submit" name="action" value="submit" class="btn btn-primary">Submit</button>
        <button type="submit" name="action" value="back" class="btn btn-secondary">Back</button>
    </form>

@endsection