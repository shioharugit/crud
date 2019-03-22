@extends('layouts.index')

@section('title', 'User-Detail')

@section('content')
    <div class="page-header">
        <h1><small>User-Detail</small></h1>
    </div>
    <div class="card card-body mt-4">
        <dl class="row">
            <dt class="col-md-3">id</dt>
            <dd class="col-md-9">{{ $user->id }}</dd>
            <dt class="col-md-3">authority</dt>
            <dd class="col-md-9">
                @if(config('const.USER_AUTHORITY.SYSTEMADMIN') == $user->authority)
                    システム管理者
                @elseif(config('const.USER_AUTHORITY.ADMIN') == $user->authority)
                    管理者
                @elseif(config('const.USER_AUTHORITY.USER') == $user->authority)
                    一般
                @elseif(config('const.USER_AUTHORITY.TEST') == $user->authority)
                    TEST
                @endif
            </dd>
            <dt class="col-md-3">name</dt>
            <dd class="col-md-9">{{ $user->name }}</dd>
            <dt class="col-md-3">email</dt>
            <dd class="col-md-9">{{ $user->email }}</dd>
            <dt class="col-md-3">age</dt>
            <dd class="col-md-9">{{ $user->age }}</dd>
            <dt class="col-md-3">status</dt>
            <dd class="col-md-9">
                @if(config('const.USER_STATUS.MEMBER') == $user->status)
                    会員
                @elseif(config('const.USER_STATUS.PROVISIONAL_MEMBER') == $user->status)
                    仮会員
                @elseif(config('const.USER_STATUS.UNSUBSCRIBE') == $user->status)
                    退会
                @endif
            </dd>
        </dl>
        @can('admin-higher')
            @if(config('const.USER_AUTHORITY.SYSTEMADMIN') != $user->authority
                && config('const.USER_AUTHORITY.TEST') != $user->authority
                && (int)$user->authority >= (int)Auth::user()->authority)
                <button type="submit" onclick="location.href='{{route('user.edit.index', $user->id)}}'" class="btn btn-primary btn-block">Edit</button>
            @endif
        @endcan
        <?php $url = parse_url(url()->previous()); ?>
        <button type="submit" onclick="location.href='{{route('user.list', $url['query'] ?? '' )}}'" class="btn btn-secondary btn-block mt-2">Back</button>
    </div>
@endsection