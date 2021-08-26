@extends('userauth::layouts.userauth')

@section('title', Lang::get('userauth::user.header_create'))

@section('content')
<card title="@lang('userauth::user.header_create')">
<div>
    @include('include.message')
    <hform action="{{ route('user.store') }}">
         {{-- Firstname --}}
         @if (config('userauth.user.firstname'))
            <div class="form-group row mb-2">
                <label for="firstname" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.firstname')</label>
                <div class="col-md-6">
                <input-text name="firstname" value="{{ old('firstname', '') }}" required />
                </div>
            </div>
        @endif

        {{-- Lastname --}}
        @if (config('userauth.user.firstname'))
            <div class="form-group row mb-2">
                <label for="lastname" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.lastname')</label>
                <div class="col-md-6">
                <input-text name="lastname" value="{{ old('lastname', '') }}" required />
                </div>
            </div>
        @endif


        {{-- name --}}
        @if (config('userauth.user.name'))
        <div class="form-group row mb-2">
            <label for="name" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.name')</label>
            <div class="col-md-6">
               <input-text name="name" value="{{ old('name', '') }}" required />
            </div>
        </div>
        @endif

        {{-- smallname --}}
        @if (config('userauth.user.smallname'))
            <div class="form-group row mb-2">
                <label for="smallname" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.smallname')</label>
                <div class="col-md-6">
                <input-text name="smallname" value="{{ old('smallname', '') }}" required />
                </div>
            </div>
        @endif

        {{-- email --}}
        @if (config('userauth.user.email'))
        <div class="form-group row mb-2">
            <label for="email" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.email')</label>
            <div class="col-md-6">
               <input-text name="email" value="{{ old('email', '') }}" required />
            </div>
        </div>
        @endif

        {{-- Password --}}
        <div class="form-group row mb-2">
            <label for="password" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.password')</label>
            <div class="col-md-6">
               <input-password name="password" value="" autocomplete="new-password" required />
            </div>
        </div>

        {{-- Password confirm --}}
        <div class="form-group row mb-2">
            <label for="password2" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.password2')</label>
            <div class="col-md-6">
               <input-password name="password2" value="" autocomplete="new-password" required />
            </div>
        </div>
        @endif

        {{-- role --}}
        @if (config('userauth.user.role'))
        <div class="form-group row mb-2">
            <label for="role_id" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.role')</label>
            <div class="col-md-6">
            <combobox name="role_id" :options="{{ $roles }}"  value="{{ old('role_id', 3) }}" required ></combobox>
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


