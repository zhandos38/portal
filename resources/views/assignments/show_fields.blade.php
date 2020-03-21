<!-- Semester Id Field -->
<div class="form-group">
    {!! Form::label('semester_id', 'Семестр:') !!}
    <p>{{ $assignment->semester_id }}</p>
</div>

<!-- Group Id Field -->
<div class="form-group">
    {!! Form::label('group_id', 'Группа:') !!}
    <p>{{ $assignment->group_id }}</p>
</div>

<!-- Subject Id Field -->
<div class="form-group">
    {!! Form::label('subject_id', 'Дисциплина:') !!}
    <p>{{ $assignment->subject_id }}</p>
</div>

<!-- Teacher Id Field -->
<div class="form-group">
    {!! Form::label('teacher_id', 'Препод:') !!}
    <p>{{ $assignment->teacher_id }}</p>
</div>

<!-- Student Id Field -->
<div class="form-group">
    {!! Form::label('student_id', 'Студент:') !!}
    <p>{{ $assignment->student_id }}</p>
</div>

<!-- First Rating Field -->
<div class="form-group">
    {!! Form::label('first_rating', '1 рубежка:') !!}
    <p>{{ $assignment->first_rating }}</p>
</div>

<!-- Second Rating Field -->
<div class="form-group">
    {!! Form::label('second_rating', '2 рубежка:') !!}
    <p>{{ $assignment->second_rating }}</p>
</div>

<!-- Exam Rating Field -->
<div class="form-group">
    {!! Form::label('exam_rating', 'Экзамен:') !!}
    <p>{{ $assignment->exam_rating }}</p>
</div>

<!-- Total Rating Field -->
<div class="form-group">
    {!! Form::label('total_rating', 'Общий рейтинг:') !!}
    <p>{{ $assignment->total_rating }}</p>
</div>

