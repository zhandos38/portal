@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Поиск</h1>

    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                {!! Form::open(['route' => 'search.result']) !!}
                @include('search.fields')
                {!! Form::close() !!}
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection
