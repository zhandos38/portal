<!-- Department Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('department_id', 'Кафедра:') !!}
    {!! Form::select('department_id',  $departments, null, ['class' => 'form-control select2', 'style' => 'width: 98%;']) !!}
</div>

<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Наименование:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Language Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('language_id', 'Язык обучения:') !!}
    {!! Form::select('language_id', \App\Models\Language::pluck('title', 'id')->all(), null, ['class' => 'form-control select2', 'style' => 'width: 98%;']) !!}
</div>

<!-- Education Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('education_id', 'Тип обучения:') !!}
    {!! Form::select('education_id', \App\Models\EducationTypes::pluck('title', 'id')->all(), null, ['class' => 'form-control select2', 'style' => 'width: 98%;']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Сохранить', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('groups.index') }}" class="btn btn-default">Отмена</a>
</div>
