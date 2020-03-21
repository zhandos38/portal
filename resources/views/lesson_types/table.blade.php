<div class="table-responsive">
    <table class="table" id="lessonTypes-table">
        <thead>
            <tr>
                <th>Наименование</th>
                <th colspan="3">Действие</th>
            </tr>
        </thead>
        <tbody>
        @foreach($lessonTypes as $lessonType)
            <tr>
                <td>{{ $lessonType->title }}</td>
                <td>
                    {!! Form::open(['route' => ['lessonTypes.destroy', $lessonType->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('lessonTypes.show', [$lessonType->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('lessonTypes.edit', [$lessonType->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Вы уверены?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
