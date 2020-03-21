@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Рейтинг
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($assignment, ['route' => ['assignments.update', $assignment->id], 'method' => 'patch']) !!}

                        @include('assignments.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
