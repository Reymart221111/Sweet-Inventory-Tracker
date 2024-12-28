@extends('layouts.app')

@section('content-title', 'User Feedbacks')

@if (Auth::user()->role === 'admin')
    @section('contents')
        @if ($viewing ?? false)
             @livewire('feedbacks.view-feedback', ['feedback' => $feedback])
        @else
                @livewire('feedbacks.view-feedback-details')
        @endif
    @endsection
@elseif(Auth::user()->role === 'manager' || Auth::user()->role === 'employee')
    @section('contents')
        @livewire('feedbacks.view-feedback-submission')
    @endsection
@endif
