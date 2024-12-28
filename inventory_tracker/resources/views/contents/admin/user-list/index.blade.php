@extends('layouts.app')

@section('content-title', 'Users')

@section('contents')
    @livewire('users-list.read-users')
@endsection