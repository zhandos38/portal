@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Тест
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('quizzes.show_fields')
                    <a href="{{ route('quizzes.index') }}" class="btn btn-default">Назад</a>
                </div>
            </div>
        </div>
    </div>
@endsection
