@extends('layouts.app')

@section('page_title')
    Post
@endsection

@section('small_title')
    list of post
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">

        {{-- widget--}}


        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><p>list of post</p></h3>
            </div>
            <div class="box-body">

                <a href="{{url(route('post.create'))}}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> New Post </a>

                @include('flash::message')
                {{--table here--}}

                @if(count($records))
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>title</th>
                            <th class="text-center">show</th>
                            <th class="text-center">edit</th>
                            <th class="text-center">delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($records as $record)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$record->title}}</td>
                                <td class="text-center"><a href="{{url(route('post.show',$record->id))}}"
                                    class="btn btn-primary btn-xs" ><i class="fa fa-eye"> </i></a></td>
                                <td class="text-center"><a href="{{url(route('post.edit',$record->id))}}"
                                    class="btn btn-success btn-xs" ><i class="fa fa-edit"> </i></a></td>
                                <td class="text-center">
                                    {!! Form::open([
                                        'action'=>['PostController@destroy',$record->id],
                                        'method'=>'delete'
                                    ]) !!}
                                    <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> </button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                    there are no data here
                @endif

            </div>
            <!-- /.box-body -->

            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->


@endsection
