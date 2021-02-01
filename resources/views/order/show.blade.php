@extends('layouts.app')

@section('page_title')
    Show Order
@endsection

@section('small_title')
    show order
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">

    {{-- widget--}}


    <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><p>show order</p></h3>
            </div>
            <div class="box-body">

                <div class="card">
                    {{--<h5 class="card-header">Featured</h5>--}}
                    <div class="card-body">
                        <h3 class="card-title">name</h3>
                        <p class="card-text">{{$model->name}}</p>
                        <h3 class="card-title">Hospital Name</h3>
                        <p class="card-text">{{$model->hospital_name}}</p>
                        <h3 class="card-title">City</h3>
                        <p class="card-text">{{$model->city->name}}</p>
                        <h3 class="card-title">blood type</h3>
                        <p class="card-text">{{$model->bloodType->name}}</p>
                        <h3 class="card-title">age</h3>
                        <p class="card-text">{{$model->age}}</p>
                        <h3 class="card-title">hospital_address</h3>
                        <p class="card-text">{{$model->hospital_address}}</p>
                        <h3 class="card-title">bags_number</h3>
                        <p class="card-text">{{$model->bags_number}}</p>
                        <h3 class="card-title">details</h3>
                        <p class="card-text">{{$model->details}}</p>
                    </div>
                </div>



            </div>

        </div>
        <div class="box">

            <div class="box-header with-border">
                <h2 class="box-title"><p>client who order</p></h2>
            </div>
            <div class="box-body">

                <div class="card">
                    {{--<h5 class="card-header">Featured</h5>--}}
                    <div class="card-body">
                        <h3 class="card-title">name</h3>
                        <p class="card-text">{{$model->client->name}}</p>
                        <h3 class="card-title"> phone</h3>
                        <p class="card-text">{{$model->client->phone}}</p>
                        <h3 class="card-title">email</h3>
                        <p class="card-text">{{$model->client->email}}</p>
                        <h3 class="card-title">birth date</h3>
                        <p class="card-text">{{$model->client->birth_date}}</p>
                        <h3 class="card-title">city</h3>
                        <p class="card-text">{{$model->client->city->name}}</p>
                        <h3 class="card-title">blood type</h3>
                        <p class="card-text">{{$model->client->bloodType->name}}</p>
                    </div>
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
