@extends('layouts.app')
{{--@inject('model','App\Role')--}}
@section('page_title')
    Edit User
@endsection

@section('small_title')
    edit user
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">

    {{-- widget--}}


    <!-- Default box -->
        <div class="box">
            {{--<div class="box-header with-border">--}}
                {{--<h3 class="box-title"><p>edit user</p></h3>--}}
            {{--</div>--}}
            <div class="box-body">
                {!!Form::model($model,[
                'action'=>['UserController@update',$model->id],
                'id'=>'myForm',
                'role'=>'form',
                'method'=>'put'
                ]) !!}
                @include('flash::message')

                @include('user.form')

                @include('partials.validation_errors')
            </div>
            <!-- /.box-body -->

            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->


@endsection