<div class="table-responsive">
    <table class="table" id="examSchedules-table">
        <thead>
        <tr>
            <th>Семестр</th>
            <th>Дисциплина</th>
            <th>Группа</th>
            <th>Тип</th>
            <th>Тест</th>
            <th>Начало</th>
            <th>Конец</th>
            <th>Время(мин.)</th>
            <th>Кабинет</th>
            @administrator
            <th>Активность</th>
            @endadministrator
            <th colspan="3">Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($examSchedules as $examSchedule)
            <tr>
                <td>{{ $examSchedule->semester->title }}</td>
                <td>{{ $examSchedule->subject->title }}</td>
                <td>{{ $examSchedule->group->title }}</td>
                <td>{{ $examSchedule->type->title }}</td>
                <td>{{ $examSchedule->quiz_id != 0 ? $examSchedule->quiz->title : "Нет" }}</td>
                <td>{{ $examSchedule->start }}</td>
                <td>{{ $examSchedule->end }}</td>
                <td>{{ $examSchedule->time }}</td>
                <td>{{ $examSchedule->cabinet }}</td>

                @administrator
                @if($examSchedule->type->id !=3)
                    <td>{{ $examSchedule->active != 0 ? "Активный" : "Не активный" }}</td>
                @else
                    <td><input type="checkbox" class="activeTest" data-id="{{$examSchedule->id}}" {{$examSchedule->active != 0 ? "checked": ""}} data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-size="xs"></td>
                @endif
                @endadministrator
                <td>
                    {!! Form::open(['route' => ['examSchedules.destroy', $examSchedule->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('examSchedules.show', [$examSchedule->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('examSchedules.edit', [$examSchedule->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Вы уверены?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $examSchedules->links() !!}
</div>
