@extends('layouts.index')

@section('title', 'Login')

@section('content')
    <div class="page-header">
        <h1><small>Login</small></h1>
    </div>
    <div class="card mt-4">
        <div class="card-body">
            <form action="{{ route('login') }}" method="POST">
                {{ csrf_field() }}
                <dl class="row mt-2">
                    <dt class="col-md-3">email</dt>
                    <dd class="col-md-9">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                    </dd>
                    <dt class="col-md-3">password</dt>
                    <dd class="col-md-9">
                        <input id="password" type="password" class="form-control" name="password" required>
                        @if(!empty($errors->first('email')))
                            <span class="text-danger"><strong>{{$errors->first('email')}}</strong></span>
                        @endif
                        @if(!empty($errors->first('password')))
                            <span class="text-danger"><strong>{{$errors->first('password')}}</strong></span>
                        @endif
                    </dd>
                </dl>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <div class="checkbox">
                            <label><input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> 次回から入力を省略</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">Login</button>
                        <a class="btn btn-link" href="{{ route('password.request') }}">パスワードを忘れた方はこちら</a>
                        <a class="btn btn-link" href="{{ route('preregister.index') }}">新規登録はこちら</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-body">
            <div class="card-header">CRUDのサンプルです。以下でログインできますので気軽にお試し利用できます。</div>
            <table class="table table-bordered mb-0">
                <thead>
                    <th>email</th>
                    <th>password</th>
                </thead>
                <tbody>
                    <tr>
                        <td>systemadmin@example.com</td>
                        <td>password</td>
                    </tr>
                    <tr>
                        <td>admin@example.com</td>
                        <td>password</td>
                    </tr>
                    <tr>
                        <td>user@example.com</td>
                        <td>password</td>
                    </tr>
                    <tr>
                        <td>test@example.com</td>
                        <td>password</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-body">
            権限は sytemadmin > admin > user > test のためsytemadminでログインすれば全ての機能を利用できます。
        </div>
    </div>
@endsection
