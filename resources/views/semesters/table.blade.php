<div class="table-responsive">
    <table class="table" id="semesters-table">
        <thead>
            <tr>
                <th>Уч.год</th>
        <th>Наименование</th>
        <th>Начало</th>
        <th>Конец</th>
        <th>Текущий семестр</th>
        <th>Руб.контроль</th>
                <th colspan="3">Действие</th>
            </tr>
        </thead>
        <tbody>
        @foreach($semesters as $semester)
            <tr>
                <td>{{ $semester->year_id }}</td>
            <td>{{ $semester->title }}</td>
            <td>{{ $semester->start }}</td>
            <td>{{ $semester->end }}</td>
                <td>
{{--                <input type="checkbox" id="customSwitches">--}}
                <input type="checkbox" class="currentSemester" data-toggle="toggle" data-id="{{$semester->id}}" {{$semester->current != 0 ? 'checked' : ''}} data-onstyle="success" data-offstyle="danger" data-size="xs">
            </td>
            <td>
{{--                {{Form::open(['route' => ['step-semester', $semester->id], 'method' => 'post'])}}--}}
                    <select name="step" class="form-control w-25 stepSelect" data-id="{{$semester->id}}">
                            @if($semester->step == 0)
                            <option selected value="{{$semester->step}}">Закрыт доступ</option>
                            <option value="1">1 руб.контр</option>
                            <option value="2">2 руб.контр</option>
                                @endif
                            @if($semester->step == 1)
                                <option selected value="{{$semester->step}}">1 руб.контр</option>
                                    <option value="0">Закрыт доступ</option>
                                    <option value="2">2 руб.контр</option>
                                @endif
                            @if($semester->step == 2)
                                <option selected value="{{$semester->step}}">2 руб.контр</option>
                                    <option value="1">1 руб.контр</option>
                                    <option value="0">Закрыт доступ</option>
                                @endif

                    </select>
{{--                {{Form::close()}}--}}
            </td>
                <td>
                    {!! Form::open(['route' => ['semesters.destroy', $semester->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('semesters.show', [$semester->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('semesters.edit', [$semester->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Вы уверены?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $semesters->links() !!}
</div>
