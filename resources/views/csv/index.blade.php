@extends('layouts.index')

@section('title', 'Csv')

@section('content')
    <div class="page-header">
        <h1><small>Csv</small></h1>
    </div>
    <div class="card card-body mt-4">
        <form method="POST" action="{{ route('csv.download') }}">
            @csrf
            <button type="submit" class="btn btn-primary btn-block">Download</button>
        </form>
        <form method="POST" action="{{ route('csv.import') }}" enctype="multipart/form-data">
            @csrf
            <div class="btn-toolbar mt-5" role="toolbar">
                <div class="custom-file">
                    {{-- Chromeはacceptの指定にtext/csvが対応していないためtext/csv, .csvと記述しています --}}
                    <input type="file" name="csv_file" accept="text/csv, .csv" class="custom-file-input" id="customFile" lang="ja">
                    <label class="custom-file-label" for="customFile">Browse...</label>
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-2">Import</button>
            </div>
        </form>
        <div>
            @foreach($errors->all() as $val)
                <span class="text-danger"><strong>{{ $val }}</strong></span><br>
            @endforeach
            @if (isset($csv_errors) && count($csv_errors) >= 1)
                @foreach($csv_errors as $val)
                    <span class="text-danger"><strong>{{ $val }}</strong></span><br>
                @endforeach
            @endif
        </div>
    </div>
@endsection