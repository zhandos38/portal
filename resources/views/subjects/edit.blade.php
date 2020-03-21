@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Дисциплина
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($subject, ['route' => ['subjects.update', $subject->id], 'method' => 'patch']) !!}

                        @include('subjects.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
