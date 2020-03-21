<div class="table-responsive">
    <table class="table" id="subjects-table">
        <thead>
            <tr>
                <th>Наименование</th>
                <th colspan="3">Действие</th>
            </tr>
        </thead>
        <tbody>
        @foreach($subjects as $subject)
            <tr>
                <td>{{ $subject->title }}</td>
                <td>
                    {!! Form::open(['route' => ['subjects.destroy', $subject->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('subjects.show', [$subject->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('subjects.edit', [$subject->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Вы уверены?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $subjects->links() !!}
</div>
