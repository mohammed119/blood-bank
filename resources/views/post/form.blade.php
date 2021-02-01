
<div class="form-group">
    <label for="title">Title</label>
    {!!Form::text('title',null,['class'=>'form-control'])!!}
    <label for="text">Text</label>
    {!!Form::textarea('text',null,['class'=>'form-control'])!!}

    <label for="image">image</label>
    {!! Form::file('image',['class'=>'form-control-file']) !!}
    @if($model->image)
        <div class="col-md-4"style="display: block">
            <img src="{{asset('/image/'.$model->image)}}" alt="" class="img-responsive thumbnail" style="display: block">
        </div>
    @endif
    {{--{!! Form::file('image',$model->image,['class'=>'form-control']) !!}--}}

    <label for="category" style="display: block">Category</label>
    {!!Form::select('category_id',$categories,$model->category_id,[
                     'class' => 'form-control'
                     ])!!}
</div>
<div class="form-group">
    <button class="btn btn-primary" type="submit">Submit</button>
</div>
{!!Form::close() !!}