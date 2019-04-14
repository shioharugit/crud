@extends('layouts.index')

@section('title', 'User-Register-Confirm')

@section('content')
    <div class="page-header">
        <h1><small>User-Register-Confirm</small></h1>
    </div>
    <div class="card card-body mt-4">
        <form action="{{ route('user.register.complete')}}" method="POST">
            {{ csrf_field() }}

            <dl class="row">
                <dt class="col-md-3">authority</dt>
                <dd class="col-md-9">
                    @if(config('const.USER_AUTHORITY.ADMIN') == $user->authority)
                        管理者
                    @elseif(config('const.USER_AUTHORITY.USER') == $user->authority)
                        一般
                    @endif
                    <input type="hidden" name="authority" value="{{$user->authority}}">
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
            <button type="submit" name="action" value="submit" class="btn btn-primary btn-block disable-button">Submit</button>
            <button type="submit" name="action" value="back" class="btn btn-secondary btn-block mt-2">Back</button>
        </form>
    </div>

@endsection