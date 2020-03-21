@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Тип занятия
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('lesson_types.show_fields')
                    <a href="{{ route('lessonTypes.index') }}" class="btn btn-default">Назад</a>
                </div>
            </div>
        </div>
    </div>
@endsection
