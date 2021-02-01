@extends('layouts.app')
{{--@inject('model','App\Role')--}}
@section('page_title')
    log in
@endsection

@section('small_title')
    log in
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">

    {{-- widget--}}

    {{--@inject('users','App\User)--}}
    @inject('model','App\User)

    <!-- Default box -->
        <div class="box">
            {{--<div class="box-header with-border">--}}
                {{--<h3 class="box-title"><p>edit user</p></h3>--}}
            {{--</div>--}}
            <div class="box-body">
                {!!Form::model($model,[
                'action'=>['UserController@login'],
                'method'=>'post'
                ]) !!}
                @include('flash::message')

                <div class="form-group">
                    <label for="email">email</label>
                    {!!Form::text('email',null,['class'=>'form-control'])!!}
                </div>
                <div class="form-group">
                    <label for="password">password</label>
                    {!!Form::password('password',['class'=>'form-control'])!!}
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">log in</button>

                </div>

                {!!Form::close() !!}
                @include('partials.validation_errors')

                {{--@include('user.form')--}}

            </div>
            <!-- /.box-body -->

            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->


@endsection