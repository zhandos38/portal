<div class="table-responsive">
    <table class="table" id="libraries-table">
        <thead>
            <tr>
                <th>Наименование</th>
        <th>Описание</th>
        <th>Файл</th>
        <th>Пользователь</th>
                <th colspan="3">Действие</th>
            </tr>
        </thead>
        <tbody>
        @foreach($libraries as $library)
            <tr>
                <td>{{ $library->title }}</td>
            <td>{{ $library->description }}</td>
            <td> <a href="{{ route('libraries.download', [$library->id]) }}" class='btn btn-default btn-xs' download><i class="fa fa-cloud-download"></i></a></td>
            <td>{{ $library->user->login }}</td>
                <td>
                    {!! Form::open(['route' => ['libraries.destroy', $library->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('libraries.show', [$library->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('libraries.edit', [$library->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Вы уверены?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $libraries->links() !!}
</div>
