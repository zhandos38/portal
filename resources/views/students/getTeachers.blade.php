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
        @include('students._sidebar')
        <!-- /.col -->
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Препод</h3>
                    <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        {!! Form::open(['method' => 'POST', 'route' => 'studentEnvelopeSendTeacher']) !!}
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped">
                                <tbody>
                                    {!! Form::hidden('teacher_id', $teacher->id) !!}
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

                    </div>
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>


@endsection
