@extends('layouts.index')
@section('content')
    <div class="container">
        @foreach($order as $item)
            <p>Номер заказа: {{ $item->id }}</p>
            <p>Статус заказа: {{ $item->status }}</p>
        @endforeach
    </div>
@endsection
