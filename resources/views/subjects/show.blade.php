@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Дисциплина
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('subjects.show_fields')
                    <a href="{{ route('subjects.index') }}" class="btn btn-default">Назад</a>
                </div>
            </div>
        </div>
    </div>
@endsection
