@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Национальность
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($nationality, ['route' => ['nationalities.update', $nationality->id], 'method' => 'patch']) !!}

                        @include('nationalities.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
