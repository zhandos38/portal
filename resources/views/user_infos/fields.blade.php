<!-- User Id Field -->
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('user_id', 'Логин:') !!}--}}
    {!! Form::hidden('user_id', $user->id, ['class' => 'form-control']) !!}
{{--</div>--}}

<!-- Firstname Field -->
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

<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', 'Адрес:') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone', 'Номер телефона:') !!}
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
    {!! Form::label('gender', 'Пол:') !!}
    {!! Form::select('gender', ['мужской' => 'мужской', 'женский' => 'женский'], null, ['class' => 'form-control']) !!}
</div>
<!-- Gender Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date', 'Дата поступления:') !!}
    {!! Form::text('date', null, ['class' => 'form-control']) !!}
</div>

<!-- Nationality Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nationality', 'Национальность:') !!}
    {!! Form::text('nationality', null, ['class' => 'form-control']) !!}
</div>

<!-- Idcard Field -->
<div class="form-group col-sm-6">
    {!! Form::label('idCard', '№ удостоверение:') !!}
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
    {!! Form::label('citizen', 'Гражданство:') !!}
    {!! Form::text('citizen', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Сохранить', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('users.index') }}" class="btn btn-default">Отмена</a>
</div>
