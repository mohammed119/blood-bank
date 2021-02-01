@extends('layouts.app')
@inject('model','App\Governorate')
@section('page_title')
اضافة محافظة@endsection



@section('content')

    <!-- Main content -->
    <section class="content">

    {{-- widget--}}


    <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><p>اضافة محافظة جديدة</p></h3>
            </div>
            <div class="box-body">

            @include('partials.validation_errors')


            {!!Form::model($model,['action'=>'GovernorateController@store']) !!}

            @include('governorate.form')

            </div>
            <!-- /.box-body -->

            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->


@endsection
