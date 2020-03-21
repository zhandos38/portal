@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Группа
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('groups.show_fields')
                    <a href="{{ route('groups.index') }}" class="btn btn-default">Назад</a>
                </div>
            </div>
        </div>
    </div>
@endsection
