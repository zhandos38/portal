@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Вопросы
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="margin-bottom">
            <button type="button" class="btn btn-wave" data-toggle="modal" data-target="#createModal">Добавить вопрос</button>
            <button type="button" class="btn btn-wave" data-toggle="modal" data-target="#importQuestions">Импорт Excel</button>
        </div>
        <!-- Create Modal -->
        <div id="createModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Добавить вопрос</h4>
                    </div>
                    {!! Form::open(['method' => 'POST', 'action' => 'QuestionController@store']) !!}
                    <div class="modal-body">
                        <div class="row">
                            @include('questions.fields')
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group pull-right">
                            {!! Form::reset("Сброс", ['class' => 'btn btn-default']) !!}
                            {!! Form::submit("Добавить", ['class' => 'btn btn-wave']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <!-- Import Questions Modal -->
        <div id="importQuestions" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Импорт вопросов (файл Excel)</h4>
                    </div>
                    {!! Form::open(['method' => 'POST', 'action' => 'QuestionController@importExcelToDB', 'files' => true]) !!}
                    <div class="modal-body">
                        {!! Form::hidden('quiz_id', $quiz) !!}
                        <div class="form-group{{ $errors->has('questions') ? ' has-error' : '' }}">
                            {!! Form::label('questions', 'Импорт вопросов', ['class' => 'col-sm-3 control-label']) !!}
                            <span class="required">*</span>
                            <div class="col-sm-9">
                                {!! Form::file('questions', ['required' => 'required']) !!}
                                <p class="help-block">Только Excel файл (.CSV and .XLS)</p>
                                <small class="text-danger">{{ $errors->first('questions') }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group pull-right">
                            {!! Form::reset("Сброс", ['class' => 'btn btn-default']) !!}
                            {!! Form::submit("Импорт", ['class' => 'btn btn-wave']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="content">
                        <div class="clearfix"></div>
                        <div class="box box-primary">
                            <div class="box-body">
                                @include('questions.table')
                            </div>
                        </div>
                        <div class="text-center">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
