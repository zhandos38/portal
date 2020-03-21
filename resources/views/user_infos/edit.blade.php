@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Личная информация
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($userInfo, ['route' => ['userInfos.update', $userInfo->id], 'method' => 'patch']) !!}

                        @include('user_infos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
