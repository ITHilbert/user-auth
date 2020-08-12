@extends('userauth::layouts.master')

@section('title', Lang::get('userauth::permission.header_create'))

@section('content')
<card title="@lang('userauth::permission.header_create')">
<div>
    @include('include.message')
    <hform action="{{ route('permission.store') }}">

        <div class="form-group row mb-2">
            <label for="group_display" class="col-md-4 col-form-label text-md-right">@lang('userauth::permission.group_display')</label>
            <div class="col-md-6">
               <input-text name="group_display" value="{{ old('group_display', '') }}" required />
            </div>
        </div>
        <div class="form-group row mb-2">
            <label for="group_name" class="col-md-4 col-form-label text-md-right">@lang('userauth::permission.group_name')</label>
            <div class="col-md-6">
               <input-text name="group_name" value="{{ old('group_name', '') }}" required />
            </div>
        </div>

        {{-- Buttons --}}
        <div class="form-group row mb-2">
            <div class="col-md-4 text-right">
                <button-back route="{{ route('permission.index') }}">@lang('userauth::button.back')</button-back>
            </div>
            <div class="col-md-6 text-left">
                <button-save>@lang('userauth::button.save')</button-save>
            </div>
        </div>
    </hform>
</div>
</card>
@stop

@section('js')
    <script src="{{asset("vendor/userauth/js/permission.js")}} "></script>
@stop

