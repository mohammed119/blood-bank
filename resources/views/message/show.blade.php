@extends('layouts.app')

@section('page_title')
    Show Message
@endsection

@section('small_title')
    show message
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">

    {{-- widget--}}


    <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><p>show message</p></h3>
            </div>
            <div class="box-body">

                <div class="card">
                    {{--<h5 class="card-header">Featured</h5>--}}
                    <div class="card-body">
                        <h3 class="card-title">Message Name</h3>
                        <p class="card-text">{{$model->message_name}}</p>
                        <h3 class="card-title">Message Content</h3>
                        <p class="card-text">{{$model->message_content}}</p>
                        <h3 class="card-title">sender name</h3>
                        <p class="card-text">{{$model->client->name}}</p>

                    </div>
                </div>



            </div>
            <!-- /.box-body -->

            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->


@endsection
