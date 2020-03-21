{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--    <section class="content-header">--}}
{{--        <h1 class="pull-left">Рейтинг</h1>--}}
{{--        <h1 class="pull-right">--}}
{{--           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('assignments.create') }}">Добавить</a>--}}
{{--        </h1>--}}
{{--    </section>--}}
{{--    <div class="content">--}}
{{--        <div class="clearfix"></div>--}}

{{--        @include('flash::message')--}}

{{--        <div class="clearfix"></div>--}}
{{--        <div class="box box-primary">--}}
{{--            <div class="box-body">--}}
{{--                    @include('assignments.table')--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="text-center">--}}

{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}

@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Рейтинг
        </h1>
    </section>
    <div class="content">
        @include('flash::message')
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'assignments.store']) !!}

                    @include('assignments.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

