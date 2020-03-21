<div class="table-responsive">
    <table class="table" id="shedules-table">
        <thead>
        <tr>
            <th>Семестр</th>
            <th>Группа</th>
            <th>Тьютор</th>
            <th>Дисциплина</th>
            <th>Тип занятия</th>
            <th>День</th>
            <th>Начало</th>
            <th>Конец</th>
            <th>Кабинет</th>
            <th colspan="3">Действие</th>
        </tr>
        </thead>
        <tbody>
        @foreach($shedules as $shedule)
            <tr>
                <td>{{ $shedule->semesters->title }}</td>
                <td>{{ $shedule->groups->title }}</td>
                <td>{{ $shedule->teachers->login }}</td>
                <td>{{ $shedule->subjects->title }}</td>
                <td>{{ $shedule->lessons->title }}</td>
                <td>{{ $shedule->days->title }}</td>
                <td>{{ $shedule->start }}</td>
                <td>{{ $shedule->end }}</td>
                <td>{{ $shedule->cabinet }}</td>
                <td>
                    {!! Form::open(['route' => ['shedules.destroy', $shedule->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('shedules.show', [$shedule->id]) }}" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('shedules.edit', [$shedule->id]) }}" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $shedules->links() !!}
</div>
