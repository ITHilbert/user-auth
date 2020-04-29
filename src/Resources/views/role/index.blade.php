{{-- resources/views/admin/dashboard.blade.php --}}

@extends('userauth::layouts.master')

@section('title', Lang::get('userauth::role.header_list'))

{{-- @section('content_header')
@stop --}}

@section('content')
<card title="@lang('userauth::role.header_list')">  

  @include('include.message')

  <button-create route="{{ route('role.create') }}">@lang('userauth::button.addRole')</button-create>

  <table class="table table-bordered data-table">
      <thead>
      <tr>
          <th>@lang('userauth::role.id')</th>
          <th>@lang('userauth::role.role')</th>
          <th>@lang('userauth::role.role_display')</th>
          <th width="100px"></th>
      </tr>
      </thead>
      <tbody>
      </tbody>
  </table>
</card>


<dialog-delete title="Rolle löschen" body="Wollen Sie wirklich diese Rolle löschen?" route="{{ route('role.delete',0) }}" ></dialog-delete>

@stop

@section('js')
<script>
  $(function() {

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        language: { url: "{{ asset("DataTable_DE.json ") }}" },
        ajax: "{{ route('role.index') }}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'role', name: 'role' },
            { data: 'role_display', name: 'role_display' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
    });

  });
</script>
@stop
