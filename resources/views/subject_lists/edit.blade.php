@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Список дисциплин
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($subjectList, ['route' => ['subjectLists.update', $subjectList->id], 'method' => 'patch']) !!}

                        @include('subject_lists.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
