@extends('layouts.app')

@section('page_title')
    User
@endsection

@section('small_title')
    list of user
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">

        {{-- widget--}}


        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><p>list of user</p></h3>
            </div>
            <div class="box-body">

                <a href="{{url(route('user.create'))}}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> New User </a>

                @include('flash::message')
                {{--table here--}}

                @if(count($records))
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>name</th>
                            <th>email</th>
                            <th class="text-center">roles list</th>
                            <th class="text-center">edit</th>
                            <th class="text-center">delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($records as $record)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$record->name}}</td>
                                <td>{{$record->email}}</td>
                                <td>
                                    @foreach($record->roles as $role)
                                        <span class="label label-success">{{$role->display_name}}</span>
                                    @endforeach
                                </td>
                                {{--<td class="text-center"><a href="{{url(route('user.show',$record->id))}}"--}}
                                    {{--class="btn btn-primary btn-xs" ><i class="fa fa-list"> </i></a></td>--}}
                                <td class="text-center"><a href="{{url(route('user.edit',$record->id))}}"
                                    class="btn btn-success btn-xs" ><i class="fa fa-edit"> </i></a></td>
                                <td class="text-center">
                                    {!! Form::open([
                                        'action'=>['UserController@destroy',$record->id],
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
