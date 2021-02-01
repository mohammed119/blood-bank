@extends('layouts.app')
@inject('model','App\Post')
@section('page_title')
     Create Post
@endsection

@section('small_title')
    create post
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">

    {{-- widget--}}


    <!-- Default box -->
        <div class="box">
            @include('partials.validation_errors')

            <div class="box-header with-border">
                <h3 class="box-title"><p>create post</p></h3>
            </div>
            <div class="box-body">
                {!!Form::model($model,['action'=>'PostController@store','files'=>true,'method'=>'post']) !!}
               @include('post.form')

                {{--<form method="post" action="post/store">--}}
                    {{--<div class="form-group">--}}
                        {{--<label for="title">Title</label>--}}
                        {{--<input type="text" name="title" class="form-control">--}}
                        {{--<label for="text">Text</label>--}}
                        {{--<input type="textarea" name="text" class="form-control">--}}
                        {{--<label for="image">image</label>--}}
                        {{--<input type="file" name="image" class="form-control-file">--}}
                        {{--<label for="category">Category</label>--}}
                        {{--<select class="form-control">--}}
                            {{--@foreach($categories as $category)--}}
                            {{--<option name="category_id">{{$category}}</option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                        {{--<div class="form-group">--}}
                            {{--<button class="btn btn-primary" type="submit">Submit</button>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</form>--}}

            </div>
            <!-- /.box-body -->

            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->


@endsection
