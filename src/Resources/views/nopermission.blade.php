@extends('userauth::layouts.userauth')

@section('title', Lang::get('userauth::permission.header_no'))

{{-- @section('content_header')
@stop --}}

@section('content')
<j-card title="@lang('userauth::permission.header_no')">
<div>
    <h3>@lang('userauth::permission.no-permission')</h3>
</div>
</j-card>
@stop
