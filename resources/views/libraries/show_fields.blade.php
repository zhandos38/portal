<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Наименование:') !!}
    <p>{{ $library->title }}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Описание:') !!}
    <p>{{ $library->description }}</p>
</div>

<!-- Src Field -->
<div class="form-group">
    {!! Form::label('src', 'Файл:') !!}
    <p><a href="{{ route('libraries.download', [$library->id]) }}" class='btn btn-default btn-xs' download><i class="fa fa-cloud-download"></i></a></p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'Пользователь:') !!}
    <p>{{ $library->user->login }}</p>
</div>

