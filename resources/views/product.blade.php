@extends('layouts.frontend.master')
@section('title')
Octoverse
@endsection
@section('content')
<section class="box-container">
    <div class="l-inner">
        <!-- all tab -->
        <ul class="item-box clearfix">
            <?php
            foreach ($products as $product) {
            ?>
                <li class="item-list">
                    <div class="image">
                        <img src="{{ asset('img/products/' . $product->product_image) }}" alt="">
                    </div>
                    <div class="item-txt">
                        <h5 class="cmn-h5">
                            {{$product['product_name']}}
                        </h5> 
                           <p class="cmn-p">
                            {{$product['price']}} MMK
                        </p>
                        <button class="add-to-cart-btn" data-id="{{$product['id']}}">
                            Add to Cart
                        </button>
                    </div>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>
</section>

@endsection