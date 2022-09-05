@component('mail::message')
#Introduction

Hello
Your token is
{{$token}}

<br>
{{config('app.name')}}
@endcomponent