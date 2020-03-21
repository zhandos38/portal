@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Результаты
        </h1>
    </section>
    <div class="content">

        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="table-responsive col-md-12">
                        <table class="table table-bordered" id="examSchedules-table">
                            <thead>
                            <tr>
                                <th>Вопрос</th>
                                <th>Ваш ответ</th>
                                <th>Правильный ответ</th>
                                <th>Балл</th>

                            </tr>
                            </thead>
                            <tbody>
                            @if($results)
                                @foreach($results as $key => $result)
                                    @if(isset($result["correct"]) && isset($result["answer"]) && isset($result["question"]))
                                        @if($key != "total")
                                            <tr class={{$result["correct"] == $result["answer"] ? "bg-success" : "bg-danger"}}>
                                                <td>{{ $result["question"] }}</td>
                                                <td >{{$result["answer"]}}</td>
                                                <td >{{$result["correct"]}}</td>
                                                <td>{{$result["correct"] == $result["answer"] ? 1 : 0}}</td>
                                            </tr>
                                        @endif
                                    @endif
                                @endforeach
                                <tr>
                                    <td colspan="3"><h3>Результат</h3></td>
                                    <td><h3>{{$results["total"]}}/40</h3></td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>





                </div>
            </div>
        </div>
    </div>



@endsection
