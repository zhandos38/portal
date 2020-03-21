<div class="table-responsive">
    <table class="table" id="userInfos-table">
        <thead>
            <tr>
                <th>Логин</th>
        <th>Имя</th>
        <th>Фамилия</th>
        <th>Отчество</th>
        <th>Адрес</th>
        <th>Номер</th>
                <th colspan="3">Действие</th>
            </tr>
        </thead>
        <tbody>
        @foreach($userInfos as $userInfo)
            <tr>
                <td>{{ $userInfo->user_id }}</td>
            <td>{{ $userInfo->firstName }}</td>
            <td>{{ $userInfo->lastName }}</td>
            <td>{{ $userInfo->middleName }}</td>
            <td>{{ $userInfo->address }}</td>
            <td>{{ $userInfo->phone }}</td>
                <td>
                    {!! Form::open(['route' => ['userInfos.destroy', $userInfo->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('userInfos.show', [$userInfo->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('userInfos.edit', [$userInfo->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Вы уверены?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
