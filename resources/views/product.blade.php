@extends('layouts.frontend.master')
@section('title')
Octoverse| Product
@endsection
@section('content')
<section class="box-container">
    <div class="l-inner">
        <!-- <ul class="ttl-box clearfix">
      <li class="ttl-list">
        <a href="#"
        class="">
          All Products
        </a>
      </li>
      <li class="ttl-list">
        <a href="#"
        class="category-tab-link">
          category name
        </a>
      </li>
    </ul> -->

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
                        <p class="cmn-p">
                            {{$product['price']}} MMK
                        </p>
                        <h5 class="cmn-h5">
                            {{$product['product_name']}}
                        </h5>
                        <button class="add-to-cart-btn" data-id="{{$product['id']}}">
                            Add to Cart
                        </button>
                    </div>
                </li>
            <?php
            }
            ?>
        </ul>
        <!-- End all tab -->
        <div class="pagination-blk">
        </div>

    </div>
</section>

@endsection