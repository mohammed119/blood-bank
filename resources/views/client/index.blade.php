@extends('layouts.app')

@section('page_title')
    Client
@endsection

@section('small_title')
    list of client
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">

    {{-- widget--}}


    <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><p>list of client</p></h3>
            </div>
            <div class="box-header with-border">
               @include('client.form')
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
                                <th>phone</th>
                                <th>email</th>
                                <th>birth date</th>
                                <th>city</th>
                                <th>blood type</th>
                                <th>last date donation</th>
                                <th class="text-center">activated</th>

                                <th class="text-center">delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($records as $record)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$record->name}}</td>
                                    <td>{{$record->phone}}</td>
                                    <td>{{$record->email}}</td>
                                    <td>{{$record->birth_date}}</td>
                                    <td>{{$record->city->name}}</td>
                                    <td>{{$record->bloodType->name}}</td>
                                    {{--<td>{{$record->last_date_donate[$record->id]}}</td>--}}
                                    <td>{{$record->last_date_donate}}</td>

                                    <td class="text-center">
                                        @if($record->is_active)
                                            <a href="client/{{$record->id}}/deactivate" class="btn btn-xs btn-danger"><i class="fa fa-close"></i> deactivate</a>
                                        @else
                                            <a href="client/{{$record->id}}/activate" class="btn btn-xs btn-success"><i class="fa fa-check"></i> activate</a>
                                        @endif
                                    </td>

                                    {{--<td class="text-center" >--}}
                                        {{--{!! Form::open([--}}
                                       {{--'action'=>['ClientController@activateClient'],--}}
                                       {{--'method'=>'post'--}}
                                   
                                        {{--{!!Form::checkbox('is_active',$record->id,$record->is_active)!!}--}}
                                        {{--<input type="checkbox" name="is_active" value="is_active"></td>--}}
                                       
                                        {{--{!!Form::checkbox('is_active','is_active',$record->is_active)!!}--}}
                                        {{--{!! Form::close() !!}--}}
                                    </td>
                                     {{--class="btn btn-success btn-xs" ><i class="fa fa-edit"> </i></a></td>--}}
                                    {{--<td class="text-center">--}}
                                    <td class="text-center">
                    {!! Form::open([
                        'action' => ['ClientController@destroy',$record->id],
                        'method' => 'delete'
                      ]) !!}
                      <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                    {!! Form::close() !!}

                                     
                            @endforeach
                            
                            </tbody>
                            {{--<button type="submit" class="btn btn-success">Save Changes</button>--}}
                           {!! Form::close() !!}
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
