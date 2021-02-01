@extends('layouts.app')
@inject('model','App\User')
@section('page_title')
   change password
@endsection
@section('content')

    <!-- Main content -->
    <section class="content">

    {{-- widget--}}


    <!-- Default box -->
        <div class="box">
            {{----}}
            <div class="box-header with-border">
                <h3 class="box-title"><p>change password </p></h3>
            </div>
            <div class="box-body">
                @include('flash::message')
                @include('user.form_password')
                @include('partials.validation_errors')
            </div>
            <!-- /.box-body -->

            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->


@endsection
