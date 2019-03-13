@extends('layouts.index')

@section('title', 'User')

@section('content')
    <div class="page-header">
        <h1><small>User-List</small></h1>
    </div>

    <p class="pt-2"><button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Filter</button></p>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <form action="{{ route('user.list')}}" method="GET">
                <dl class="row">
                    <dt class="col-md-3">name</dt>
                    <dd class="col-md-9">
                        <input type="text" class="form-control" placeholder="半角英字" name="name" value="{{old('name') ? old('name') : $request->input('name')}}">
                        @if(!empty($errors->first('name')))
                            <span class="text-danger"><strong>{{$errors->first('name')}}</strong></span>
                        @endif
                    </dd>
                    <dt class="col-md-3">email</dt>
                    <dd class="col-md-9">
                        <input type="text" class="form-control" placeholder="email@example.com" name="email" value="{{old('email') ? old('email') : $request->input('email')}}">
                        @if(!empty($errors->first('email')))
                            <span class="text-danger"><strong>{{$errors->first('email')}}</strong></span>
                        @endif
                    </dd>
                    <dt class="col-md-3">age</dt>
                    <dd class="col-md-9">
                        <input type="text" class="form-control" placeholder="半角数字2桁" name="age" value="{{old('age') ? old('age') : $request->input('age')}}">
                        @if(!empty($errors->first('age')))
                            <span class="text-danger"><strong>{{$errors->first('age')}}</strong></span>
                        @endif
                    </dd>
                </dl>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
    </div>

    <div class="pt-3 pb-2">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td><a href="{{route('user.detail', $user->id)}}">{{$user->name}}</a></td>
                <td>
                    @if (config('const.USER_STATUS.PROVISIONAL_MEMBER') == $user->status)
                        {{ '仮会員' }}
                    @elseif (config('const.USER_STATUS.UNSUBSCRIBE') == $user->status)
                        {{ '退会' }}
                    @else
                        {{ '会員' }}
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="paginate">
        {{ $users->appends(['name' => $request->input('name'), 'email' => $request->input('email'), 'age' => $request->input('age')])->render() }}
    </div>
    @if (count($users) === 0)
        検索結果0件でした
    @endif
    </div>

@endsection