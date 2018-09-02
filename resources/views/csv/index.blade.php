@extends('layouts.index')

@section('title', 'Csv')

@section('menubar')
   @parent
   Csv
@endsection

@section('content')
<form method="POST" action="{{ route('csv.import') }}" enctype="multipart/form-data">
    @csrf
    <label>
        <div>
            {{-- Chromeはacceptの指定にtext/csvが対応していないためtext/csv, .csvと記述しています --}}
            <input type="file" name="csv_file" accept="text/csv, .csv"><button type="submit">Import</button>
        </div>
    </label>
</form>
<div>
    @foreach($errors->all() as $val)
        <span class="text-error"><strong>{{ $val }}</strong></span><br>
    @endforeach
    @if (isset($csv_errors) && count($csv_errors) >= 1)
        @foreach($csv_errors as $val)
            <span class="text-error"><strong>{{ $val }}</strong></span><br>
        @endforeach
    @endif
</div>
@endsection

@section('footer')
copyright 2018 shioharu.
@endsection


