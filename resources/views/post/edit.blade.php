@extends('layouts.app')
{{--@inject('model','App\Governorate')--}}
@section('page_title')
    Edit Post
@endsection

@section('small_title')
    edit post
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">

    {{-- widget--}}


    <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><p>edit post</p></h3>
            </div>
            <div class="box-body">
                {!!Form::model($model,[
                'action'=>['PostController@update',$model->id],
                'method'=>'put',
                'files'=>true
                ]) !!}
                @include('flash::message')

                @include('post.form')

                @include('partials.validation_errors')
            </div>
            <!-- /.box-body -->

            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->


@endsection
