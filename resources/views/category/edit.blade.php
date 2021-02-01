@extends('layouts.app')
{{--@inject('model','App\Category')--}}
@section('page_title')
    Edit Category
@endsection

@section('small_title')
    edit category
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">

    {{-- widget--}}


    <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><p>edit category</p></h3>
            </div>
            <div class="box-body">
                {!!Form::model($model,[
                'action'=>['CategoryController@update',$model->id],
                'method'=>'put'
                ]) !!}
                @include('flash::message')

                @include('category.form')

                @include('partials.validation_errors')
            </div>
            <!-- /.box-body -->

            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->


@endsection
