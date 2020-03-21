<!-- Quiz Id Field -->
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('quiz_id', 'Тест:') !!}--}}
    {!! Form::hidden('quiz_id', $quiz, ['class' => 'form-control']) !!}
{{--</div>--}}

<!-- Question Field -->
<div class="form-group col-sm-6">
    {!! Form::label('question', 'Вопрос:') !!}
    {!! Form::text('question', null, ['class' => 'form-control']) !!}
</div>

<!-- A Field -->
<div class="form-group col-sm-6">
    {!! Form::label('A', 'A:') !!}
    {!! Form::text('A', null, ['class' => 'form-control']) !!}
</div>

<!-- B Field -->
<div class="form-group col-sm-6">
    {!! Form::label('B', 'B:') !!}
    {!! Form::text('B', null, ['class' => 'form-control']) !!}
</div>

<!-- C Field -->
<div class="form-group col-sm-6">
    {!! Form::label('C', 'C:') !!}
    {!! Form::text('C', null, ['class' => 'form-control']) !!}
</div>

<!-- D Field -->
<div class="form-group col-sm-6">
    {!! Form::label('D', 'D:') !!}
    {!! Form::text('D', null, ['class' => 'form-control']) !!}
</div>

<!-- E Field -->
<div class="form-group col-sm-6">
    {!! Form::label('E', 'E:') !!}
    {!! Form::text('E', null, ['class' => 'form-control']) !!}
</div>

<!-- Correct Field -->
<div class="form-group col-sm-6">
    {!! Form::label('correct', 'Правильный ответ:') !!}
    {!! Form::select('correct', ['A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D', 'E' => 'E'] ,null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
{{--<div class="form-group col-sm-12">--}}
{{--    {!! Form::submit('Сохранить', ['class' => 'btn btn-primary']) !!}--}}
{{--    <a href="{{ route('questions.index') }}" class="btn btn-default">Отмена</a>--}}
{{--</div>--}}
