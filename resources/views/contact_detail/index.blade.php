@extends('layouts.app')
@section('page_title')
    Edit ContactDetail
@endsection

@section('small_title')
    edit contact_detail
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">

    {{-- widget--}}


    <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><p>edit contact_detail</p></h3>
            </div>
            <div class="box-body">
                {!!Form::model($model,[
                'action'=>['ContactDetailController@update',$model->id],
                'method'=>'put'
                ]) !!}
                @include('flash::message')

                @include('contact_detail.form')

                @include('partials.validation_errors')
            </div>
            <!-- /.box-body -->

            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->


@endsection
