@extends('layouts.index')

@section('title', 'User')

@section('content')
    <div class="page-header">
        <h1><small>User-Detail</small></h1>
    </div>

    <dl class="row">
        <dt class="col-md-3">id</dt>
        <dd class="col-md-9">{{ $user->id }}</dd>
        <dt class="col-md-3">name</dt>
        <dd class="col-md-9">{{ $user->name }}</dd>
        <dt class="col-md-3">email</dt>
        <dd class="col-md-9">{{ $user->email }}</dd>
        <dt class="col-md-3">age</dt>
        <dd class="col-md-9">{{ $user->age }}</dd>
    </dl>

    <?php $url = parse_url(url()->previous()); ?>
    <button type="submit" onclick="location.href='{{route('user.edit.index', $user->id)}}'" class="btn btn-primary">Edit</button>
    <button type="submit" onclick="location.href='{{route('user.list', $url['query'] ?? '' )}}'" class="btn btn-secondary">Back</button>

@endsection