<!-- Semester Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('semester_id', 'Семестр:') !!}
    {!! Form::select('semester_id', \App\Models\Semester::pluck('title', 'id')->prepend('Выберите семестр', '')->all(), null, ['class' => 'form-control', 'id' => 'divSemester']) !!}
</div>

<!-- Group Id Field -->
<div class="form-group col-sm-6" id="divGroup" style="display: none">
    {!! Form::label('group_id', 'Группа:') !!}
    {!! Form::select('group_id', ['id' => 'test'], null, ['class' => 'form-control select2', 'style'=>'width: 98%;', 'id' => 'group']) !!}
</div>

<!-- Subject Id Field -->
<div class="form-group col-sm-6" id="divSubject" style="display: none">
    {!! Form::label('subject_id', 'Дисциплина:') !!}
    {!! Form::select('subject_id', ['id' => 'test'], null, ['class' => 'form-control select2', 'id' => 'subject', 'style'=>'width: 98%;']) !!}
</div>

<!-- Teacher Id Field -->
<div class="form-group col-sm-6" id="divTeacher" style="display: none">
    {!! Form::label('teacher_id', 'Препод:') !!}
    {!! Form::select('teacher_id', ['id' => 'test'], null, ['class' => 'form-control select2', 'id' => 'teacher', 'style'=>'width: 98%;']) !!}
</div>

<!-- Student Id Field -->
{{--<div class="form-group col-sm-6" id="divStudent" style="display: none">--}}
{{--    {!! Form::label('student_id', 'Студент:') !!}--}}
{{--    {!! Form::select('student_id', ['id' => 'test'], null, ['class' => 'form-control', 'id' => 'student']) !!}--}}
{{--</div>--}}

<div class="form-group col-sm-12" id="divStudent" style="display: none">
    <table class="table" id="student">

</table>
</div>
{{--<div class="form-group col-sm-12">--}}
{{--    <table class="table">--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th>ФИО</th>--}}
{{--            <th>1 рубежка</th>--}}
{{--            <th>2 рубежка</th>--}}
{{--            <th>Экзамен</th>--}}
{{--            <th>Общий рейтинг</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--        <tr>--}}
{{--            <td><input type="text" disabled value="Valery Kim"></td>--}}
{{--            <td><input type="text" value="25"></td>--}}
{{--            <td><input type="text" value="27"></td>--}}
{{--            <td><input type="text" value="36"></td>--}}
{{--            <td><input type="text" disabled value="88"></td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td><input type="text" disabled value="Vladilen Minin"></td>--}}
{{--            <td><input type="text" value="29"></td>--}}
{{--            <td><input type="text" value="29"></td>--}}
{{--            <td><input type="text" value="40"></td>--}}
{{--            <td><input type="text" disabled value="98"></td>--}}
{{--        </tr>--}}
{{--        </tbody>--}}
{{--</table>--}}
{{--</div>--}}
<!-- First Rating Field -->
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('first_rating', '1 рубежка:') !!}--}}
{{--    {!! Form::text('first_rating', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Second Rating Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('second_rating', '2 рубежка:') !!}--}}
{{--    {!! Form::text('second_rating', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Exam Rating Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('exam_rating', 'Экзамен:') !!}--}}
{{--    {!! Form::text('exam_rating', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Total Rating Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('total_rating', 'Общий рейтинг:') !!}--}}
{{--    {!! Form::text('total_rating', null, ['class' => 'form-control', 'disabled']) !!}--}}
{{--</div>--}}

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Сохранить', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('assignments.index') }}" class="btn btn-default">Отмена</a>
</div>
