@extends('master')

@section('content')
    <h1>Role Test</h1>
    ID: {{ $role->id }}<br>   
    Role: {{ $role->role }}
    <hr>
    Hat Recht a: {{ $role->hasPermission('a') }}<br>
    Hat Recht d: {{ $role->hasPermission('d') }}<br>
@endsection