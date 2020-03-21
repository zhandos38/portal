<!-- Faculty Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('faculty_id', 'Факультет:') !!}
    {!! Form::select('faculty_id', $faculties, null, ['class' => 'form-control']) !!}
</div>

<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Название:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', 'Шифр:') !!}
    {!! Form::text('code', null, ['class' => 'form-control']) !!}
</div>

<!-- Speciality Field -->
<div class="form-group col-sm-6">
    {!! Form::label('speciality', 'Специальность:') !!}
    {!! Form::text('speciality', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Сохранить', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('departments.index') }}" class="btn btn-default">Отмена</a>
</div>
