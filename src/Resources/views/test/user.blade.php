@extends('master')

@section('content')
    <h1>Role Test</h1>
    ID: {{ $user->id }}<br> 
    Name: {{ $user->name }}<br> 
    E-Mail: {{ $user->email }}<br>   
    Role: {{ $user->roleDisplayname() }}
    <hr>
    Hat Recht a: {{ $user->hasPermission('a') }}<br>
    Hat Recht d: {{ $user->hasPermission('d') }}<br>
@endsection