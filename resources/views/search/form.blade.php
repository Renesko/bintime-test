@extends('layouts.app')

@section('content')
    <div class="container">
        {!! Form::open(['url' => '/search']) !!}

        <div class="row form-group">
            <div class="col-md-3">
                {{ Form::label('orderId', 'Order ID') }}
            </div>
            <div class="col-md-9">
                {{ Form::text('orderId', null, ['class' => 'form-control', 'placeholder' => 'Order ID']) }}
            </div>
        </div>

        <div class="row form-group">
            <div class="col-md-3">
                {{ Form::label('createDate', 'Create data') }}
            </div>
            <div class="col-md-9">
                {{ Form::date('createDate', null, ['class' => 'form-control']) }}
            </div>
        </div>

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

        <div class="row form-group">
            <div class="col-md-6">
                <div class="col-md-3">
                    {{ Form::label('sumFrom', 'Sum from') }}
                </div>
                <div class="col-md-9">
                    {{ Form::text('sumFrom', null, ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-3">
                    {{ Form::label('sumTo', 'Sum to') }}
                </div>
                <div class="col-md-9">
                    {{ Form::text('sumTo', null, ['class' => 'form-control']) }}
                </div>
            </div>
        </div>


        <div class="modal-footer row">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>

        {!! Form::close() !!}
        <div class="row form-group">
            <a href="{{ url('/') }}">Order form</a>
        </div>
    </div>
@endsection

