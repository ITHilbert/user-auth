@extends('userauth::layouts.master')

@section('title', Lang::get('userauth::user.header_edit'))

{{-- @section('content_header')
@stop --}}

@section('content')  
<card title="@lang('userauth::user.header_edit')">
<div>
    @include('include.message')
    <hform action="{{ route('user.update', $user->id) }}" >
        <div class="form-group row mb-2">
            <label for="name" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.name')</label>
            <div class="col-md-6">
               <input-text name="name" value="{{ old('name', $user->name) }}" required />
            </div>
        </div>

        <div class="form-group row mb-2">
            <label for="email" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.email')</label>
            <div class="col-md-6">
               <input-text name="email" value="{{ old('email', $user->email) }}" required />
            </div>
        </div>

        <div class="form-group row mb-2">
            <label for="password" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.password')</label>
            <div class="col-md-6">
               <input-password name="password" value="" autocomplete="new-password" />
            </div>
        </div>

        <div class="form-group row mb-2">
            <label for="password2" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.password2')</label>
            <div class="col-md-6">
               <input-password name="password2" value="" autocomplete="new-password" />
            </div>
        </div>

        <div class="form-group row mb-2">
            <label for="role_id" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.role')</label>
            <div class="col-md-6">
            <combobox name="role_id" :options="{{ $roles }}"  value="{{ old('role_id', $user->role_id) }}" required ></combobox>
            </div>
        </div>
        
        {{-- Buttons --}}
        <div class="form-group row mb-2">
            <div class="col-md-4 text-right">
                <button-back route="{{ route('user.index') }}">@lang('userauth::button.back')</button-back>
            </div>
            <div class="col-md-6 text-left">
                <button-save>@lang('userauth::button.save')</button-save>
            </div>
        </div>
    </hform>	 
</div>    
</card>
@stop
