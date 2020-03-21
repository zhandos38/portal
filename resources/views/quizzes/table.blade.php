<div class="table-responsive">
    <table class="table" id="quizzes-table-property">
        <thead>
            <tr>
                <th>Наименование</th>
                <th colspan="3">Действие</th>
            </tr>
        </thead>
        <tbody>
        @foreach($quizzes as $quiz)
            <tr>
                <td>{{ $quiz->title }}</td>
                <td>
                    {!! Form::open(['route' => ['quizzes.destroy', $quiz->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('addQuestion', [$quiz->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-plus"></i></a>
                        <a href="{{ route('quizzes.edit', [$quiz->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Вы уверены?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $quizzes->links() !!}
</div>
