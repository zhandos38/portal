<!-- Quiz Id Field -->
<div class="form-group">
    {!! Form::label('quiz_id', 'Название теста:') !!}
    <p>{{ $question->quizzes->title }}</p>
</div>

<!-- Question Field -->
<div class="form-group">
    {!! Form::label('question', 'Вопрос:') !!}
    <p>{{ $question->question }}</p>
</div>

<!-- A Field -->
<div class="form-group">
    {!! Form::label('A', 'A:') !!}
    <p>{{ $question->A }}</p>
</div>

<!-- B Field -->
<div class="form-group">
    {!! Form::label('B', 'B:') !!}
    <p>{{ $question->B }}</p>
</div>

<!-- C Field -->
<div class="form-group">
    {!! Form::label('C', 'C:') !!}
    <p>{{ $question->C }}</p>
</div>

<!-- D Field -->
<div class="form-group">
    {!! Form::label('D', 'D:') !!}
    <p>{{ $question->D }}</p>
</div>

<!-- E Field -->
<div class="form-group">
    {!! Form::label('E', 'E:') !!}
    <p>{{ $question->E }}</p>
</div>

<!-- Correct Field -->
<div class="form-group">
    {!! Form::label('Correct', 'Правильный ответ:') !!}
    <p>{{ $question->Correct }}</p>
</div>

