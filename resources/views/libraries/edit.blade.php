@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Библиотека
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($library, ['route' => ['libraries.update', $library->id], 'method' => 'patch',"files"=>true]) !!}

                        @include('libraries.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
