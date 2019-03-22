@extends('layouts.index')

@section('title', 'Register')

@section('content')
    <div class="page-header">
        <h1><small>Register</small></h1>
    </div>
    <div class="card card-body mt-4">
        @if(!empty($message))
            {{$message}}
        @else
            <form action="{{ route('register.confirm')}}" method="POST">
                {{ csrf_field() }}
                <dl class="row">
                    <input type="hidden" name="email_verify_token" value="{{$user->email_verify_token}}">
                    <dt class="col-md-3">email</dt>
                    <dd class="col-md-9">
                        {{$user->email}}
                        <input type="hidden" name="email" value="{{$user->email}}">
                    </dd>
                    <dt class="col-md-3">name<span class="text-danger small">(必須)</span></dt>
                    <dd class="col-md-9">
                        <input type="text" class="form-control" placeholder="半角英字" name="name" value="{{old('name')}}">
                        @if(!empty($errors->first('name')))
                            <span class="text-danger"><strong>{{$errors->first('name')}}</strong></span>
                        @endif
                    </dd>
                    <dt class="col-md-3">password<span class="text-danger small">(必須)</span></dt>
                    <dd class="col-md-9">
                        <input type="password" class="form-control" placeholder="半角英数字8文字以上16文字以内" name="password">
                        @if(!empty($errors->first('password')))
                            <span class="text-danger"><strong>{{$errors->first('password')}}</strong></span>
                        @endif
                    </dd>
                    <dt class="col-md-3">confirm password<span class="text-danger small">(必須)</span></dt>
                    <dd class="col-md-9">
                        <input type="password" class="form-control" placeholder="passwordと同じものを入力" name="password_confirmation">
                        @if(!empty($errors->first('password_confirmation')))
                            <span class="text-danger"><strong>{{$errors->first('password_confirmation')}}</strong></span>
                        @endif
                    </dd>
                    <dt class="col-md-3">age</dt>
                    <dd class="col-md-9">
                        <input type="text" class="form-control" placeholder="半角数字2桁" name="age" value="{{old('age')}}">
                        @if(!empty($errors->first('age')))
                            <span class="text-danger"><strong>{{$errors->first('age')}}</strong></span>
                        @endif
                    </dd>
                </dl>
                <button type="submit" class="btn btn-primary btn-block" name="action" value="submit">Submit</button>
            </form>
        @endif
    </div>
@endsection