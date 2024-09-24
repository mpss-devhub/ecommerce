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
      <li class="item-list">
        <div class="image"> 
          <img src="" alt="">
        </div>
        <div class="item-txt">
          <p class="cmn-p">
          </p>
          <h5 class="cmn-h5">
            Product Name
          </h5>
          <button class="add-to-cart-btn" data-id="">
            Add to Cart
          </button>
        </div>
      </li>
    </ul>
    <!-- End all tab -->
    <div class="pagination-blk">
    </div>

  </div>
</section>
@endsection