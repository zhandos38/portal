@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Успеваемость
        </h1>
    </section>
    <div class="content">

        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    @include('students.assignment_table')
                </div>
            </div>
        </div>
    </div>
@endsection



