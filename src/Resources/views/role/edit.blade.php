@extends('userauth::layouts.master')

@section('title', Lang::get('userauth::role.header_edit'))

{{-- @section('content_header')
@stop --}}

@section('content')  
<card title="@lang('userauth::role.header_edit')">
<div>
    @include('include.message')
    <hform action="{{ route('role.update', $role->id) }}">
        <div class="form-group row mb-2">
            <label for="role_display" class="col-md-4 col-form-label text-md-right">@lang('userauth::role.role')</label>
            <div class="col-md-6">
               <input-text name="role_display" value="{{ old('role_display', $role->role_display) }}" required />
            </div>
        </div>
        
        <hr>
        {{-- Permissions --}}
        @foreach ($permissions as $permission)
            <div class="form-group row mb-2">
                <div class="col-md-4"></div>   
            {{-- <label for="per_{{ $permission->id }}" class="col-md-4 col-form-label text-md-right">{{ $permission->permission_display }}</label> --}}
                <div class="col-md-6">
                <checkbox name="permission[{{ $permission->id }}]" value="{{ $permission->id }}" checked="{{ $role->hasPermission($permission->permission) }}">{{ $permission->permission_display }}</checkbox>
                </div>
            </div>
        @endforeach

        <hr>
        {{-- Buttons --}}
        <div class="form-group row mb-2">
            <div class="col-md-4 text-right">
                <button-back route="{{ route('role.index') }}">@lang('userauth::button.back')</button-back>
            </div>
            <div class="col-md-6 text-left">
                <button-save>@lang('userauth::button.save')</button-save>
            </div>
        </div>
    </hform>	 
</div>    
</card>
@stop
