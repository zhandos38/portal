@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Язык обучения
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($language, ['route' => ['languages.update', $language->id], 'method' => 'patch']) !!}

                        @include('languages.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
