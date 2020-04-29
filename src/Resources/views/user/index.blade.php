{{-- resources/views/admin/dashboard.blade.php --}}

@extends('userauth::layouts.master')

@section('title', Lang::get('userauth::user.header_list'))

{{-- @section('content_header')
@stop --}}

@section('content')
<card title="@lang('userauth::user.header_list')">  

  @include('include.message')

  <button-create route="{{ route('user.create') }}">@lang('userauth::button.addUser')</button-create>

  <table class="table table-bordered data-table">
      <thead>
      <tr>
          <th>@lang('userauth::user.id')</th>
          <th>@lang('userauth::user.name')</th>
          <th>@lang('userauth::user.email')</th>
          <th>@lang('userauth::user.role')</th>
          <th width="100px"></th>
      </tr>
      </thead>
      <tbody>
      </tbody>
  </table>
</card>


<dialog-delete title="Benutzer löschen" body="Wollen Sie wirklich diesen Benutzer löschen?" route="{{ route('user.delete',0) }}" ></dialog-delete>

@stop

@section('js')
<script>
  $(function() {

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        language: { url: "{{ asset("DataTable_DE.json ") }}" },
        ajax: "{{ route('user.index') }}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'RoleName', name: 'RoleName' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
    });

  });
</script>
@stop
