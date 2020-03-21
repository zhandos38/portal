@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Факультеты</h1>
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('faculties.create') }}">Добавить</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table" id="faculties-table">
                        <thead>
                        <tr>
                            <th>Наименование</th>
                            <th colspan="3">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($faculties as $faculty)
                            <tr>
                                <td>{{ $faculty->title }}</td>
                                <td>
                                    {!! Form::open(['route' => ['faculties.destroy', $faculty->id], 'method' => 'delete']) !!}
                                    <div class='btn-group'>
                                        <a href="{{ route('faculties.show', [$faculty->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                                        <a href="{{ route('faculties.edit', [$faculty->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Вы уверены?')"]) !!}
                                    </div>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection
