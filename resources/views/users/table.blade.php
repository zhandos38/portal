<div class="table-responsive">
{{--    <select id="myInput" class="form-control" onchange="myFunction()">--}}
{{--        <option value="">Выберите роль</option>--}}
{{--        @foreach($roles as $role)--}}
{{--            <option value="{{$role['title']}}">{{$role['title']}}</option>--}}
{{--        @endforeach--}}
{{--    </select>--}}

    <table class="table table-striped table-bordered table-sm myTable" id="users-table">
        <thead>
        <tr>
            <th>Роль</th>
            <th>Логин</th>
            <th>Факультет</th>
            <th>Кафедра</th>
            <th>Группа</th>
            <th colspan="3">Действие</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->roles->title }}</td>
                <td>{{ $user->login }}</td>
                <td>{{ $user->faculty_id != null ? $user->faculties->title : 'Нет указано'}}</td>
                <td>{{ $user->department_id != null ? $user->departments->title : 'Нет указано' }}</td>
                <td>{{ !empty($user->groups) ? $user->groups->title : 'Нет указано'}}</td>
                <td>
                    {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        @if($user->role_id == 5)
                        <a href="{{ route('users.expel', [$user->id]) }}" onclick="return confirm('Вы уверены')" class='btn {{$user->expelled ? "btn-success" :"btn-danger"}} btn-xs'><i
                                class="{{$user->expelled ? "fa fa-thumbs-o-up" :"fa fa-ban"}}"></i></a>
                        @endif
                        <a href="{{ route('users.show', [$user->id]) }}" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('users.edit', [$user->id]) }}" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Вы уверены?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $users->links() !!}
</div>
