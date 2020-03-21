<div class="table-responsive">
    <table class="table" id="departments-table">
        <thead>
            <tr>
                <th>Факультет</th>
        <th>Название</th>
        <th>Шифр</th>
        <th>Специальность</th>
                <th colspan="3">Действие</th>
            </tr>
        </thead>
        <tbody>
        @foreach($departments as $department)
            <tr>
                <td>{{ $department->faculties->title }}</td>
            <td>{{ $department->title }}</td>
            <td>{{ $department->code }}</td>
            <td>{{ $department->speciality }}</td>
                <td>
                    {!! Form::open(['route' => ['departments.destroy', $department->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('departments.show', [$department->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('departments.edit', [$department->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Вы уверены?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $departments->links() !!}
</div>
