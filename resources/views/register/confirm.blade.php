@extends('layouts.index')

@section('title', 'Register-Confirm')

@section('content')
    <div class="page-header">
        <h1><small>Register-Confirm</small></h1>
    </div>
    <div class="card card-body mt-4">
        <form action="{{ route('register.complete')}}" method="POST">
            {{ csrf_field() }}
            <dl class="row">
                <input type="hidden" name="email_verify_token" value="{{$user->email_verify_token}}">
                <dt class="col-md-3">email</dt>
                <dd class="col-md-9">
                    {{$user->email}}
                </dd>

                <dt class="col-md-3">name</dt>
                <dd class="col-md-9">
                    {{$user->name}}
                    <input type="hidden" name="name" value="{{$user->name}}">
                </dd>

                <dt class="col-md-3">password</dt>
                <dd class="col-md-9">
                    (入力したパスワード)
                    <input type="hidden" name="password" value="{{$user->password}}">
                    <input type="hidden" name="password_confirmation" value="{{$user->password_confirmation}}">
                </dd>
                <dt class="col-md-3">age</dt>
                <dd class="col-md-9">
                    {{$user->age}}
                    <input type="hidden" name="age" value="{{$user->age}}">
                </dd>
            </dl>
            <button type="submit" name="action" value="submit" class="btn btn-primary btn-block">Submit</button>
            <button type="submit" name="action" value="back" class="btn btn-secondary btn-block mt-2">Back</button>
        </form>
    </div>
@endsection