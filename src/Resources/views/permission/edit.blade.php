@extends('userauth::layouts.userauth')

@section('title', Lang::get('userauth::permission.header_edit'))

{{-- @section('content_header')
@stop --}}

@section('content')
<j-card title="@lang('userauth::permission.header_edit')">
<div>
    @include('include.message')
    <hform action="{{ route('permission.update', $permissiongroup->id) }}">

        <div class="form-group row mb-2">
            <label for="group_display" class="col-md-4 col-form-label text-md-right">@lang('userauth::permission.group_display')</label>
            <div class="col-md-6">
               <input-text name="group_display" value="{{ old('group_display', $permissiongroup->group_display) }}" required />
            </div>
        </div>

        <div class="form-group row mb-2">
            <label for="group_name" class="col-md-4 col-form-label text-md-right">@lang('userauth::permission.group_name')</label>
            <div class="col-md-6">
               <input-text name="group_name" value="{{ old('group_name', $permissiongroup->group_name) }}" required />
            </div>
        </div>

        <div class="form-group row mb-2">
            <label for="ck-permission-group" class="col-md-4 col-form-label text-md-right">@lang('userauth::permission.ck-permission-group')</label>
            <div class="col-md-6">
               <checkbox class="pt-2" onclick="showSinglePermissions()" name="ckPermissionGroup" checked="{{ old('ckPermissionGroup', $permissiongroup->is_group ) }}" disabled />
            </div>
        </div>

        <div id="group_permissions_show" class="{{ $permissiongroup->is_group == 0 ? 'd-none' : '' }}">
            <hr>
            {{-- Permissions --}}
            <div class="form-group row mb-2">
                <div class="col-md-4"></div>
                <div class="col-md-6">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col" class="d-none">ID</th>
                            <th scope="col">Recht</th>
                            <th scope="col">Recht intern</th>
                            <th scope="col">
                                <button onclick="newPermission()" type="button" data-toggle="tooltip" title="Neues Recht erstellen" class="btn btn-create"><i class="fas fa-plus-circle"></i></button>
                            </th>
                        </tr>
                        </thead>
                        <tbody id="tbody">
                            @foreach ($permissions as $permission)
                                <tr id="perm-{{ $permission->id }}" nummer="{{ $permission->id }}" >
                                    <td scope="row" class="d-none">{{ $permission->id }}</td>
                                    <td><input type="text" id="display_{{ $permission->id }}" name="permission_display_{{ $permission->id }}" onchange="editIntern('perm-{{ $permission->id }}')" value="{{ old('permission_display_' .  $permission->id, $permission->permission_display) }}" class="form-control input-text"></td>
                                    <td><input type="text" id="intern_{{ $permission->id }}" name="permission_{{ $permission->id }}" value="{{ old('permission_' .  $permission->id, $permission->permission) }}" class="form-control input-text"></td>
                                    <td><button onclick="deletePermission('perm-{{ $permission->id }}')" type="button" data-toggle="tooltip" title="Löschen" class="btn btn-delete "><i class="fas fa-minus-circle"></i></button></td>
                                </tr>
                            @endforeach
                            <tr id="new-row-1" nummer="1">
                                <td scope="row" class="d-none">new_1</td>
                                <td><input type="text" id="display_new_1" onchange="editIntern('new-row-1')" name="permission_display_new_1" class="form-control input-text"></td>
                                <td><input type="text" id="intern_new_1" name="permission_new_1" class="form-control input-text"></td>
                                <td><button onclick="deletePermission('new-row-1')" type="button" data-toggle="tooltip" title="Löschen" class="btn btn-delete"><i class="fas fa-minus-circle"></i></button></td>
                            </tr>
                            <tr id="vorlage" class="d-none" nummer="x">
                                <td id="new-id" scope="row" class="d-none"></td>
                                <td><input type="text" id="vorlage_display"  class="form-control input-text"></td>
                                <td><input type="text" id="vorlage_intern" class="form-control input-text"></td>
                                <td><button type="button" id="btnVorlage" data-toggle="tooltip" title="Löschen" class="btn btn-delete"><i class="fas fa-minus-circle"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



        <hr>

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
</j-card>
@stop

@section('js')
    <script src="{{asset("vendor/userauth/js/permission.js")}} "></script>
@stop
