<!-- Faculty Id Field -->
<div class="form-group">
    {!! Form::label('faculty_id', 'Факультет:') !!}
    <p>{{ $department->faculties->title }}</p>
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Название:') !!}
    <p>{{ $department->title }}</p>
</div>

<!-- Code Field -->
<div class="form-group">
    {!! Form::label('code', 'Шифр:') !!}
    <p>{{ $department->code }}</p>
</div>

<!-- Speciality Field -->
<div class="form-group">
    {!! Form::label('speciality', 'Специальность:') !!}
    <p>{{ $department->speciality }}</p>
</div>

