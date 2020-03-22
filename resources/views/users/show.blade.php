@extends('layouts.app')

@section('content')
    <section class="content">

        <div class="row">
            <div class="col-md-4">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">

                        <h3 class="profile-username text-center">{{$user->infos != null ? $user->infos->firstName : $user->login}}</h3>

                        <p class="text-muted text-center">{{$user->infos != null ? $user->infos->lastName : ''}} {{$user->infos != null ? $user->infos->middleName : ''}}</p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Роль:</b> <a class="pull-right">{{ $user->roles->title }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Факультет:</b> <a class="pull-right">{{ !empty($user->faculties) ? $user->faculties->title : 'Нет' }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Кафедра:</b> <a class="pull-right">{{ !empty($user->departments) ? $user->departments->title : 'Нет' }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Группа:</b> <a class="pull-right">{{ !empty($user->groups) ? $user->groups->title : 'Нет' }}</a>
                            </li>
                        </ul>

                        <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#settings" data-toggle="tab">Личная информация</a></li>
                    </ul>
                    @if($user->infos)
                    <div class="tab-content">
                        <div class="active tab-pane" id="settings">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Имя</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" readonly value="{{ $user->infos->firstName }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Фамилия</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" readonly value="{{ $user->infos->lastName }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Отчество</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" readonly value="{{ $user->infos->middleName }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Адрес</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" readonly value="{{ $user->infos->address }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Номер телефона</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" readonly value="{{ $user->infos->phone }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" readonly value="{{ $user->infos->email }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Дата рождения</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" readonly value="{{ $user->infos->birthDay }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Пол</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" readonly value="{{ $user->infos->gender }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Национальность</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" readonly value="{{ $user->infos->nationality }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">№ удостоверение</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" readonly value="{{ $user->infos->idCard }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">ИИН</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" readonly value="{{ $user->infos->iin }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Номер зачётной книжки</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" readonly value="{{ $user->infos->cardNumber }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Гражданство</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" readonly value="{{ $user->infos->citizen }}">
                                    </div>
                                </div>

                            </form>

                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    @else
                        <a href="{{route('usersId', [$user->id])}}" class="btn btn-outline-success">Заполнить</a>
                    @endif
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
@endsection
