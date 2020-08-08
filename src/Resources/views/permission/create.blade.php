@extends('userauth::layouts.master')

@section('title', Lang::get('userauth::permission.header_create'))

@section('content')
<card title="@lang('userauth::permission.header_create')">
<div>
    @include('include.message')
    <hform action="{{ route('permission.store') }}">

        <div class="form-group row mb-2">
            <label for="permission_display" class="col-md-4 col-form-label text-md-right">@lang('userauth::permission.permission')</label>
            <div class="col-md-6">
               <input-text name="permission_display" value="{{ old('permission_display', '') }}" required />
            </div>
        </div>

        <div class="form-group row mb-2">
            <div class="col-md-4"></div>
            <div class="col-md-6">
                <checkbox name="permission_crud" value="true" checked="1">@lang('userauth::permission.permission_crud_create')</checkbox>
            </div>
        </div>
        <br>

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


