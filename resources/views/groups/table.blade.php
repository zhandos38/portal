<div class="table-responsive">
    <table class="table" id="groups-table">
        <thead>
            <tr>
                <th>Кафедра</th>
        <th>Наименование</th>
        <th>Язык обучения</th>
        <th>Тип обучения</th>
                <th colspan="3">Действие</th>
            </tr>
        </thead>
        <tbody>
        @foreach($groups as $group)
            <tr>
                <td>{{ !empty($group->departments) ? $group->departments->title : 'Не указано' }}</td>
                <td>{{ !empty($group->title) ? $group->title : 'Не указано' }}</td>
                <td>{{ !empty($group->languages) ? $group->languages->title : 'Не указано' }}</td>
                <td>{{ $group->educations->title }}</td>
                <td>
                    {!! Form::open(['route' => ['groups.destroy', $group->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('groups.show', [$group->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('groups.edit', [$group->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Вы уверены?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $groups->links() !!}
</div>
