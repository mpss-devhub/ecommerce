@extends('layouts.frontend.master')
@section('title')
octoverse| Cart Page
@endsection
@section('content')
<section class="sec-cart">
    <div class="l-inner">
        <div class="cart-mv">
            <div class="cart-box clearfix">
            <i class="fa-solid fa-cart-shopping cart-icon"></i>
                <h2 class="cmn-ttl"> Shopping Cart</h2>
            </div>
            <div class="table-box">
                <table class="cart-table" id="cartListTable">
                    <thead>
                        <tr class="header">
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Quatity</th>
                            <th>Unit Price</th>
                            <th>Sub Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php $total_price = 0 @endphp
                        @foreach($cart as $key => $item)
                        @php
                        // Access the nested product details inside each cart item
                        $product = $item['product'];
                        $total_price += $item['price'] * $item['qty'];
                        @endphp
                        <tr class="cart-item-list">
                            <input type="hidden" class="product_id" value="{{ $product['id'] }}">
                            <td>
                                <img src="{{ asset('img/products/' . $product['product_image']) }}" alt="">
                            </td>
                            <td>{{ $product['product_name'] }}</td>
                            <td>
                                <div class="qty-box clearfix">
                                    <a href="javascript:;" class="update-cart minus">&minus;</a>
                                    <input type="number" class="qty" value="{{ $item['qty'] }}" data-id="{{ $product['id'] }}" min="1">
                                    <a href="javascript:;" class="update-cart plus">&plus;</a>
                                </div>
                            </td>
                            <td>
                                {{ number_format($product['price']) }} MMK
                            </td>
                            <td>
                                <span class="sub-total">{{ number_format($item['qty'] * $product['price']) }} MMK</span>
                            </td>
                            <td>
                                <form action="{{ route('cart.destroy', $product['id']) }}" style="display: inline" method="GET" class="removeCartItemForm{{ $product['id'] }}">
                                    @csrf
                                    <a href="javascript:;" class="remove-cart-item" data-id="{{ $item['id'] }}">
                                        <i class="fa-solid fa-trash del-icon"></i>
                                    </a>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="tfoot">
                        <tr class="grand-total-row">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="grand-ttl">Grand Total</td>
                            <td class="grand-ttl">
                                <span class="sub-total">{{ number_format($total_price) }}</span> MMK
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <div class="cart-table clearfix">
                    <div class="btn-blk">
                        <a href="{{ route('products.index') }}" class="cart-btn back">BACK</a>
                        <form action="{{ route('cart.clear') }}" style="display: inline" method="POST" class="clearCartForm">
                            @csrf
                            <a href="javascript:;" class="cart-btn clear" onclick="confirmClearCart(event)">CLEAR</a>
                        </form>

                        <a href="{{ route('redirectCheckOut') }}" class="cart-btn checkout">REDIRECT CHECKOUT</a>
                        <a href="{{ route('checkout') }}" class="cart-btn checkout">DIRECT CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{--data-id="{{ $category->id }}"--}}
@endsection