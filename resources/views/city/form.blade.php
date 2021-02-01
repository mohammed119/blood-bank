
<div class="form-group">
    <label for="name">Name</label>
    {{--{!!Form::text('name',null,['class'=>'form-control'])!!}--}}{{-- it the same as the below--}}
    {!!Form::text('name',$model->name,['class'=>'form-control'])!!}
    <label for="governorate">Governorate</label>
    {!!Form::select('governorate_id',$governorates,$model->governorate_id,[
                     'class' => 'form-control'
                     ])!!}
</div>
<div class="form-group">
    <button class="btn btn-primary" type="submit">Submit</button>
</div>
{!!Form::close() !!}