@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Расписание занятий</h1>

    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-bordered" data-resizable>
                    <thead>
                    <tr>
                        <th scope="col">Понедельник</th>
                        <th scope="col">Вторник</th>
                        <th scope="col">Среда</th>
                        <th scope="col">Четверг</th>
                        <th scope="col">Пятница</th>
                        <th scope="col">Суббота</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
{{--                        Понедельник--}}
                        @if(isset($schedules[1]))
                        <td>
                            @foreach($schedules[1] as $item)
                                <p style="font-size:14px">
                                    {!! $item !!}</p>
                                <hr>
                            @endforeach
                        </td>
                        @else
                            <td>
                                <p style="font-size:14px">
                                    Нет занятий</p>
                            </td>
                        @endif
{{--                        Вторник--}}
                        @if(isset($schedules[2]))
                            <td>
                                @foreach($schedules[2] as $item)
                                    <p style="font-size:14px">
                                        {!! $item !!}</p>
                                    <hr>
                                @endforeach
                            </td>
                        @else
                            <td>
                                <p style="font-size:14px">
                                    Нет занятий</p>
                            </td>
                        @endif
{{--                        Среда--}}
                        @if(isset($schedules[3]))
                            <td>
                                @foreach($schedules[3] as $item)
                                    <p style="font-size:14px">
                                        {!! $item !!}</p>
                                    <hr>
                                @endforeach
                            </td>
                        @else
                            <td>
                                <p style="font-size:14px">
                                    Нет занятий</p>
                            </td>
                        @endif
{{--                        Четверг--}}
                        @if(isset($schedules[4]))
                            <td>
                                @foreach($schedules[4] as $item)
                                    <p style="font-size:14px">
                                        {!! $item !!}</p>
                                    <hr>
                                @endforeach
                            </td>
                        @else
                            <td>
                                <p style="font-size:14px">
                                    Нет занятий</p>
                            </td>
                        @endif
{{--                        Пятница--}}
                        @if(isset($schedules[5]))
                            <td>
                                @foreach($schedules[5] as $item)
                                    <p style="font-size:14px">
                                        {!! $item !!}</p>
                                    <hr>
                                @endforeach
                            </td>
                        @else
                            <td>
                                <p style="font-size:14px">
                                    Нет занятий</p>
                            </td>
                        @endif
{{--                        Суббота--}}
                        @if(isset($schedules[6]))
                            <td>
                                @foreach($schedules[6] as $item)
                                    <p style="font-size:14px">
                                        {!! $item !!}</p>
                                    <hr>
                                @endforeach
                            </td>
                        @else
                            <td>
                                <p style="font-size:14px">
                                    Нет занятий</p>
                            </td>
                        @endif







                    </tr>




                    </tbody>
                </table>




            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection
