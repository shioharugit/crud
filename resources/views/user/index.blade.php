@extends('layouts.index')

@section('title', 'User')

@section('menubar')
   @parent
   User
@endsection

@section('content')
<table>
    <tr>
        <th>id</th>
        <th>name</th>
        <th>email</th>
        <th>age</th>
        <th>status</th>
    </tr>
    @foreach ($items as $item)
    <tr>
        <td>{{$item->id}}</td>
        <td>{{$item->name}}</td>
        <td>{{$item->email}}</td>
        <td>{{$item->age}}</td>
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
</table>
@endsection

@section('footer')
copyright 2018 shioharu.
@endsection
