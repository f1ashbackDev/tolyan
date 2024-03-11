@extends('layouts.index')
@section('content')
    <div class="container">
        <h2>Заказ №{{ $order->id }}</h2>
        <p>Статус заказа: {{ $order->status }}</p>
        <p>Сумма по заказу: {{ $order->price }}</p>
        <table class="table">
            <thead>
            <tr>
                <th>Фото</th>
                <th>Наименование товара</th>
                <th>Цена</th>
                <th>Количество</th>
                <th>Стоимость</th>
            </tr>
            </thead>
            <tbody>
            @foreach($history as $item)
                @foreach($item->product as $product)
                    <tr>
                        <td>
                            <img src="{{ asset('/storage/' . $item->image[0]->image) }}" style="width: 119px;
                        height: 67px"/>
                        </td>
                        <td>
                            {{ $product->name }}
                        </td>
                        <td>
                            {{ $product->price }}
                        </td>
                        <td>
                            {{ $item->count }}
                        </td>
                        <td>
                            {{ $item->sum }}
                        </td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
