@extends('layouts.index')

@section('title', 'Preregister')

@section('content')
    <div class="page-header">
        <h1><small>Preregister</small></h1>
    </div>
    <div class="card card-body mt-4">
        <form action="{{ route('preregister.complete') }}" method="POST">
            {{ csrf_field() }}
            <dl class="row">
                <dt class="col-md-3">email<span class="text-danger small">(必須)</span></dt>
                <dd class="col-md-9">
                    <input type="email" class="form-control" placeholder="email@example.com" name="email" value="{{old('email')}}">
                    @if(!empty($errors->first('email')))
                        <span class="text-danger"><strong>{{$errors->first('email')}}</strong></span>
                    @endif
                </dd>
            </dl>
            <button type="submit" class="btn btn-primary btn-block disable-button">Submit</button>
        </form>
    </div>
@endsection
