@extends('userauth::layouts.login')

@section('title', Lang::get('userauth::login.header'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <card title="@lang('userauth::login.header')">
                <div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">@lang('userauth::login.email')</label>

                            <div class="col-md-6">
                                <input-email id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                {{-- @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror --}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">@lang('userauth::login.password')</label>

                            <div class="col-md-6">
                                <input-password id="password" name="password" required autocomplete="current-password">

                               {{--  @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror --}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        @lang('userauth::login.remember')
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button-submit>@lang('userauth::button.login')</button-submit>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </card>
        </div>
    </div>
</div>
@endsection
