<div class="table-responsive">
    <table class="table" id="assignments-table">
        <thead>
        <tr>
            <th>Семестр</th>
            <th>Группа</th>
            <th>Дисциплина</th>
            <th>Преподаватель</th>
            <th>Студент</th>
            <th>1 Рубежка</th>
            <th>2 Рубежка</th>
            <th>Экзамен</th>
            <th>Общий рейтинг</th>
        </tr>
        </thead>
        <tbody>
        @foreach($assignments as $assignment)
            <tr>
                <td>{{ $assignment->semester->title }}</td>
                <td>{{ $assignment->group->title }}</td>
                <td>{{ $assignment->subject->title }}</td>
                <td>{{ $assignment->teacher->infos->lastName}} {{ $assignment->teacher->infos->firstName}} {{ $assignment->teacher->infos->middleName}}</td>
                <td>{{ $assignment->student->login}}</td>
                <td>{{ $assignment->first_rating }}</td>
                <td>{{ $assignment->second_rating }}</td>
                <td>{{ $assignment->exam_rating }}</td>
                <td>{{ $assignment->total_rating }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
