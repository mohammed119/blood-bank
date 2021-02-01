

{!! Form::open(['action'=>['ClientController@index'],'method'=>'get']) !!}

<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text" id="">name</span>
        <input type="text" name="name" class="form-control">

    </div>
    <div class="input-group-prepend">
    <span class="input-group-text" id="">phone</span>
    <input type="text" name="phone" class="form-control">
    </div>
    <div class="input-group-prepend">
    <span class="input-group-text "  id="">city</span>
        @inject('cities','App\City')
{{--        {{$cities=\App\City::all()->pluck('name','id')}}--}}
{{--        {!!Form::select('city_id',$cities,null,[--}}
        {!!Form::select('city_id',$cities->pluck('name','id'),null,[
                 'class' =>'select2 form-control',
                 'placeholder'=>'select city'
                 ])!!}
    </div>
</div>

<button type="submit" class="btn btn-primary">search</button>
{!! Form::close() !!}