@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Вопрос
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($question, ['route' => ['questions.update', $question->id], 'method' => 'patch']) !!}

                        @include('questions.fields')

                        {!! Form::reset("Сброс", ['class' => 'btn btn-default']) !!}
                        {!! Form::submit("Обновить", ['class' => 'btn btn-wave']) !!}
                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
