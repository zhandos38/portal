<div class="table-responsive">
    <table class="table" id="subjectLists-table">
        <thead>
            <tr>
                <th>Семестр</th>
        <th>Группа</th>
        <th>Дисциплина</th>
        <th>Студент</th>
        <th>Кредиты</th>
        <th>ECTS</th>
                <th colspan="3">Действия</th>
            </tr>
        </thead>
        <tbody>
        @foreach($subjectLists as $subjectList)
            <tr>
                <td>{{ $subjectList->semester->title }}</td>
            <td>{{ $subjectList->group->title }}</td>
            <td>{{ $subjectList->subject->title }}</td>
            <td>{{$subjectList->student->infos->lastName}} {{ $subjectList->student->infos->firstName }}</td>
            <td>{{ $subjectList->credits }}</td>
            <td>{{ $subjectList->ECTS }}</td>
                <td>
                    {!! Form::open(['route' => ['subjectLists.destroy', $subjectList->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('subjectLists.show', [$subjectList->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('subjectLists.edit', [$subjectList->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Вы уверены?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
