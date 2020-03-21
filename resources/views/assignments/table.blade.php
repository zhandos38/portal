<div class="table-responsive">
    <table class="table" id="assignments-table">
        <thead>
            <tr>
                <th>Семестр</th>
        <th>Группа</th>
        <th>Дисциплина</th>
        <th>Препод</th>
        <th>Студент</th>
        <th>1 рубежка</th>
        <th>2 рубежка</th>
        <th>Экзамен</th>
        <th>Общий рейтинг</th>
                <th colspan="3">Действие</th>
            </tr>
        </thead>
        <tbody>
        @foreach($assignments as $assignment)
            <tr>
                <td>{{ $assignment->semester_id }}</td>
            <td>{{ $assignment->group_id }}</td>
            <td>{{ $assignment->subject_id }}</td>
            <td>{{ $assignment->teacher_id }}</td>
            <td>{{ $assignment->student_id }}</td>
            <td>{{ $assignment->first_rating }}</td>
            <td>{{ $assignment->second_rating }}</td>
            <td>{{ $assignment->exam_rating }}</td>
            <td>{{ $assignment->total_rating }}</td>
                <td>
                    {!! Form::open(['route' => ['assignments.destroy', $assignment->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('assignments.show', [$assignment->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('assignments.edit', [$assignment->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Вы уверены?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
