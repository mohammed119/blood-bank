@extends('layouts.app')
@inject('model','App\City')
@section('page_title')
     Create City
@endsection

@section('small_title')
    create city
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">

    {{-- widget--}}


    <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><p>create city</p></h3>
            </div>
            <div class="box-body">
                {!!Form::model($model,['action'=>'CityController@store']) !!}
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
