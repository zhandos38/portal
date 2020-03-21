@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Пробный тест
        </h1>
{{--        <p>Время до конца: <b id="timeexam"></b></p>--}}
        <p>Время до конца:
            <span id="timer"></span>
        </p>
    </section>
    <div class="content">

        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::open(['route' => 'student.check',"id"=>"quiz-form"]) !!}
                        <input type="hidden" id="answers" name="answers" >
                        <input type="hidden" value="{{$schedule->id}}" name="schedule" >
                        @foreach($tests as $key=>$test)
                            @php $number = $loop->iteration @endphp
                            <div class="form-group col-sm-12 questions-other" hidden id="question{{$number}}">
                                <h4>{{$loop->iteration}}.) {{$test["question"]}}</h4>
                                @foreach($test["answers"] as $answer )
                                    <div class="radio">
                                        <label><input class="questions-input" type="radio" data-key = "{{$key}}" data-number ="{{$number}}"  name=answers[{{$key}}][] value="{{$answer}}" id="answer{{$loop->iteration}}">{{$answer}}</label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                @foreach($tests as $key=>$test)
                                    <li class="page-item" ><a class="page-link2 another" id="page-item{{$loop->iteration}}" data-question ="{{$loop->iteration}}" href="#">{{$loop->iteration}}</a></li>
                                @endforeach

                            </ul>
                        </nav>

                        <button type="submit" class="btn btn-info click-me" disabled>Завершить</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @php $time = $schedule->time @endphp
    <script defer>
        refresh();
        // выставляем секунды
        var sec=0;
        // выставляем минуты
        var min={{$schedule->time}}

        function refresh()
        {
            sec--;
            if(sec==-01){sec=59; min=min-1;}
            else{min=min;}
            if(sec<=9){sec="0" + sec;}
            time=(min<=9 ? "0"+min : min) + ":" + sec;
            if(document.getElementById){timer.innerHTML=time;}
            inter=setTimeout("refresh()", 1000);
            // действие, если таймер 00:00
            if(min=='00' && sec=='00'){
                sec="00";
                window.onbeforeunload = function () {
                    // blank function do nothing
                }
                $('#quiz-form').submit();
                /* либо любой другой Ваш код */
            }
        }

        {{--setTimeout(function () {--}}
        {{--    $("#quiz-form").submit();--}}
        {{--},{{$time}});--}}
            document.onkeydown = checkRefresh;
        function checkRefresh(event) {
            if(event.keyCode == 116 || event.keyCode == 133 || event.keyCode == 82  || event.keyCode == 123){
                event.preventDefault();
                alert("Не перезагружайте страницу во время сдачи тестирования!")
            }
            if(event.ctrlKey){
                event.preventDefault();
            }

        }
        window.onbeforeunload = function(event)
        {
            return confirm("Вы точно уверены что хотите покинуть страницу? При этом результат сохранен не будет!");
        };
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.go(1);
        };
        document.addEventListener('contextmenu', event => event.preventDefault());

    </script>
@endsection
