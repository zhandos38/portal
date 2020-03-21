<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category', 'Категория:') !!}
    {!! Form::select('category', $searchable ,null, ['class' => 'form-control select2','style'=>"width:98%"]) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Ключевые слова:') !!}
    {!! Form::text('title',null, ['class' => 'form-control','required']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Поиск!', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('subjects.index') }}" class="btn btn-default">Отмена</a>
</div>
