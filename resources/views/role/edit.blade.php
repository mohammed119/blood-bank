@extends('layouts.app')
{{--@inject('model','App\Role')--}}
@section('page_title')
    Edit Role
@endsection

@section('small_title')
    edit role
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">

    {{-- widget--}}


    <!-- Default box -->
        <div class="box">
            {{--<div class="box-header with-border">--}}
                {{--<h3 class="box-title"><p>edit role</p></h3>--}}
            {{--</div>--}}
            <div class="box-body">
                {!!Form::model($model,[
                'action'=>['RoleController@update',$model->id],
                'method'=>'put'
                ]) !!}
                @include('flash::message')

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
