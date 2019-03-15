@extends('layouts.index')

@section('title', 'User')

@section('content')
    <div class="page-header">
        <h1><small>User-Edit-Confirm</small></h1>
    </div>

    <form action="{{ route('user.edit.complete')}}" method="POST">
        {{ csrf_field() }}
        
        <dl class="row">
            <dt class="col-md-3">id</dt>
            <dd class="col-md-9">
                {{$user->id}}
                <input type="hidden" name="id" value="{{$user->id}}">
            </dd>
            <dt class="col-md-3">name</dt>
            <dd class="col-md-9">
                {{$user->name}}
                <input type="hidden" name="name" value="{{$user->name}}">
            </dd>
            <dt class="col-md-3">email</dt>
            <dd class="col-md-9">
                {{$user->email}}
                <input type="hidden" name="email" value="{{$user->email}}">
            </dd>
            <dt class="col-md-3">password</dt>
            <dd class="col-md-9">
                @if (!empty($user->password))
                    (入力したパスワード)
                @endif
                <input type="hidden" name="password" value="{{$user->password}}">
                <input type="hidden" name="confirm_password" value="{{$user->confirm_password}}">
            </dd>
            <dt class="col-md-3">age</dt>
            <dd class="col-md-9">
                {{$user->age}}
                <input type="hidden" name="age" value="{{$user->age}}">
            </dd>
        </dl>
        <button type="submit" name="action" value="submit" class="btn btn-primary">Submit</button>
        <button type="submit" name="action" value="back" class="btn btn-secondary">Back</button>
    </form>

@endsection