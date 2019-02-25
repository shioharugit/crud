@extends('layouts.index')

@section('title', 'User')

@section('content')
    <div class="page-header">
        <h1><small>User-Register-Confirm</small></h1>
    </div>

    <form action="{{ route('user.register.complete')}}" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
            <label>Name</label>
            <span>{{$user->name}}</span>
            <input type="hidden" name="name" value="{{$user->name}}">
        </div>
        <div class="form-group">
            <label>Email</label>
            <span>{{$user->email}}</span>
            <input type="hidden" name="email" value="{{$user->email}}">
        </div>
        <div class="form-group">
            <label>Password</label>
            <span>****************</span>
            <input type="hidden" name="password" value="{{$user->password}}">
            <input type="hidden" name="confirm_password" value="{{$user->confirm_password}}">
        </div>
        <div class="form-group">
            <label>Age</label>
            <span>{{$user->age}}</span>
            <input type="hidden" name="age" value="{{$user->age}}">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        <button type="submit" name="back" class="btn btn-default">Back</button>
    </form>

@endsection