@extends('layouts.app')
@inject('model','App\User
')
@section('page_title')
     Create User

@endsection

@section('small_title')
    create user
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">

    {{-- widget--}}


    <!-- Default box -->
        <div class="box">
            {{--<div class="box-header with-border">--}}
                {{--<h3 class="box-title"><p>create user</p></h3>--}}
            {{--</div>--}}
            <div class="box-body">
                {!!Form::model($model,['action'=>'UserController@store']) !!}
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
