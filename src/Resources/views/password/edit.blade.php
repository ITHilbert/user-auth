@extends('userauth::layouts.master')

@section('title', Lang::get('userauth::password.header_change'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <card title="@lang('userauth::password.header_change')">
                <div>
                    @include('include.message')
                    <hform action="{{ route('password.update') }}">
        
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">@lang('userauth::password.password')</label>

                            <div class="col-md-6">
                                <input-password id="password" class=" @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" />

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">@lang('userauth::password.password-confirm')</label>

                            <div class="col-md-6">
                                <input-password id="password-confirm" name="password_confirmation" required autocomplete="new-password" />
                            </div>
                        </div>


                        {{-- Buttons --}}
                        <div class="form-group row mb-2">
                            <div class="col-md-4 text-right">
                                <button-back route="{{ route('home') }}">@lang('userauth::button.back')</button-back>
                            </div>
                            <div class="col-md-6 text-left">
                                <button-save>@lang('userauth::button.editPassword')</button-save>
                            </div>
                        </div>

                    </hform>
                </div>
            </card>
    </div>
</div>
@endsection
