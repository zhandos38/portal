@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Тип занятия
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($lessonType, ['route' => ['lessonTypes.update', $lessonType->id], 'method' => 'patch']) !!}

                        @include('lesson_types.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
