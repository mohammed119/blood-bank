

{{--{!! Form::open(['action'=>['MessageController@index'],'method'=>'get']) !!}--}}
{!! Form::open(['method'=>'get']) !!}

<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text" id="">name</span>
        <input type="text" name="name" class="form-control">
    </div>
    <div class="input-group-prepend">
        <span class="input-group-text" id="">hospital_name</span>
        <input type="text" name="hospital_name" class="form-control">
    </div>

    <div class="input-group-prepend">
        <span class="input-group-text "  id="">city</span>
        @inject('cities','App\City')
        {{--        {{$cities=\App\City::all()->pluck('id','name')}}--}}
        {!!Form::select('city_id',$cities->pluck('name','id'),null,[
                         'class' =>'select2 form-control',
                         'placeholder'=>'select city'
                         ])!!}
    </div>
    <div class="input-group-prepend">
        <span class="input-group-text "  id="">blood_type</span>
        @inject('blood_types','App\BloodType')
        {!!Form::select('blood_type_id',$blood_types->pluck('name','id'),null,[
                         'class' =>'select2 form-control',
                         'placeholder'=>'select blood type'
                         ])!!}
    </div>
</div>

<button type="submit" class="btn btn-primary">search</button>
{!! Form::close() !!}