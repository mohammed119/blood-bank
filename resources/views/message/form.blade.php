

{{--{!! Form::open(['action'=>['MessageController@index'],'method'=>'get']) !!}--}}
{!! Form::open(['method'=>'get']) !!}

<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text" id="">keyword</span>
        <input type="text" name="keyword" class="form-control">
    </div>

    <div class="input-group-prepend">
    <span class="input-group-text "  id="">client</span>
        @inject('clients','App\Client')
{{--        {{$cities=\App\City::all()->pluck('id','name')}}--}}

        @php
        $clients=$clients->pluck('name','id')->toArray()
        @endphp
        {{--{!!Form::select('client_id',$clients->pluck('name','id'),null,[--}}

        {!!Form::select('client_id',$clients,request()->input('client_id'),[
                         'class' =>'select2 form-control',
                         'placeholder'=>'select client'
                         ])!!}
    </div>
</div>

<button type="submit" class="btn btn-primary">search</button>
{!! Form::close() !!}