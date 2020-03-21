<!-- Semester Id Field -->
<div class="form-group">
    {!! Form::label('semester_id', 'Семестр:') !!}
    <p>{{ $subjectList->semester->title }}</p>
</div>

<!-- Group Id Field -->
<div class="form-group">
    {!! Form::label('group_id', 'Группа:') !!}
    <p>{{ $subjectList->group->title }}</p>
</div>

<!-- Subject Id Field -->
<div class="form-group">
    {!! Form::label('subject_id', 'Дисциплина:') !!}
    <p>{{ $subjectList->subject->title }}</p>
</div>

<!-- Student Id Field -->
<div class="form-group">
    {!! Form::label('student_id', 'Студент:') !!}
    <p>{{$subjectList->student->infos->lastName}} {{ $subjectList->student->infos->firstName }}</p>
</div>

<!-- Credits Field -->
<div class="form-group">
    {!! Form::label('credits', 'Кредит:') !!}
    <p>{{ $subjectList->credits }}</p>
</div>

<!-- Ects Field -->
<div class="form-group">
    {!! Form::label('ECTS', 'ECTS:') !!}
    <p>{{ $subjectList->ECTS }}</p>
</div>

