<!-- Department Id Field -->
<div class="form-group">
    {!! Form::label('department_id', 'Кафедра:') !!}
    <p>{{ isset($group->departments->title) ? $group->departments->title : 'Не указано'}}</p>
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Наименование:') !!}
    <p>{{ $group->title }}</p>
</div>

<!-- Language Id Field -->
<div class="form-group">
    {!! Form::label('language_id', 'Язык обучения:') !!}
    <p>{{ isset($group->languages->title) ? $group->languages->title : 'Не указано'}}</p>
</div>

<!-- Education Id Field -->
<div class="form-group">
    {!! Form::label('education_id', 'Тип обучения:') !!}
    <p>{{ isset($group->educations->title) ? $group->educations->title : 'Не указано' }}</p>
</div>

