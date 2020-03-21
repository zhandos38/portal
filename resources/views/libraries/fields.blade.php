<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Наименование:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Описание:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Src Field -->
<div class="form-group col-sm-6">
    {!! Form::label('src', 'Файл:') !!}
    {!! Form::file('src', null, ['class' => 'form-control btn btn-wave',]) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Сохранить', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('libraries.index') }}" class="btn btn-default">Отмена</a>
</div>
