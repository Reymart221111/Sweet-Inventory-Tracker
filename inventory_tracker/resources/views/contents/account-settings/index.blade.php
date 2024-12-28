@extends('layouts.app')

@section('content-title', 'Account Settings')

@section('contents')
@if ($showSettings ?? false)
@livewire('account-settings.account-settings')
@elseif($showPassword ?? false)
@livewire('account-settings.account-password')
@elseif($showProfile ?? false)
@livewire('account-settings.account-profile')
@endif
@endsection