<!-- Role Id Field -->
@administrator
<div class="form-group col-sm-6">
    {!! Form::label('role_id', 'Роль:') !!}
    {!! Form::select('role_id',$roles,null, ['class' => 'form-control roles']) !!}
</div>
<!-- Faculty Id Field -->

<div class="form-group col-sm-6 faculty" {{$hidden == true ? "hidden" : ""}}>
    {!! Form::label('faculty_id', 'Факультет:') !!}
    {!! Form::select('faculty_id',$faculties, null, ['class' => 'form-control select2',"style"=>"width: 98%;"]) !!}
</div>
<!-- Department Id Field -->
<div class="form-group col-sm-6 department" {{$hidden == true ? "hidden" : ""}}>
    {!! Form::label('department_id', 'Кафедра:') !!}
    {!! Form::select('department_id',$departments, null, ['class' => 'form-control select2',"style"=>"width: 98%;"]) !!}
</div>
<!-- Group Id Field -->
<div class="form-group col-sm-6 group" {{$hidden == true ? "hidden" : ""}}>
    {!! Form::label('group_id', 'Группа:') !!}
    {!! Form::select('group_id',$groups, null, ['class' => 'form-control select2',"style"=>"width: 98%;"]) !!}
</div>
<!-- Login Field -->
<div class="form-group col-sm-6">
    {!! Form::label('login', 'Логин(ФИО):') !!}
    {!! Form::text('login', null, ['class' => 'form-control']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Пароль(Номер зачетной книжки или индивидуальный пароль):') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>


{{--User Info--}}
<!-- Firstname Field -->
<div class="col-md-12">
    <h2>Личная информация</h2>
    @if(!$userInfo)
        <div class="form-group col-sm-6">
            {!! Form::label('firstName', 'Имя:') !!}
            {!! Form::text('firstName', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Lastname Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('lastName', 'Фамилия:') !!}
            {!! Form::text('lastName', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Middlename Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('middleName', 'Отчество:') !!}
            {!! Form::text('middleName', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-sm-6">
            {!! Form::label('date', 'Дата поступления/начала работы:') !!}
            {!! Form::text('date', null, ['class' => 'form-control datepicker']) !!}
        </div>

        <!-- Address Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('address', 'Адрес:') !!}
            {!! Form::text('address', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Phone Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('phone', 'Телефон:') !!}
            {!! Form::text('phone', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Email Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('email', 'Email:') !!}
            {!! Form::email('email', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Birthday Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('birthDay', 'Дата рождения:') !!}
            {!! Form::text('birthDay', null, ['class' => 'form-control datepicker']) !!}
        </div>

        <!-- Gender Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('gender_id', 'Пол:') !!}
            {!! Form::select('gender_id',[
                0 => 'мужской',
                1 => 'женский'
            ], null, ['class' => 'form-control']) !!}
        </div>

        <!-- Nationality Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('nationality_id', 'Национальность:') !!}
            {!! Form::select('nationality_id', \App\Models\Nationality::pluck('title', 'id')->all() ,null, ['class' => 'form-control']) !!}
        </div>

        <!-- Idcard Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('idCard', 'Номер уд. личности:') !!}
            {!! Form::text('idCard', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Iin Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('iin', 'ИИН:') !!}
            {!! Form::text('iin', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Cardnumber Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('cardNumber', 'Номер зачетной книжки:') !!}
            {!! Form::text('cardNumber', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Citizen Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('country_id', 'Гражданство:') !!}
            {!! Form::select('country_id', \App\Models\Country::pluck('title', 'id')->all(), null, ['class' => 'form-control']) !!}
        </div>
    @elseif($userInfo)
        <div class="form-group col-sm-6">
            {!! Form::label('firstName', 'Имя:') !!}
            {!! Form::text('firstName', $userInfo->firstName, ['class' => 'form-control']) !!}
        </div>

        <!-- Lastname Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('lastName', 'Фамилия:') !!}
            {!! Form::text('lastName', $userInfo->lastName, ['class' => 'form-control']) !!}
        </div>

        <!-- Middlename Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('middleName', 'Отчество:') !!}
            {!! Form::text('middleName', $userInfo->middleName, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-sm-6">
            {!! Form::label('date', 'Дата поступления/начала работы:') !!}
            {!! Form::text('date', $userInfo->date, ['class' => 'form-control datepicker']) !!}
        </div>

        <!-- Address Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('address', 'Адрес:') !!}
            {!! Form::text('address', $userInfo->address, ['class' => 'form-control']) !!}
        </div>

        <!-- Phone Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('phone', 'Телефон:') !!}
            {!! Form::text('phone', $userInfo->phone, ['class' => 'form-control']) !!}
        </div>

        <!-- Email Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('email', 'Email:') !!}
            {!! Form::email('email', $userInfo->email, ['class' => 'form-control']) !!}
        </div>

        <!-- Birthday Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('birthDay', 'Дата рождения:') !!}
            {!! Form::text('birthDay', $userInfo->birthDay, ['class' => 'form-control datepicker']) !!}
        </div>

        <!-- Gender Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('gender_id', 'Пол:') !!}
            {!! Form::select('gender_id',[
                0 => 'мужской',
                1 => 'женский'
            ], null, ['class' => 'form-control']) !!}
        </div>

        <!-- Nationality Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('nationality_id', 'Национальность:') !!}
            {!! Form::select('nationality_id', \App\Models\Nationality::pluck('title', 'id')->all() ,null, ['class' => 'form-control']) !!}
        </div>

        <!-- Idcard Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('idCard', 'Номер уд. личности:') !!}
            {!! Form::text('idCard', $userInfo->idCard, ['class' => 'form-control']) !!}
        </div>

        <!-- Iin Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('iin', 'ИИН:') !!}
            {!! Form::text('iin', $userInfo->iin, ['class' => 'form-control']) !!}
        </div>

        <!-- Cardnumber Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('cardNumber', 'Номер зачетной книжки:') !!}
            {!! Form::text('cardNumber', $userInfo->cardNumber, ['class' => 'form-control']) !!}
        </div>

        <!-- Citizen Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('country_id', 'Гражданство:') !!}
            {!! Form::select('country_id', \App\Models\Country::pluck('title', 'id')->all(), null, ['class' => 'form-control']) !!}
        </div>
    @endif

</div>


<!-- User Info Field -->


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Далее', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('users.index') }}" class="btn btn-default">Отмена</a>
</div>
@endadministrator
{{----}}
