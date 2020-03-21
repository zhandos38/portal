<!-- Semester Id Field -->
<div class="form-group">
    {!! Form::label('semester_id', 'Семестр:') !!}
    <p>{{ $material->semester->title }}</p>
</div>

<!-- Group Id Field -->
<div class="form-group">
    {!! Form::label('group_id', 'Группа:') !!}
    <p>{{ $material->group->title }}</p>
</div>

<!-- Teacher Id Field -->
<div class="form-group">
    {!! Form::label('teacher_id', 'Преподаватель:') !!}
    <p>{{ $material->teacher->login }}</p>
</div>

<!-- Subject Id Field -->
<div class="form-group">
    {!! Form::label('subject_id', 'Дисциплина:') !!}
    <p>{{ $material->subject->title }}</p>
</div>

<!-- Library Id Field -->
<div class="form-group">
    {!! Form::label('library_id', 'Файл:') !!}
    <p><a href="{{ route('libraries.download', [$material->library->id]) }}" class='btn btn-default btn-xs' download><i class="fa fa-cloud-download"></i></a></p>
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Наименование:') !!}
    <p>{{ $material->title }}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Описание:') !!}
    <p>{{ $material->description }}</p>
</div>

