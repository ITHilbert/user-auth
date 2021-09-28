<?php
use ITHilbert\UserAuth\App\Classes\Anrede;
use ITHilbert\UserAuth\App\Classes\SignatureRule;
?>

@extends('userauth::layouts.userauth')

@section('title', Lang::get('userauth::user.header_create'))

@section('content')
<j-card title="@lang('userauth::user.header_create')">
<div>
    @include('include.message')
    <hform action="{{ route('user.store') }}">
         {{-- Anrede --}}
        @if (config('userauth.user.anrede'))
        <div class="form-group row mb-2">
            <label for="anrede_id" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.anrede')</label>
            <div class="col-md-6">
            {!! Anrede::getComboBox( old('anrede_id', 1), 'anrede_id') !!}
            </div>
        </div>
    @endif

    {{-- Titel --}}
    @if (config('userauth.user.title'))
        <div class="form-group row mb-2">
            <label for="title" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.title')</label>
            <div class="col-md-6">
            <input-text name="title" value="{{ old('title', '') }}"/>
            </div>
        </div>
    @endif

    {{-- Firstname --}}
    @if (config('userauth.user.firstname'))
        <div class="form-group row mb-2">
            <label for="firstname" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.firstname') *</label>
            <div class="col-md-6">
            <input-text name="firstname" value="{{ old('firstname', '') }}" required />
            </div>
        </div>
    @endif

    {{-- Lastname --}}
    @if (config('userauth.user.firstname'))
        <div class="form-group row mb-2">
            <label for="lastname" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.lastname') *</label>
            <div class="col-md-6">
            <input-text name="lastname" value="{{ old('lastname', '') }}" required />
            </div>
        </div>
    @endif

    {{-- name --}}
    @if (config('userauth.user.name'))
        <div class="form-group row mb-2">
            <label for="name" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.name') *</label>
            <div class="col-md-6">
            <input-text name="name" value="{{ old('name', '') }}" required />
            </div>
        </div>
    @endif

    {{-- smallname --}}
    @if (config('userauth.user.smallname'))
        <div class="form-group row mb-2">
            <label for="smallname" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.smallname') *</label>
            <div class="col-md-6">
            <input-text name="smallname" value="{{ old('smallname', '') }}" required />
            </div>
        </div>
    @endif

    {{-- email --}}
    @if (config('userauth.user.email'))
        <div class="form-group row mb-2">
            <label for="email" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.email') *</label>
            <div class="col-md-6">
            <input-email name="email" value="" required />
            </div>
        </div>
    @endif

    {{-- private_email --}}
    @if (config('userauth.user.private_email'))
        <div class="form-group row mb-2">
            <label for="email" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.private_email')</label>
            <div class="col-md-6">
            <input-email name="private_email" value="{{ old('private_email', '') }}" />
            </div>
        </div>
    @endif

    {{-- password --}}
    <div class="form-group row mb-2">
        <label for="password" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.password') *</label>
        <div class="col-md-6">
           <input-password name="password" value="" autocomplete="new-password" />
        </div>
    </div>

    {{-- password confirm --}}
    <div class="form-group row mb-2">
        <label for="password2" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.password2') *</label>
        <div class="col-md-6">
           <input-password name="password2" value="" autocomplete="new-password" />
        </div>
    </div>

    {{-- role --}}
    @if (config('userauth.user.role'))
        <div class="form-group row mb-2">
            <label for="role_id" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.role')</label>
            <div class="col-md-6">
            <combobox name="role_id" :options="{{ $roles }}"  value="{{ old('role_id', 3) }}" required ></combobox>
            </div>
        </div>
    @endif


    {{-- street --}}
    @if (config('userauth.user.street'))
        <div class="form-group row mb-2">
            <label for="street" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.street')</label>
            <div class="col-md-6">
            <input-text name="street" value="{{ old('street', '') }}"  />
            </div>
        </div>
    @endif

    {{-- postcode --}}
    @if (config('userauth.user.postcode'))
        <div class="form-group row mb-2">
            <label for="postcode" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.postcode')</label>
            <div class="col-md-6">
            <input-text name="postcode" value="{{ old('postcode', '') }}"  />
            </div>
        </div>
    @endif

    {{-- city --}}
    @if (config('userauth.user.city'))
        <div class="form-group row mb-2">
            <label for="city" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.city')</label>
            <div class="col-md-6">
            <input-text name="city" value="{{ old('city', '') }}"  />
            </div>
        </div>
    @endif

    {{-- country --}}
    @if (config('userauth.user.country'))
        <div class="form-group row mb-2">
            <label for="country" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.country')</label>
            <div class="col-md-6">
            <input-text name="country" value="{{ old('country', '') }}"  />
            </div>
        </div>
    @endif

    {{-- Signatur --}}
    @if (config('userauth.user.signature_rule'))
        <div class="form-group row mb-2">
            <label for="signature_rule_id" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.signature_rule')</label>
            <div class="col-md-6">
            {!! SignatureRule::getComboBox( old('signature_rule_id', 1), 'signature_rule_id') !!}
            </div>
        </div>
    @endif

    {{-- ustid --}}
    @if (config('userauth.user.ustid'))
        <div class="form-group row mb-2">
            <label for="ustid" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.ustid')</label>
            <div class="col-md-6">
            <input-text name="ustid" value="{{ old('ustid', '') }}"  />
            </div>
        </div>
    @endif

    {{-- phone --}}
    @if (config('userauth.user.phone'))
        <div class="form-group row mb-2">
            <label for="phone" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.phone')</label>
            <div class="col-md-6">
            <input-text name="phone" value="{{ old('phone', '') }}"  />
            </div>
        </div>
    @endif

    {{-- phone2 --}}
    @if (config('userauth.user.phone2'))
        <div class="form-group row mb-2">
            <label for="phone2" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.phone2')</label>
            <div class="col-md-6">
            <input-text name="phone2" value="{{ old('phone2', '') }}"  />
            </div>
        </div>
    @endif

    {{-- mobile --}}
    @if (config('userauth.user.mobile'))
        <div class="form-group row mb-2">
            <label for="mobile" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.mobile')</label>
            <div class="col-md-6">
            <input-text name="mobile" value="{{ old('mobile', '') }}"  />
            </div>
        </div>
    @endif

    {{-- fax --}}
    @if (config('userauth.user.fax'))
        <div class="form-group row mb-2">
            <label for="fax" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.fax')</label>
            <div class="col-md-6">
            <input-text name="fax" value="{{ old('fax', '') }}"  />
            </div>
        </div>
    @endif

    {{-- skype --}}
    @if (config('userauth.user.skype'))
        <div class="form-group row mb-2">
            <label for="skype" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.skype')</label>
            <div class="col-md-6">
            <input-text name="skype" value="{{ old('skype', '') }}"  />
            </div>
        </div>
    @endif

    {{-- hourly_rate --}}
    @if (config('userauth.user.hourly_rate'))
        <div class="form-group row mb-2">
            <label for="hourly_rate" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.hourly_rate')</label>
            <div class="col-md-6">
            <input-euro name="hourly_rate" value="{{ old('hourly_rate', '') }}"  />
            </div>
        </div>
    @endif

    {{-- birthday --}}
    @if (config('userauth.user.birthday'))
        <div class="form-group row mb-2">
            <label for="birthday" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.birthday')</label>
            <div class="col-md-6">
            <input-date name="birthday" value="{{ old('birthday', '') }}"  />
            </div>
        </div>
    @endif

    {{-- comment --}}
    @if (config('userauth.user.comment'))
        <div class="form-group row mb-2">
            <label for="comment" class="col-md-4 col-form-label text-md-right">@lang('userauth::user.comment')</label>
            <div class="col-md-6">
            <text-area name="comment" value="{{ old('comment', '') }}"  />
            </div>
        </div>
    @endif

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
</j-card>
@stop


