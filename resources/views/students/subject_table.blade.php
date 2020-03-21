<div class="table-responsive">
    <table class="table" id="examSchedules-table">
        <thead>
        <tr>
            <th>Семестр</th>
            <th>Дисциплина</th>
            <th>Группа</th>
            <th>Студент</th>
            <th>Кредиты</th>
            <th>ECTS</th>
        </tr>
        </thead>
        <tbody>
        @foreach($subjects as $subject)
            <tr>
                <td>{{ $subject->semester->title }}</td>
                <td>{{ $subject->subject->title }}</td>
                <td>{{ $subject->group->title }}</td>
                <td>{{ $subject->student->infos->lastName }} {{ $subject->student->infos->firstName }}</td>
                <td>{{ $subject->credits}}</td>
                <td>{{ $subject->ECTS }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
