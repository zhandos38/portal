@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Расписание
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($shedule, ['route' => ['shedules.update', $shedule->id], 'method' => 'patch']) !!}

                        @include('shedules.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
