@extends('layouts.index')

@section('title', 'Csv')

@section('content')
    <div class="page-header">
        <h1><small>Csv</small></h1>
    </div>
    <form method="POST" action="{{ route('csv.download') }}">
        @csrf
        <label>
            <div>
                <button type="submit" class="btn btn-primary">Download</button>
            </div>
        </label>
    </form>
    <form method="POST" action="{{ route('csv.import') }}" enctype="multipart/form-data">
        @csrf
        <div class="btn-toolbar mb-3" role="toolbar">
            <div class="btn-group mr-2" role="group">
                <div class="custom-file">
                    {{-- Chromeはacceptの指定にtext/csvが対応していないためtext/csv, .csvと記述しています --}}
                    <input type="file" name="csv_file" accept="text/csv, .csv" class="custom-file-input" id="customFile" lang="ja">
                    <label class="custom-file-label" for="customFile">Browse...</label>
                </div>
            </div>
            <div class="input-group">
                <button type="submit" class="btn btn-primary">Import</button>
            </div>
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
@endsection