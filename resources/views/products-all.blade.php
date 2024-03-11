@extends('layouts.index')
@section('content')
    <div class="site-section">
        <div class="container">
            <div class="row">
                @foreach($products as $item)
                    <div class="col-sm-6 col-lg-4 text-center item mb-4">
                        <a href="shop-single.html"> <img src="{{ asset('/storage/'. $item->image) }}" style="width: 270px; height: 370px;" alt="Image"></a>
                        <h3 class="text-dark"><a href="shop-single.html">{{ $item->name }}</a></h3>
                        <p class="price">
                            {{ $item->price }} рублей
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
