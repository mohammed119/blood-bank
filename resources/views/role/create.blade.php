@extends('layouts.app')
@inject('model','App\Role
')
@section('page_title')
     Create Role

@endsection

@section('small_title')
    create role
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">

    {{-- widget--}}


    <!-- Default box -->
        <div class="box">
            {{--<div class="box-header with-border">--}}
                {{--<h3 class="box-title"><p>create role</p></h3>--}}
            {{--</div>--}}
            <div class="box-body">
                {!!Form::model($model,['action'=>'RoleController@store']) !!}
               @include('role.form')

                @include('partials.validation_errors')
            </div>
            <!-- /.box-body -->

            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->


@endsection
