@extends('layouts.index')
@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <a
                        href="shop.html">Store</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">{{ $product->name }}</strong></div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mr-auto">
                    <div class="border text-center">
                        <img src="{{ asset('/storage/'. $product->image) }}" alt="Image" class="img-fluid p-5">
                    </div>
                </div>
                <div class="col-md-6">
                    <h2 class="text-black">{{ $product->name }}</h2>
                    <p>{{ $product->description }}</p>


                    <p> <strong class="text-primary h4">{{ $product->price }} рублей</strong></p>

                    <form action="{{ route('basket.store', $product) }}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <div class="input-group mb-3" style="max-width: 220px;">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                                </div>
                                <input type="text" class="form-control text-center" value="1" placeholder=""
                                       aria-label="Example text with button addon" aria-describedby="button-addon1" id="count" name="count">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                                </div>
                            </div>

                        </div>
                        <input type="submit" class="buy-now btn btn-sm height-auto px-4 py-3 btn-primary" value="Добавить в корзину">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js-scripts')
    <script type="text/javascript">
        const input = document.querySelector('#count')
        const plus = () => {
            input.value++;
        }
        const minus = () => {
            if(input.value > 0){
                input.value--;
            }
        }
    </script>
@endsection
