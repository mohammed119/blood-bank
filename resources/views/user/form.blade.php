@inject('roles','App\Role)
<div class="form-group">
    <label for="name">Name</label>
    {!!Form::text('name',null,['class'=>'form-control'])!!}
</div>
<div class="form-group">
    <label for="email">email</label>
    {!!Form::text('email',null,['class'=>'form-control'])!!}
</div>
<div class="form-group">
    <label for="password">password</label>
    {!!Form::password('password',['class'=>'form-control'])!!}
</div>
<div class="form-group">
    <label for="password_confirmation">repeat password</label>
    {!!Form::password('password_confirmation',['class'=>'form-control'])!!}
</div>
<div class="form-group">
    {!! Form::select('roles_list[]',$roles->pluck('display_name','id')->toArray(),null,
    [
        'class'=>'form-control multiple select2',
        'multiple'=>'multiple',
    ]) !!}
    {{--'placeholder' => 'enter rules',--}}

</div>

<div class="form-group">
    <button class="btn btn-primary" type="submit">Submit</button>
</div>
{!!Form::close() !!}