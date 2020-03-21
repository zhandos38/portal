<!-- Department Id Field -->
<div class="form-group">
    {!! Form::label('department_id', 'Кафедра:') !!}
    <p>{{ $group->departments->title }}</p>
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Наименование:') !!}
    <p>{{ $group->title }}</p>
</div>

<!-- Language Id Field -->
<div class="form-group">
    {!! Form::label('language_id', 'Язык обучения:') !!}
    <p>{{ $group->languages->title }}</p>
</div>

<!-- Education Id Field -->
<div class="form-group">
    {!! Form::label('education_id', 'Тип обучения:') !!}
    <p>{{ $group->educations->title }}</p>
</div>

