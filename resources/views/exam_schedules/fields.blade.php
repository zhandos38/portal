<!-- Semester Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('semester_id', 'Семестр:') !!}
    {!! Form::select('semester_id',\App\Models\Semester::pluck("title","id")->prepend('Не выбрано' , '')->all() ,null, ['class' => 'form-control select2 exam-semester' , "style"=>"width:98%"]) !!}
</div>

<!-- Subject Id Field -->
<div class="form-group col-sm-6 exam-subject" hidden>
    {!! Form::label('subject_id', 'Дисциплина:') !!}
    {!! Form::select('subject_id',["0"=>"Не выбрано","1"=>"2"] ,null, ['class' => 'form-control select2 exam-subjects' , "style"=>"width:98%"]) !!}
</div>

<!-- Group Id Field -->
<div class="form-group col-sm-6 exam-group" hidden>
    {!! Form::label('group_id', 'Группа:') !!}
    {!! Form::select('group_id',["0"=>"Не выбрано","1"=>"2"] ,null, ['class' => 'form-control select2 exam-groups' , "style"=>"width:98%"]) !!}
</div>

<!-- Type Id Field -->
<div class="form-group col-sm-6 exam-type" hidden>
    {!! Form::label('type_id', 'Тип экзамена:') !!}
    {!! Form::select('type_id', ["0"=>"Не выбрано"], null, ['class' => 'form-control select2 exam-types' , "style"=>"width:98%"]) !!}
</div>

<!-- Quiz Id Field -->
<div class="form-group col-sm-6 exam-test" hidden>
    {!! Form::label('quiz_id', 'Тест:') !!}
    {!! Form::select('quiz_id', ["0"=>"Не выбрано"],null, ['class' => 'form-control select2 exam-tests' , "style"=>"width:98%"]) !!}
</div>

<!-- Start Field -->
<div class="form-group col-sm-6 exam-start" hidden>
    {!! Form::label('start', 'Начало:') !!}
    {!! Form::text('start', null, ['class' => 'form-control exam-starts datetimepicker',"autocomplete"=>"off",]) !!}
</div>

<!-- End Field -->
<div class="form-group col-sm-6 exam-end" hidden>
    {!! Form::label('end', 'Конец:') !!}
    {!! Form::text('end', null, ['class' => 'form-control exam-ends datetimepicker',"autocomplete"=>"off"]) !!}
</div>

<!-- Time Field -->
<div class="form-group col-sm-6 exam-time" hidden>
    {!! Form::label('time', 'Время сдачи(минут):') !!}
    {!! Form::text('time', null, ['class' => 'form-control exam-times']) !!}
</div>

<!-- Cabinet Field -->
<div class="form-group col-sm-6 exam-cabinet" hidden>
    {!! Form::label('cabinet', 'Кабинет:') !!}
    {!! Form::text('cabinet', null, ['class' => 'form-control exam-cabinets']) !!}
</div>

<!-- Active Field -->
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('active', 'Активность:') !!}--}}
{{--    {!! Form::text('active', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Сохранить', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('examSchedules.index') }}" class="btn btn-default">Отмена</a>
</div>
