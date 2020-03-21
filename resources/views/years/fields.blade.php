<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Учебный год:') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'id' => 'reservation']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Сохранить', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('years.index') }}" class="btn btn-default">Отмена</a>
</div>
