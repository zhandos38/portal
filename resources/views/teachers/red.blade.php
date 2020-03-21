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
        @include('flash::message')
        <div class="row">
        @include('teachers._sidebar')
        <!-- /.col -->
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Информация</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="mailbox-read-info">
                            <h3>{{$message->title}}</h3>
                            <h5>От студента: {{$message->users->infos->firstName}} {{$message->users->infos->lastName}}
                                <span class="mailbox-read-time pull-right">{{$message->created_at}}</span></h5>
                        </div>
                        <div class="mailbox-read-message">
                            <textarea cols="123" rows="10">{{$message->description}}</textarea>
                        </div>
                        <!-- /.mailbox-read-message -->
                    </div>
                    <!-- /.box-body -->

                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>


@endsection



