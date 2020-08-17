@extends('userauth::layouts.master')

@section('title', Lang::get('userauth::role.header_create'))

@section('content')
<card title="@lang('userauth::role.header_create')">
<div>
    @include('include.message')

    <hform action="{{ route('role.store') }}">
        <div class="form-group row mb-2">
            <label for="role_display" class="col-md-4 col-form-label text-md-right">@lang('userauth::role.role')</label>
            <div class="col-md-6">
               <input-text name="role_display" value="{{ old('role_display', '') }}" onchange="setInternValue()" required />
            </div>
        </div>

        <div class="form-group row mb-2">
            <label for="role" class="col-md-4 col-form-label text-md-right">@lang('userauth::role.role_intern')</label>
            <div class="col-md-6">
               <input-text name="role" value="{{ old('role', '') }}" required />
            </div>
        </div>

        <hr>
        {{-- Permissions CRUD--}}
        <div class="form-group row mb-2">
            <div class="col-md-4"></div>
            <div class="col-md-6">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">@lang('userauth::permission.permission')</th>
                        <th scope="col">@lang('userauth::permission.create')</th>
                        <th scope="col">@lang('userauth::permission.read')</th>
                        <th scope="col">@lang('userauth::permission.edit')</th>
                        <th scope="col">@lang('userauth::permission.delete')</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissionsgroups as $group)
                            @if($group->is_group == 0)
                                <tr>
                                    <th scope="row">{{ $group->group_display }}</th>
                                    <td align="center"><checkbox name="permission[{{ $group->permissionCreate()->id }}]" value="{{ $group->permissionCreate()->id }}"></checkbox></td>
                                    <td align="center"><checkbox name="permission[{{ $group->permissionRead()->id }}]" value="{{ $group->permissionRead()->id }}"></checkbox></td>
                                    <td align="center"><checkbox name="permission[{{ $group->permissionEdit()->id }}]" value="{{ $group->permissionEdit()->id }}"></checkbox></td>
                                    <td align="center"><checkbox name="permission[{{ $group->permissionDelete()->id }}]" value="{{ $group->permissionDelete()->id }}"></checkbox></td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <br>

        {{-- Permissions Single--}}
        @foreach ($permissionsgroups as $group)
            @if($group->is_group == 1)
            <div class="form-group row mb-2">
                <div class="col-md-4"></div>
                <div class="col-md-6">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col" colspan="5">{{ $group->group_display }}</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($group->getPermisssionsSingle() as $perm)
                                <tr>
                                    <th colspan="3" scope="row">{{ $perm->permission_display }}</th>
                                    <td colspan="2"><checkbox name="permission[{{ $perm->id }}]" value="{{old( 'permission['. $perm->id .']' , false) }}"></checkbox></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
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


@section('js')
    <script src="{{asset("vendor/userauth/js/role.js")}} "></script>
@stop
