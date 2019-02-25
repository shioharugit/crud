@extends('layouts.index')

@section('title', 'User')

@section('content')
    <div class="page-header">
        <h1><small>User-Register</small></h1>
    </div>

    <form action="{{ route('user.register.confirm')}}" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
            <label>name</label>
            <input type="text" class="form-control" placeholder="name" name="name" value="{{old('name')}}">
            @if(!empty($errors->first('name')))
                <span class="text-danger"><strong>{{$errors->first('name')}}</strong></span>
            @endif
        </div>
        <div class="form-group">
            <label>email</label>
            <input type="email" class="form-control" placeholder="email@example.com" name="email" value="{{old('email')}}">
            @if(!empty($errors->first('email')))
                <span class="text-danger"><strong>{{$errors->first('email')}}</strong></span>
            @endif
        </div>
        <div class="form-group">
            <label>password</label>
            <input type="password" class="form-control" placeholder="半角英数字8文字以上16文字以内" name="password">
            @if(!empty($errors->first('password')))
                <span class="text-danger"><strong>{{$errors->first('password')}}</strong></span>
            @endif
        </div>
        <div class="form-group">
            <label>confirm password</label>
            <input type="password" class="form-control" placeholder="passwordと同じものを入力" name="confirm_password">
            @if(!empty($errors->first('confirm_password')))
                <span class="text-danger"><strong>{{$errors->first('confirm_password')}}</strong></span>
            @endif
        </div>
        <div class="form-group">
            <label>age</label>
            <input type="text" class="form-control" placeholder="20" name="age" value="{{old('age')}}">
            @if(!empty($errors->first('age')))
                <span class="text-danger"><strong>{{$errors->first('age')}}</strong></span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection