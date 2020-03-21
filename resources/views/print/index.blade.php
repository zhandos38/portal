@extends('layouts.app')
@section('content')
<div class="content" style="min-height: 410mm">
    <h2>Распечатать</h2>

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">Список студентов</a></li>
        <li><a data-toggle="tab" href="#menu1">Транскрипт</a></li>
        <li><a data-toggle="tab" href="#assignment">Результат тестирования</a></li>
        <li><a data-toggle="tab" href="#listTranscript">Список выданных транскриптов</a></li>
        {{--        <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>--}}
        {{--        <li><a data-toggle="tab" href="#menu3">Menu 3</a></li>--}}
    </ul>

    <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
            <h3>Поиск групп</h3>
        {!! Form::open(['method' => 'POST', 'action' => 'PrintController@lists']) !!}
        <!-- Semester Id Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('faculty_list', 'Факультет:') !!}
                {!! Form::select('faculty_list', $faculties, null, ['class' => 'form-control', 'id' => 'listFaculty']) !!}
            </div>
            <div class="form-group col-sm-6" id="listDepartment" style="display: none">
                {!! Form::label('department_list', 'Кафедра:') !!}
                {!! Form::select('department_list', ['id' => 'test'], null, ['class' => 'form-control', 'id' => 'dep1']) !!}
            </div>
            <!-- Group Id Field -->
            <div class="form-group col-sm-6" id="listGroup" style="display: none">
                {!! Form::label('group_list', 'Группа:') !!}
                {!! Form::select('group_list', ['id' => 'test'], null, ['class' => 'form-control select2', 'style'=>'width: 98%;', 'id' => 'group1']) !!}
            </div>
            <div class="form-group col-sm-6" id="listSubject" style="display: none">
                {!! Form::label('subject_list', 'Группа:') !!}
                {!! Form::select('subject_list', ['id' => 'test'], null, ['class' => 'form-control select2', 'style'=>'width: 98%;', 'id' => 'group1']) !!}
            </div>

            <!-- Student Id Field -->
            {{--<div class="form-group col-sm-6" id="divStudent" style="display: none">--}}
            {{--    {!! Form::label('student_id', 'Студент:') !!}--}}
            {{--    {!! Form::select('student_id', ['id' => 'test'], null, ['class' => 'form-control', 'id' => 'student']) !!}--}}
            {{--</div>--}}

            <div class="form-group col-sm-12" id="listStudent" style="display: none">
                <button class="btn btn-wave" type="button" onclick="printJS('lists', 'html')">Распечатать</button>
                <div id="lists" class="page">

                </div>
            </div>

            {!! Form::close() !!}


        </div>
        <div id="menu1" class="tab-pane fade">
            <h3>Поиск студента</h3>

            {!! Form::open(['method' => 'POST', 'action' => 'PrintController@search']) !!}
        <!-- Semester Id Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('faculty_id', 'Факультет:') !!}
                {!! Form::select('faculty_id', $faculties, null, ['class' => 'form-control', 'id' => 'divFaculty']) !!}
            </div>
            <div class="form-group col-sm-6" id="divDepartment" style="display: none">
                {!! Form::label('department_id', 'Кафедра:') !!}
                {!! Form::select('department_id', ['id' => 'test'], null, ['class' => 'form-control', 'id' => 'department']) !!}
            </div>
            <!-- Group Id Field -->
            <div class="form-group col-sm-6" id="divGroup" style="display: none">
                {!! Form::label('group_id', 'Группа:') !!}
                {!! Form::select('group_id', ['id' => 'test'], null, ['class' => 'form-control select2', 'style'=>'width: 98%;', 'id' => 'group']) !!}
            </div>
            <!-- Group Id Field -->
            <div class="form-group col-sm-6" id="divStudenT" style="display: none">
                {!! Form::label('student_id', 'Студент:') !!}
                {!! Form::select('student_id', ['id' => 'test'], null, ['class' => 'form-control select2', 'style'=>'width: 98%;', 'id' => 'studenT']) !!}
            </div>


            <!-- Student Id Field -->
            {{--<div class="form-group col-sm-6" id="divStudent" style="display: none">--}}
            {{--    {!! Form::label('student_id', 'Студент:') !!}--}}
            {{--    {!! Form::select('student_id', ['id' => 'test'], null, ['class' => 'form-control', 'id' => 'student']) !!}--}}
            {{--</div>--}}

            <div class="form-group col-sm-12" id="divTranscript" style="display: none">
                <button class="btn btn-wave" type="button" onclick="printJS('transcript', 'html')">Распечатать</button>
                <div id="transcript" class="page">

                </div>
            </div>

            {!! Form::close() !!}
        </div>
        <div id="assignment" class="tab-pane fade">
            <h3>Экзаменационная ведомость</h3>

        {!! Form::open(['method' => 'POST', 'action' => 'PrintController@search']) !!}
        <!-- Semester Id Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('faculty_id', 'Факультет:') !!}
                {!! Form::select('faculty_id', $faculties, null, ['class' => 'form-control', 'id' => 'assignment1_faculty']) !!}
            </div>
            <div class="form-group col-sm-6" id="div_assignment1_department" hidden>
                {!! Form::label('department_id', 'Кафедра:') !!}
                {!! Form::select('department_id', ['id' => 'test'], null, ['class' => 'form-control', 'id' => 'assignment1_department']) !!}
            </div>
            <!-- Group Id Field -->
            <div class="form-group col-sm-6" id="div_assignment1_group" hidden>
                {!! Form::label('group_id', 'Группа:') !!}
                {!! Form::select('group_id', ['id' => 'test'], null, ['class' => 'form-control select2', 'style'=>'width: 98%;', 'id' => 'assignment1_group']) !!}
            </div>
            <!-- Group Id Field -->
            <div class="form-group col-sm-6" id="div_assignment1_subject" hidden>
                {!! Form::label('subject_id', 'Предмет:') !!}
                {!! Form::select('subject_id', ['id' => 'test'], null, ['class' => 'form-control select2', 'style'=>'width: 98%;', 'id' => 'assignment1_subject']) !!}
            </div>



            <div class="form-group col-sm-12" id="divTranscript2" style="display: none">
                <button class="btn btn-wave" type="button" onclick="printJS('transcript2', 'html')">Распечатать</button>
                <div id="transcript2" class="page">

                </div>
            </div>

            {!! Form::close() !!}
        </div>
        <div id="listTranscript" class="tab-pane fade">
            <h3>Список студентов получивших транскриптов</h3>
            <table class="table" id="exportTable">
                <thead>
                <tr>
                    <th scope="col">№</th>
                    <th scope="col">ФИО</th>
                    <th scope="col">ПНС номер</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pns as $item)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$item->users->infos->lastName}} {{$item->users->infos->firstName}}</td>
                    <td>{{$item->pns}}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>


    </div>
</div>

@endsection
