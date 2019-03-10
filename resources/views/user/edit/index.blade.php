@extends('layouts.index')

@section('title', 'User')

@section('content')
    <div class="page-header">
        <h1><small>User-Edit</small></h1>
    </div>

    <form action="{{ route('user.edit.confirm')}}" method="POST">
        {{ csrf_field() }}
        <dl class="row">
            <dt class="col-md-3">id</dt>
            <dd class="col-md-9">
                {{$user->id}}
                <input type="hidden" name="id" value="{{$user->id}}">
            </dd>
            <dt class="col-md-3">name<span class="text-danger small">(必須)</span></dt>
            <dd class="col-md-9">
                <input type="text" class="form-control" placeholder="半角英字" name="name" value="{{old('name') ? old('name') : $user->name}}">
                @if(!empty($errors->first('name')))
                    <span class="text-danger"><strong>{{$errors->first('name')}}</strong></span>
                @endif
            </dd>
            <dt class="col-md-3">email<span class="text-danger small">(必須)</span></dt>
            <dd class="col-md-9">
                <input type="email" class="form-control" placeholder="email@example.com" name="email" value="{{old('email') ? old('email') : $user->email}}">
                @if(!empty($errors->first('email')))
                    <span class="text-danger"><strong>{{$errors->first('email')}}</strong></span>
                @endif
            </dd>
            <dt class="col-md-3">password</dt>
            <dd class="col-md-9">
                <input type="password" class="form-control" placeholder="半角英数字8文字以上16文字以内" name="password">
                @if(!empty($errors->first('email')))
                    <span class="text-danger"><strong>{{$errors->first('password')}}</strong></span>
                @endif
            </dd>
            <dt class="col-md-3">confirm password</dt>
            <dd class="col-md-9">
                <input type="password" class="form-control" placeholder="passwordと同じものを入力" name="confirm_password">
                @if(!empty($errors->first('email')))
                    <span class="text-danger"><strong>{{$errors->first('confirm_password')}}</strong></span>
                @endif
            </dd>
            <dt class="col-md-3">age</dt>
            <dd class="col-md-9">
                <input type="text" class="form-control" placeholder="半角数字2桁" name="age" value="{{old('age') ? old('age') : $user->age}}">
                @if(!empty($errors->first('age')))
                    <span class="text-danger"><strong>{{$errors->first('age')}}</strong></span>
                @endif
            </dd>
        </dl>
        <button type="submit" class="btn btn-primary" name="action" value="submit">Submit</button>
    </form>
    <button type="submit" onclick="location.href='{{route('user.detail', $user->id)}}'" class="btn btn-default mt-2">Back</button>
@endsection