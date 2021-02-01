@extends('layouts.app')

@section('page_title')
    Show Post
@endsection

@section('small_title')
    show post
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">

    {{-- widget--}}


    <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><p>show post</p></h3>
            </div>
            <div class="box-body">

                <div class="card">
                    {{--<h5 class="card-header">Featured</h5>--}}
                    <div class="card-body">
                        <h3 class="card-title">Title</h3>
                        <p class="card-text">{{$model->title}}</p>
                        <h3 class="card-title">Text</h3>
                        <p class="card-text">{{$model->text}}</p>
                        <h3 class="card-title">Category</h3>
                        <p class="card-text">{{$model->category->name}}</p>
                        <img src="{{asset('/image/'.$model->image)}}" class="card-img-top" alt="no image" >

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
