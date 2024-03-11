@extends('layouts.index')
@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0">
                    <a href="{{ route('index') }}">Home</a> <span class="mx-2 mb-0">/</span>
                    <strong class="text-black">Cart</strong>
                </div>
            </div>
        </div>
    </div>
    @if(count($basket) > 0)
        <div class="site-section">
            <div class="container">
                <div class="row mb-5">
                    <form class="col-md-12" method="post">
                        <div class="site-blocks-table">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="product-thumbnail">Image</th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-total">Total</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($basket as $item)
                                    @foreach($item->product as $product)
                                        <tr>
                                            <td class="product-thumbnail">
                                                <img src="{{ asset('/storage/'. $product->image) }}" alt="Image" class="img-fluid">
                                            </td>
                                            <td class="product-name">
                                                <h2 class="h5 text-black">{{ $product->name }}</h2>
                                            </td>
                                            <td><p id="price">{{ $product->price }}</p> рублей</td>
                                            <td>
                                                <div class="input-group mb-3" style="max-width: 120px;">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-outline-primary" type="button" onclick="minus({{ $product->id }})">&minus;</button>
                                                    </div>
                                                    <input type="text" class="form-control text-center" value="{{ $item->count }}" placeholder=""
                                                           aria-label="Example text with button addon" aria-describedby="button-addon1" name="count" id="count">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-primary" type="button" onclick="plus({{ $product->id }})">&plus;</button>
                                                    </div>
                                                </div>

                                            </td>
                                            <td id="cartResult"><p id="resultPrice">{{ $item->product_sum }}</p> рублей</td>
                                            <td><a href="{{ route('basket.delete', $product) }}" class="btn btn-primary height-auto btn-sm">X</a></td>
                                        </tr>
                                    @endforeach
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <button class="btn btn-outline-primary btn-md btn-block">Continue Shopping</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 pl-5">
                        <div class="row justify-content-end">
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-12 text-right border-bottom mb-5">
                                        <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-6">
                                        <span class="text-black">Total</span>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <strong class="text-black" id="total">230.00</strong>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-primary btn-lg btn-block" onclick="window.location='checkout.html'">Proceed To
                                            Checkout</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="site-section">
            <div class="container">
                <p>Корзина пустая. Добавьте в корзину товары</p>
            </div>
        </div>
    @endif
@endsection
@section('js-scripts')
    <script type="text/javascript">
        let csrf_token = document.head.querySelector('meta[name="csrf-token"]')
        const countInput = document.querySelector('#count')
        const price = document.querySelector('#price');
        const resultPrice = document.querySelector('#resultPrice');

        const total = document.querySelector('#total');
        total.textContent = resultPrice.textContent + ' рублей';



        const plus = (id) => {
            countInput.value++;
            resultPrice.textContent = price.textContent * countInput.value
            total.textContent = resultPrice.textContent + ' рублей';

            return fetch(`basket/${id}/update`, {
                method: 'POST',
                body: JSON.stringify({
                    count: countInput.value
                }),
                headers: {
                    'Content-Type': 'application/json',
                    "X-CSRF-Token": csrf_token.content
                }
            }).then(
                response => {
                    console.log(response)
                }
            ).catch(
                error => console.log(error)
            )
        }
        const minus = (id) => {
            if(countInput.value > 1){
                countInput.value--;
                resultPrice.textContent = resultPrice.textContent - price.textContent;
                total.textContent = resultPrice.textContent + ' рублей';
                return fetch(`basket/${id}/update`, {
                    method: 'POST',
                    body: JSON.stringify({
                        count: countInput.value
                    }),
                    headers: {
                        'Content-Type': 'application/json',
                        "X-CSRF-Token": csrf_token.content
                    }
                }).then(
                    response => {
                        console.log(response)
                    }
                ).catch(
                    error => console.log(error)
                )
            }
        }
    </script>
@endsection
