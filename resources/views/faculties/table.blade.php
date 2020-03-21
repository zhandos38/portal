<div class="table-responsive">
    <table class="table" id="faculties-table">
        <thead>
            <tr>
                <th>Название</th>
                <th colspan="3">Действие</th>
            </tr>
        </thead>
        <tbody>
        @foreach($faculties as $faculty)
            <tr>
                <td>{{ $faculty->title }}</td>
                <td>
                    {!! Form::open(['route' => ['faculties.destroy', $faculty->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('faculties.show', [$faculty->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('faculties.edit', [$faculty->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Вы уверены?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $faculties->links() !!}
</div>
