<div class="table-responsive">
    <h4>{{\App\Models\Quiz::find($quiz)->title}}</h4>
    <table class="table" id="questions-table">
        <thead>
        <tr>
        <th>Вопрос</th>
        <th>A</th>
        <th>B</th>
        <th>C</th>
        <th>D</th>
        <th>E</th>
        <th>Правильный ответ</th>
                <th colspan="3">Действие</th>
            </tr>
        </thead>
        <tbody>
        @foreach($questions as $question)
            <tr>
            <td>{{ $question->question }}</td>
            <td>{{ $question->A }}</td>
            <td>{{ $question->B }}</td>
            <td>{{ $question->C }}</td>
            <td>{{ $question->D }}</td>
            <td>{{ $question->E }}</td>
            <td>{{ $question->correct }}</td>
                <td>
                    {!! Form::open(['route' => ['questions.destroy', $question->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('questions.show', [$question->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('questions.edit', [$question->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Вы уверены?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $questions->links() !!}
</div>
