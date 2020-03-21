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
            <th>Активность</th>
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
                <td>{{ $examSchedule->active != 0 ? "Активный" : "Не активный" }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
