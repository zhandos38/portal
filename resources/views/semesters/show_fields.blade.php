<!-- Year Id Field -->
<div class="form-group">
    {!! Form::label('year_id', 'Учебный год:') !!}
    <p>{{ $semester->years->title }}</p>
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Наименование:') !!}
    <p>{{ $semester->title }}</p>
</div>

<!-- Start Field -->
<div class="form-group">
    {!! Form::label('start', 'Начало семестра:') !!}
    <p>{{ $semester->start }}</p>
</div>

<!-- End Field -->
<div class="form-group">
    {!! Form::label('end', 'Конец семестра:') !!}
    <p>{{ $semester->end }}</p>
</div>

<!-- Current Field -->
<div class="form-group">
    {!! Form::label('current', 'Текущий семестр:') !!}
    <p>{{ $semester->current == 0 ? 'Нет' : 'Да' }}</p>
</div>

<!-- Step Field -->
<div class="form-group">
    {!! Form::label('step', 'Текущий рубежный контроль:') !!}
    <p>{{ $semester->step == 0 ? 'Доступ закрыт' : $semester->step}}</p>
</div>

