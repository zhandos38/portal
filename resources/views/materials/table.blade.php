<div class="table-responsive">
    <table class="table" id="materials-table">
        <thead>
            <tr>
                <th>Семестр</th>
        <th>Группа</th>
        <th>Преподаватель</th>
        <th>Дисциплина</th>
        <th>Файл</th>
        <th>Наименование</th>
        <th>Описание</th>
                <th colspan="3">Действие</th>
            </tr>
        </thead>
        <tbody>
        @foreach($materials as $material)
            <tr>
                <td>{{ $material->semester->title }}</td>
            <td>{{ $material->group->title }}</td>
            <td>{{ $material->teacher->login }}</td>
            <td>{{ $material->subject->title }}</td>
            <td><a href="{{ route('libraries.download', [$material->library->id]) }}" class='btn btn-default btn-xs' download><i class="fa fa-cloud-download"></i></a></td>
            <td>{{ $material->title }}</td>
            <td>{{ $material->description }}</td>
                <td>
                    {!! Form::open(['route' => ['materials.destroy', $material->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('materials.show', [$material->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('materials.edit', [$material->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Вы уверены?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $materials->links() !!}
</div>
