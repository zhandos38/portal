<div class="table-responsive">
    <table class="table" id="years-table">
        <thead>
            <tr>
                <th>Учебный год</th>
                <th colspan="3">Действие</th>
            </tr>
        </thead>
        <tbody>
        @foreach($years as $year)
            <tr>
                <td>{{ $year->title }}</td>
                <td>
                    {!! Form::open(['route' => ['years.destroy', $year->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('years.show', [$year->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('years.edit', [$year->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Вы уверены?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $years->links() !!}
</div>
