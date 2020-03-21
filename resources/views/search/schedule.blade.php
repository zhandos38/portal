@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Поиск расписания</h1>

    </section>
    <div class="content">
        <div class="clearfix"></div>


        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                {!! Form::open(['route' => 'search.scheduleResult']) !!}

                <div class="form-group col-sm-6">
                    {!! Form::label('semester_id', 'Семестр:') !!}
                    {!! Form::select('semester_id', $semesters, null, ['class' => 'form-control select2', 'style' => 'width: 98%;']) !!}
                </div>

                <!-- Group Id Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('group_id', 'Группа:') !!}
                    {!! Form::select('group_id', $groups, null, ['class' => 'form-control select2', 'style' => 'width: 98%;']) !!}
                </div>
                <div class="form-group col-sm-6">
                    {!! Form::label('type_id', 'Тип поиска:') !!}
                    {!! Form::select('type_id', ["1"=>"Поиск по расписанию","2"=>"Поиск по экзаменам"], null, ['class' => 'form-control select2', 'style' => 'width: 98%;']) !!}
                </div>
                <!-- Submit Field -->
                <div class="form-group col-sm-12">
                    {!! Form::submit('Поиск!', ['class' => 'btn btn-primary']) !!}
                    <a href="{{ route('subjects.index') }}" class="btn btn-default">Отмена</a>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection
