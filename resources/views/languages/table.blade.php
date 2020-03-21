<div class="table-responsive">
    <table class="table" id="languages-table">
        <thead>
            <tr>
                <th>Наименование</th>
                <th colspan="3">Действие</th>
            </tr>
        </thead>
        <tbody>
        @foreach($languages as $language)
            <tr>
                <td>{{ $language->title }}</td>
                <td>
                    {!! Form::open(['route' => ['languages.destroy', $language->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('languages.show', [$language->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('languages.edit', [$language->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Вы уверены?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
