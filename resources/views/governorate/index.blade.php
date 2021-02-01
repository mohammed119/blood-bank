@extends('layouts.app')

@section('page_title')
    المحافظات 
@endsection



@section('content')

    <!-- Main content -->
    <section class="content">

        {{-- widget--}}


        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><p>كل المحافظات</p></h3>
            </div>
            <div class="box-body">

                <a href="{{url(route('governorate.create'))}}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> اضافة محافظة </a>
                    @include('flash::message')

                {{--table here--}}

                @if(count($records))
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th class="text-center">تعديل</th>
                            <th class="text-center">حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($records as $record)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$record->name}}</td>
                                <td class="text-center"><a href="{{url(route('governorate.edit',$record->id))}}"
                                    class="btn btn-primary btn-xs" ><i class="fa fa-list"> </i></a></td>
                                    <td class="text-center">
                                    {!! Form::open([
                                        'action'=>['GovernorateController@destroy',$record->id],
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
                لا توجد بيانات
                @endif

            </div>
            <!-- /.box-body -->

            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->


@endsection
