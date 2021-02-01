@extends('layouts.app')
{{--@inject('model','App\Governorate')--}}
@section('page_title')
    Edit City
@endsection

@section('small_title')
    edit city
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">

    {{-- widget--}}


    <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><p>edit city</p></h3>
            </div>
            <div class="box-body">
                {!!Form::model($model,[
                'action'=>['CityController@update',$model->id],
                'method'=>'put'
                ]) !!}
                @include('flash::message')

                @include('city.form')

                @include('partials.validation_errors')
            </div>
            <!-- /.box-body -->

            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->


@endsection
