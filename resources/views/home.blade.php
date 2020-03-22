@extends('layouts.app')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="col-md-12">
            <div class="callout callout-info">
                <h3>Привет, {{\Illuminate\Support\Facades\Auth::user()->login}}!</h3>
            </div>
        </div>
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">

                        <h3>{{\App\Models\Faculty::all()->count()}}</h3>

                        <p>Факультета</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-building"></i>
                    </div>
                    <div class="small-box-footer"> <i class="fa fa-building"></i></div>

                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{\App\Models\Department::all()->count()}}</h3>

                        <p>Кафедры</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-institution"></i>
                    </div>
                    <div class="small-box-footer"> <i class="fa fa-institution"></i></div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{\App\Models\Group::all()->count()}}</h3>

                        <p>Группы</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-sitemap"></i>
                    </div>
                    <div class="small-box-footer"> <i class="fa fa-sitemap"></i></div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{\App\Models\User::all()->count()}}</h3>

                        <p>Пользователей</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="small-box-footer"><i class="fa fa-users"></i></div>
                </div>
            </div>
            <!-- ./col -->
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{\App\Models\Subject::all()->count()}}</h3>
                        <p>Дисциплины</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-book"></i>
                    </div>
                    <div class="small-box-footer"><i class="fa fa-book"></i></div>
                </div>
            </div>
            <!-- ./col -->
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3>{{\App\Models\Language::all()->count()}}</h3>
                        <p>Языка обучения</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-language"></i>
                    </div>
                    <div class="small-box-footer"><i class="fa fa-language"></i></div>
                </div>
            </div>
            <!-- ./col -->
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{\App\Models\Library::all()->count()}}</h3>
                        <p>Учебно-справочных материалов</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-book"></i>
                    </div>
                    <div class="small-box-footer"><i class="fa fa-book"></i></div>
                </div>
            </div>
            <!-- ./col -->
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{\App\Models\User::where("role_id",5)->get()->count()}}</h3>
                        <p>Активных студентов</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="small-box-footer"><i class="fa fa-user"></i></div>
                </div>
            </div>
            <!-- ./col -->
        </div>


        <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
@endsection
