
<div class="form-group">
    <label for="name">phone</label>
    {{--{!!Form::text('name',null,['class'=>'form-control'])!!}--}}{{-- it the same as the below--}}
    {!!Form::text('phone',$model->phone,['class'=>'form-control'])!!}
    
    <label for="name">email</label>
    {!!Form::text('email',$model->email,['class'=>'form-control'])!!}


    <label for="name">facebook_url</label>
    {!!Form::text('facebook_url',$model->facebook_url,['class'=>'form-control'])!!}

    <label for="name">twitter_url</label>
    {!!Form::text('twitter_url',$model->twitter_url,['class'=>'form-control'])!!}

    <label for="name">youtube_url</label>
    {!!Form::text('youtube_url',$model->youtube_url,['class'=>'form-control'])!!}

    <label for="name">instagram_url</label>
    {!!Form::text('instagram_url',$model->instagram_url,['class'=>'form-control'])!!}

    <label for="name">whatsapp_url</label>
    {!!Form::text('whatsapp_url',$model->whatsapp_url,['class'=>'form-control'])!!}

    <label for="name">google_url</label>
    {!!Form::text('google_url',$model->google_url,['class'=>'form-control'])!!}

    <label for="name">android_app_url</label>
    {!!Form::text('android_app_url',$model->android_app_url,['class'=>'form-control'])!!}

    <label for="name">ios_app_url</label>
    {!!Form::text('ios_app_url',$model->ios_app_url,['class'=>'form-control'])!!}

   
</div>
<div class="form-group">
    <button class="btn btn-primary" type="submit">Save changes</button>
</div>
{!!Form::close() !!}