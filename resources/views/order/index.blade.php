@extends('layouts.app')

@section('page_title')
    Order
@endsection

@section('small_title')
    list of order
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">

    {{-- widget--}}


    <!-- Default box -->
        <div class="box">

            <div class="box-header with-border">
                @include('order.form')
            </div>

            <div class="box-body">

                @include('flash::message')
                {{--table here--}}

                @if(count($records))
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>name</th>
                                <th>blood type</th>
                                <th>hospital name</th>
                                <th>city</th>
                                <th class="text-center">show</th>
                                <th class="text-center">delete</th>
                            </tr>
                            </thead>
                            <tbody>
{{--                            {{$flag=0}}--}}
                            @foreach($records as $record)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$record->name}}</td>
                                    <td>{{$record->bloodType->name}}</td>
                                    <td>{{$record->hospital_name}}</td>
                                    <td>{{$record->city->name}}</td>
                                    <td class="text-center"><a href="{{url(route('order.show',$record->id))}}"
                                        class="btn btn-primary btn-xs" ><i class="fa fa-eye"> </i></a></td>
                                    <td class="text-center">
                                        {!! Form::open([
                                           'action'=>['OrderController@destroy',$record->id],
                                            'method'=>'delete'
                                        ]) !!}
                                        <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> </button>
                                        {!! Form::close() !!}
                                        {{--{{$flag=1}}--}}
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
