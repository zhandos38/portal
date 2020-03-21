<div class="table-responsive">
    <table class="table" id="nationalities-table">
        <thead>
            <tr>
                <th>Наименование</th>
                <th colspan="3">Действия</th>
            </tr>
        </thead>
        <tbody>
        @foreach($nationalities as $nationality)
            <tr>
                <td>{{ $nationality->title }}</td>
                <td>
                    {!! Form::open(['route' => ['nationalities.destroy', $nationality->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('nationalities.show', [$nationality->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('nationalities.edit', [$nationality->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Вы уверены?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
