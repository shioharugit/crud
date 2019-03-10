@extends('layouts.index')

@section('title', 'User')

@section('content')
    <div class="page-header">
        <h1><small>User-List</small></h1>
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td><a href="{{route('user.detail', $item->id)}}">{{$item->name}}</a></td>
                <td>
                    @if (config('const.USER_STATUS.PROVISIONAL_MEMBER') == $item->status)
                        {{ '仮会員' }}
                    @elseif (config('const.USER_STATUS.UNSUBSCRIBE') == $item->status)
                        {{ '退会' }}
                    @else
                        {{ '会員' }}
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection