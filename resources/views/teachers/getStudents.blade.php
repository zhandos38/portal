@extends('layouts.app')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Почта
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        @include('teachers._sidebar')
        <!-- /.col -->
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><input type="checkbox" id="checkAll">  Студенты</h3>
{{--                                            <div class="box-tools pull-right">--}}
{{--                                                <div class="has-feedback">--}}
{{--                                                    <button type="button" class="btn btn-wave">Отправить</button>--}}
{{--                                                    <input type="text" class="form-control input-sm" placeholder="Search Mail">--}}
{{--                                                    <span class="glyphicon glyphicon-search form-control-feedback"></span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                    <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        {{--                        <div class="mailbox-controls">--}}
                        {{--                            <!-- Check all button -->--}}
                        {{--                            <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>--}}
                        {{--                            </button>--}}
                        {{--                            <div class="btn-group">--}}
                        {{--                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>--}}
                        {{--                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>--}}
                        {{--                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>--}}
                        {{--                            </div>--}}
                        {{--                            <!-- /.btn-group -->--}}
                        {{--                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>--}}
                        {{--                            <div class="pull-right">--}}
                        {{--                                1-50/200--}}
                        {{--                                <div class="btn-group">--}}
                        {{--                                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>--}}
                        {{--                                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>--}}
                        {{--                                </div>--}}
                        {{--                                <!-- /.btn-group -->--}}
                        {{--                            </div>--}}
                        {{--                            <!-- /.pull-right -->--}}
                        {{--                        </div>--}}
                        {!! Form::open(['method' => 'POST', 'route' => 'teacherEnvelopeSendStudents', 'files' => true]) !!}
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped">
                                <tbody>
                                @foreach($students as $student)
                                    <tr>
                                        <td class="mailbox-name">
                                            {!! Form::hidden('group_id', $student->group_id) !!}
                                            {{--                                            {!! Form::checkbox('students[]', $student->id, ['class' => 'iCheck']) !!}--}}
                                            <input type="checkbox" class="iCheck" name="students[]" value="{{$student->id}}">
                                            <a href="">{{$student->infos->firstName}}  {{$student->infos->secondName}}  {{$student->infos->middleName}}</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- /.table -->
                        </div>
                        <div style="margin-top: 20px">
                            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Заголовок']) !!}
                            {!! Form::textarea('description', null, ['class' => 'form-control' , 'placeholder' => 'Сообщение . . .']) !!}
                        </div>

                        {!! Form::reset("Сброс", ['class' => 'btn btn-default']) !!}
                        {!! Form::submit("Отправить", ['class' => 'btn btn-wave']) !!}
                        {!! Form::close() !!}
                        <!-- /.mail-box-messages -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer no-padding">
{{--                        <div class="mailbox-controls">--}}
{{--                            <!-- Check all button -->--}}
{{--                            <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>--}}
{{--                            </button>--}}
{{--                            <div class="btn-group">--}}
{{--                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>--}}
{{--                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>--}}
{{--                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>--}}
{{--                            </div>--}}
{{--                            <!-- /.btn-group -->--}}
{{--                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>--}}
{{--                            <div class="pull-right">--}}
{{--                                1-50/200--}}
{{--                                <div class="btn-group">--}}
{{--                                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>--}}
{{--                                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>--}}
{{--                                </div>--}}
{{--                                <!-- /.btn-group -->--}}
{{--                            </div>--}}
{{--                            <!-- /.pull-right -->--}}
{{--                        </div>--}}
                    </div>
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>


@endsection
