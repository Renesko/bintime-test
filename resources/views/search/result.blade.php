@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row form-group">
            <a href="{{ url('/search-form') }}">Search form</a>
        </div>
        {{ var_dump($result) }}
    </div>
@endsection