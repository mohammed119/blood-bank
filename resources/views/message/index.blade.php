@inject('clients','App\Client')
@php
    $clients=$clients->pluck('name','id')->toArray();
@endphp

@extends('layouts.app')

@section('page_title')
    Message
@endsection

@section('small_title')
    list of message
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">

    {{-- widget--}}
        <div class="box-header with-border">

            @include('message.form')



            {{--{!! Form::open(['method'=>'get']) !!}--}}
            {{--<div class="input-group">--}}
                {{--<div class="input-group-prepend">--}}
                    {{--<span class="input-group-text">keyword</span>--}}
                    {{--<input type="text" name="keyword" class="form-control">--}}
                {{--</div>--}}

                {{--<div class="input-group-prepend">--}}
                    {{--<span class="input-group-text " >client</span>--}}

                    {{--        {{$cities=\App\City::all()->pluck('id','name')}}--}}


                    {{--{!!Form::select('client_id',$clients->pluck('name','id'),null,[--}}

                    {{--{!!Form::select('client_id',$clients,request()->input('client_id'),[--}}
                                     {{--'class' =>' form-control',--}}
                                     {{--'placeholder'=>'select client'--}}
                                     {{--])!!}--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<button type="submit" class="btn btn-primary">search</button>--}}
            {{--{!! Form::close() !!}--}}



        </div>


        <!-- Default box -->

        <div class="box">

            {{--//--}}
            <div class="box-body">

                @include('flash::message')
                {{--table here--}}

                @if(count($records)> 0)
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>message name</th>
                                <th>client</th>
                                <th class="text-center">show</th>
                                <th class="text-center">delete</th>
                            </tr>
                            </thead>
                            <tbody>
{{--                            {{$flag=0}}--}}
                            @foreach($records as $record)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$record->message_name}}</td>
                                    {{--<td>{{optional($record->client)->name}}</td>--}}
                                    <td>{{$record->client->name}}</td>
                                    <td class="text-center"><a href="{{url(route('message.show',$record->id))}}"
                                        class="btn btn-primary btn-xs" ><i class="fa fa-eye"> </i></a></td>
                                    <td class="text-center">
                                        {!! Form::open([
                                           'action'=>['MessageController@destroy',$record->id],
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
