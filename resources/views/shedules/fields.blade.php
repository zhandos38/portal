<!-- Semester Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('semester_id', 'Семестр:') !!}
    {!! Form::select('semester_id', \App\Models\Semester::pluck('title', 'id')->all(), null, ['class' => 'form-control']) !!}
</div>

<!-- Group Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('group_id', 'Группа:') !!}
    {!! Form::select('group_id', \App\Models\Group::pluck('title', 'id')->all(), null, ['class' => 'form-control select2', 'style' => 'width: 98%;']) !!}
</div>

<!-- Teacher Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('teacher_id', 'Преподаватель:') !!}
    {!! Form::select('teacher_id', \App\Models\User::getTeacher(\App\Models\User::where('role_id', 4)->get()), null, ['class' => 'form-control select2', 'style' => 'width: 98%;']) !!}
</div>

<!-- Subject Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('subject_id', 'Дисциплина:') !!}
    {!! Form::select('subject_id', \App\Models\Subject::pluck('title', 'id')->all(), null, ['class' => 'form-control select2', 'style' => 'width: 98%;']) !!}
</div>

<!-- Lesson Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lesson_id', 'Тип занятия:') !!}
    {!! Form::select('lesson_id', \App\Models\LessonType::pluck('title', 'id')->all(), null, ['class' => 'form-control select2', 'style' => 'width: 98%;']) !!}
</div>

<!-- Day Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('day_id', 'День:') !!}
    {!! Form::select('day_id', \Illuminate\Support\Facades\DB::table('days')->pluck('title', 'id')->all(), null, ['class' => 'form-control select2', 'style' => 'width: 98%;']) !!}
</div>

<!-- Start Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start', 'Начало:') !!}
    {!! Form::text('start', null, ['class' => 'form-control timepicker']) !!}
</div>

<!-- End Field -->
<div class="form-group col-sm-6">
    {!! Form::label('end', 'Конец:') !!}
    {!! Form::text('end', null, ['class' => 'form-control timepicker']) !!}
</div>

<!-- Cabinet Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cabinet', 'Аудитория:') !!}
    {!! Form::text('cabinet', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Сохранить', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('shedules.index') }}" class="btn btn-default">Отмена</a>
</div>
