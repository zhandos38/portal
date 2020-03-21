<!-- Semester Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('semester_id', 'Семестр:') !!}
    {!! Form::select('semester_id',\App\Models\Semester::where("current",1)->pluck("title","id")->all(),null, ['class' => 'form-control material-semester select2',"style"=>"width:98%","default"]) !!}
</div>
<!-- -->
<div class="form-group col-sm-6">
    {!! Form::label('subject_id', 'Дисциплина:') !!}
    {!! Form::select('subject_id',$subjects ,null, ['class' => 'form-control select2 material-subject',"style"=>"width:98%"]) !!}
</div>

<!-- Group Id Field -->
<div class="form-group col-sm-6 material-group" hidden>
    {!! Form::label('group_id', 'Группа:') !!}
    {!! Form::select('group_id',["0"=>"Не выбранно"] ,null, ['class' => 'form-control select2 material-groups',"style"=>"width:98%"]) !!}
</div>



<div class="form-group col-sm-6 material-choose" hidden>
    {!! Form::label('', 'Способ загрузки:') !!}
    {!! Form::select("",[0=>"Не выбранно",1=>"Загрузить мои файлы",2=>"Загрузить из общей библиотеки"],null, ['class' => 'form-control material-chooses select2',"style"=>"width:98%"]) !!}
</div>


<!-- Library Id Field -->
<div class="form-group col-sm-6 material-library" hidden>
    {!! Form::label('library_id', 'Файл из библиотеки:') !!}
    {!! Form::select('library_id',["0"=>"Не выбранно"] ,null, ['class' => 'form-control select2 material-libraries',"style"=>"width:98%"]) !!}
</div>


<!-- Title Field -->
<div class="form-group col-sm-6 material-title" hidden>
    {!! Form::label('title', 'Наименование:') !!}
    {!! Form::text('title', null, ['class' => 'form-control material-titles']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6 material-description" hidden>
    {!! Form::label('description', 'Описание:') !!}
    {!! Form::text('description', null, ['class' => 'form-control material-descriptions']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Сохранить', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('materials.index') }}" class="btn btn-default">Назад</a>
</div>
