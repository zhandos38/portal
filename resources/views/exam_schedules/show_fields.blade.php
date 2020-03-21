<!-- Semester Id Field -->
<div class="form-group">
    {!! Form::label('semester_id', 'Семестр:') !!}
    <p>{{ $examSchedule->semester->title }}</p>
</div>

<!-- Subject Id Field -->
<div class="form-group">
    {!! Form::label('subject_id', 'Дисциплина:') !!}
    <p>{{ $examSchedule->subject->title }}</p>
</div>

<!-- Group Id Field -->
<div class="form-group">
    {!! Form::label('group_id', 'Группа:') !!}
    <p>{{ $examSchedule->group->title }}</p>
</div>

<!-- Type Id Field -->
<div class="form-group">
    {!! Form::label('type_id', 'Тип:') !!}
    <p>{{ $examSchedule->type->title }}</p>
</div>

<!-- Quiz Id Field -->
<div class="form-group">
    {!! Form::label('quiz_id', 'Тесты:') !!}
    <p>{{ $examSchedule->quiz_id != 0 ? $examSchedule->quiz->title : "Нет" }}</p>
</div>

<!-- Start Field -->
<div class="form-group">
    {!! Form::label('start', 'Начало:') !!}
    <p>{{ $examSchedule->start }}</p>
</div>

<!-- End Field -->
<div class="form-group">
    {!! Form::label('end', 'Конец:') !!}
    <p>{{ $examSchedule->end }}</p>
</div>

<!-- Time Field -->
<div class="form-group">
    {!! Form::label('time', 'Время в минутах:') !!}
    <p>{{ $examSchedule->time }}</p>
</div>

<!-- Cabinet Field -->
<div class="form-group">
    {!! Form::label('cabinet', 'Кабинет:') !!}
    <p>{{ $examSchedule->cabinet }}</p>
</div>

<!-- Active Field -->
<div class="form-group">
    {!! Form::label('active', 'Активность:') !!}
    <p>{{ $examSchedule->active != 0 ? "Активный" : "Не активный"}}</p>
</div>

