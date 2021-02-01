@component('mail::message')
# Introduction

{{--The body of your message.--}}
Blood Bank Reset Password
{{--@component('mail::button', ['url' => ''])--}}
{{--Button Text--}}
{{--@endcomponent--}}
<p>your reset password code is : {{$code}}</p>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
