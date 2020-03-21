<!-- Role Id Field -->
<div class="form-group">
    {!! Form::label('role_id', 'Роль:') !!}
    <p>{{ $user->roles->title }}</p>
</div>

<!-- Login Field -->
<div class="form-group">
    {!! Form::label('login', 'Логин:') !!}
    <p>{{ $user->login }}</p>
</div>

<!-- Faculty Id Field -->
<div class="form-group">
    {!! Form::label('faculty_id', 'Факультет:') !!}
    <p>{{ $user->faculty_id != 0 ? $user->faculties->title : 'Нет' }}</p>
</div>

<!-- Department Id Field -->
<div class="form-group">
    {!! Form::label('department_id', 'Кафедра:') !!}
    <p>{{ $user->department_id != 0 ? $user->departments->title : 'Нет' }}</p>
</div>

<!-- Group Id Field -->
<div class="form-group">
    {!! Form::label('group_id', 'Группа:') !!}
    <p>{{ $user->group_id != 0 ? $user->groups->title : 'Нет' }}</p>
</div>


