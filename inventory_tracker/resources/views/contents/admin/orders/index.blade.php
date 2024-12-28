@extends('layouts.app')

@section('content-title', 'Orders')

@section('contents')
@if ($viewing ?? false)
@livewire('item-orders.read-order-details', ['orderId' => $order->id])
@else
@livewire('item-orders.read-orders')
@endif
@endsection