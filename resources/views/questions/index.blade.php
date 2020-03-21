@extends('layouts.app')

@section('content')
{{--    <section class="content-header">--}}
{{--        <h1 class="pull-left">Вопросы</h1>--}}
{{--        <h1 class="pull-right">--}}
{{--           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('questions.create') }}">Добавить</a>--}}
{{--        </h1>--}}
{{--    </section>--}}
    <div class="content">
        <h3>Тесты</h3>
        <div class="row">
            @foreach($quizzes as $item)
            <div class="col-md-4">

                <div class="quiz-card">
                    <h3 class="quiz-name"></h3>
                    <p title=""></p>

                    <div class="row">
                        <div class="col-xs-6 pad-0">
                            <ul class="topic-detail">
                                <li>Название  <i class="fa fa-long-arrow-right"></i></li>
                                <li>Вопросы  <i class="fa fa-long-arrow-right"></i></li>
                            </ul>
                        </div>
                        <div class="col-xs-6">
                            <ul class="topic-detail right">
                                <li>{{$item->title}}</li>
                                <li>{{$item->questions->count()}}</li>
                            </ul>
                        </div>
                        <a href="{{route('addQuestion', $item->id)}}" class="btn btn-info myButton">Добавить вопрос</a>
                    </div>
                </div>

                {{--        <div id="deleteans{{ $topic->id }}" class="delete-modal modal fade" role="dialog">--}}
                {{--            <!-- Delete Modal -->--}}
                {{--            <div class="modal-dialog modal-sm">--}}
                {{--                <div class="modal-content">--}}
                {{--                    <div class="modal-header">--}}
                {{--                        <button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                {{--                        <div class="delete-icon"></div>--}}
                {{--                    </div>--}}
                {{--                    <div class="modal-body text-center">--}}
                {{--                        <h4 class="modal-heading">Are You Sure ?</h4>--}}
                {{--                        <p>Do you really want to delete these Quiz Answer Sheet? This process cannot be undone.</p>--}}
                {{--                    </div>--}}
                {{--                    <div class="modal-footer">--}}
                {{--                        {!! Form::open(['method' => 'DELETE', 'action' => ['TopicController@deleteperquizsheet', $topic->id]]) !!}--}}
                {{--                        {!! Form::reset("No", ['class' => 'btn btn-gray', 'data-dismiss' => 'modal']) !!}--}}
                {{--                        {!! Form::submit("Yes", ['class' => 'btn btn-danger']) !!}--}}
                {{--                        {!! Form::close() !!}--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                {{--            </div>--}}
                {{--        </div>--}}
            </div>
            @endforeach
        </div>
        {!! $quizzes->links() !!}
    </div>



@endsection

