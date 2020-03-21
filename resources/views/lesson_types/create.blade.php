@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Тип занятия
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'lessonTypes.store']) !!}

                        @include('lesson_types.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
