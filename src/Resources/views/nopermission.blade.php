@extends('userauth::layouts.master')

@section('title', Lang::get('userauth::permission.header_no'))

{{-- @section('content_header')
@stop --}}

@section('content')  
<card title="@lang('userauth::permission.header_no')">
<div>
    <h3>@lang('userauth::permission.no-permission')</h3>
</div>    
</card>
@stop
