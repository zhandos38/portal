<!-- Semester Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('semester_id', 'Семестр:') !!}
    {!! Form::select('semester_id',$semesters ,null, ['class' => 'form-control select2','style'=>"width:98%"]) !!}
</div>

<!-- Group Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('group_id', 'Группа:') !!}
    {!! Form::select('group_id',$groups ,null, ['class' => 'form-control select2','style'=>'width:98%']) !!}
</div>

<!-- Subject Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('subject_id', 'Дисциплина:') !!}
    {!! Form::select('subject_id',\App\Models\Subject::pluck("title","id")->prepend("Не выбранно",0)->all() ,null, ['class' => 'form-control select2','style'=>'width:98%']) !!}
</div>

<!-- Credits Field -->
<div class="form-group col-sm-6">
    {!! Form::label('credits', 'Кредиты:') !!}
    {!! Form::text('credits', null, ['class' => 'form-control']) !!}
</div>

<!-- Ects Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ECTS', 'ECTS:') !!}
    {!! Form::text('ECTS', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Сохранить', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('subjectLists.index') }}" class="btn btn-default">Отмена</a>
</div>
