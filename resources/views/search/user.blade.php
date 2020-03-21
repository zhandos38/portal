@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Пользователи</h1>
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('users.create') }}">Добавить</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table" id="users-table">
                        <thead>
                        <tr>
                            <th>Роль</th>
                            <th>Логин</th>
                            <th>Факультет</th>
                            <th>Кафедра</th>
                            <th>Группа</th>
                            <th colspan="3">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->roles->title }}</td>
                                <td>{{ $user->login }}</td>
                                <td>{{ $user->faculty_id != 0 ? $user->faculties->title : "Нет"  }}</td>
                                <td>{{ $user->department_id != 0 ? $user->departments->title :"Нет" }}</td>
                                <td>{{ $user->group_id !=0 ? $user->groups->title : "Нет" }}</td>
                                <td>
                                    {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                                    <div class='btn-group'>
                                        <a href="{{ $user->user_info != null ? route('userInfos.edit', [$user->user_info->id]): route('userInfos.create',["id"=>$user->id]) }}" class='btn btn-default btn-xs'><i class="fa fa-user-plus"></i></a>
                                        <a href="{{ route('users.show', [$user->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                                        <a href="{{ route('users.edit', [$user->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                    </div>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

