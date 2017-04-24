@extends('layouts.app')

@section('content')
    <div class="container">
        {!! Form::open(['url' => '/order']) !!}

        <div class="row form-group">
            <div class="col-md-3">
                {{ Form::label('username', 'User name') }}
            </div>
            <div class="col-md-9">
                {{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'User name']) }}
            </div>
        </div>

        <div class="row form-group">
            <div class="col-md-3">
                {{ Form::label('surname', 'Surname') }}
            </div>
            <div class="col-md-9">
                {{ Form::text('surname', null, ['class' => 'form-control', 'placeholder' => 'Surname']) }}
            </div>
        </div>

        <div class="row form-group">
            <div class="col-md-3">
                {{ Form::label('email', 'E-mail') }}
            </div>
            <div class="col-md-9">
                {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'E-mail']) }}
            </div>
        </div>

        <div class="line">
            <div class="row form-group">
                    <div class="col-md-8">
                        <div class="col-md-4">
                            {{ Form::label('line[0][product]', 'Product 1') }}
                        </div>
                        <div class="col-md-8">
                            {{ Form::select('line[0][product]', $products, null, [
                                'class' => 'form-control product-list',
                                'placeholder' => 'Pick a product...',
                                'data-index' => 0
                            ]) }}
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="col-md-3">
                            {{ Form::label('line[0][price]', 'Price') }}
                        </div>
                        <div class="col-md-9">
                            {{ Form::text('line[0][price]', null, [
                                'class' => 'form-control',
                                'readonly' => true,
                                'data-index' => 0
                            ]) }}
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="col-md-3">
                            {{ Form::label('line[0][count]', 'Count') }}
                        </div>
                        <div class="col-md-9">
                            {{ Form::number('line[0][count]', 1, [
                                'class' => 'form-control product-count',
                                'min' => 1,
                                'data-index' => 0
                            ]) }}
                        </div>
                    </div>
            </div>

            <div class="row form-group">
                <div class="col-md-8">
                    <div class="col-md-4">
                        {{ Form::label('line[1][product]', 'Product 2') }}
                    </div>
                    <div class="col-md-8">
                        {{ Form::select('line[1][product]', $products, null, [
                            'class' => 'form-control product-list',
                            'placeholder' => 'Pick a product...',
                            'data-index' => 1
                        ]) }}
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="col-md-3">
                        {{ Form::label('line[1][price]', 'Price') }}
                    </div>
                    <div class="col-md-9">
                        {{ Form::text('line[1][price]', null, [
                            'class' => 'form-control',
                            'readonly' => true,
                            'data-index' => 1
                        ]) }}
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="col-md-3">
                        {{ Form::label('line[1][count]', 'Count') }}
                    </div>
                    <div class="col-md-9">
                        {{ Form::number('line[1][count]', 1, [
                            'class' => 'form-control product-count',
                            'min' => 1,
                            'data-index' => 1
                        ]) }}
                    </div>
                </div>
            </div>
        </div>

    @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="modal-footer row">
            <button type="submit" class="btn btn-primary">Make order</button>
        </div>

        {!! Form::close() !!}
    </div>

@endsection

@section('footer')
    <div class="row">
        Order count: {{ $orderCount }}
    </div>

    <div class="row">
        <a href="{{ url('/search-form') }}">Search</a>
    </div>
@endsection