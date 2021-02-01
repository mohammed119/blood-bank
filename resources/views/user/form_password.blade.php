{!!Form::open(['action'=>'UserController@changePasswordSave','method'=>'post']) !!}
<div class="form-group">
    <label for="current password">current password</label>
{!!Form::text('old_password',null,['class'=>'form-control'])!!}
    <label for="new password">new password</label>
    {!!Form::text('password',null,['class'=>'form-control'])!!}
    <label for="confirm password">confirm password</label>
    {!!Form::text('password_confirmation',null,['class'=>'form-control'])!!}
</div>
<div class="form-group">
    <button class="btn btn-primary" type="submit">Save</button>
</div>
{!! Form::close() !!}