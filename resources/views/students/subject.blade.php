@extends('layouts.app')
@section('content')
    <section class="content-header">
        <h1 class="pull-left">Списки занятий</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>



        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @include('students.subject_table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection
