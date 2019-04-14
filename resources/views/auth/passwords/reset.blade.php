@extends('layouts.index')

@section('title', 'Reset-Password')

@section('content')
    <div class="page-header">
        <h1><small>Reset Password</small></h1>
    </div>
    <div class="card mt-4">
        <div class="card-body">
            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form class="form-horizontal" role="form" method="POST" action="{{ route('password.request') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="token" value="{{ $token }}">
                    <dl class="row mt-2">
                        <dt class="col-md-3">email<span class="text-danger small">(必須)</span></dt>
                        <dd class="col-md-9">
                            <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" placeholder="email@example.com" required>
                            @if(!empty($errors->first('email')))
                                <span class="text-danger"><strong>{{$errors->first('email')}}</strong></span>
                            @endif
                        </dd>
                        <dt class="col-md-3">password<span class="text-danger small">(必須)</span></dt>
                        <dd class="col-md-9">
                            <input id="password" type="password" class="form-control" name="password" placeholder="半角英数字8文字以上16文字以内" required>
                            @if(!empty($errors->first('password')))
                                <span class="text-danger"><strong>{{$errors->first('password')}}</strong></span>
                            @endif
                        </dd>
                        <dt class="col-md-3">password_confirmation<span class="text-danger small">(必須)</span></dt>
                        <dd class="col-md-9">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="passwordと同じものを入力" required>
                            @if(!empty($errors->first('password_confirmation')))
                                <span class="text-danger"><strong>{{$errors->first('password_confirmation')}}</strong></span>
                            @endif
                        </dd>
                    </dl>
                    <button type="submit" class="btn btn-primary btn-block disable-button">
                        Reset Password
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
