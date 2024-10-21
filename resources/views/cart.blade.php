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
                                <span class="sub-total">{{ number_format($item['qty'] * $product['price']) }}</span> MMK
                            </td>
                            <td>
                                <form action="{{ route('cart.destroy', $product['id']) }}" style="display: inline" method="GET" class="removeCartItemForm{{ $product['id'] }}">
                                    @csrf
                                    <a href="javascript:;" class="remove-cart-item" data-id="{{ $product['id'] }}">
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
                        <a href="#" class="cart-btn checkout myBtn" data-route="{{ route('redirectCheckOut') }}">REDIRECT CHECKOUT</a>
                        <a href="#" class="cart-btn checkout myBtn" data-route="{{ route('checkout') }}">DIRECT CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="modalHeader" class="modalHeader">
                <p class="eng-text">
                    This website is a demo website that has been tested to understand the sample payment flow of Octoverse Payment Gateway. Please be informed that if you purchase items from this website, you will not actually receive the item, but your bank account will be charged for the value of the item.
                </p>
                <p class="myanmar-text">ယခု website သည် Octoverse Payment Gateway ၏ Sample payment Flow အား သိရှိနားလည်နိုင်စေရန် Testing ပြုလုပ်ထားသည့် Demo Website ဖြစ်ပါသည်။ ယခု Website မှ Items များကို ဝယ်ယူပါက အဆိုပါပစ္စည်းအား အမှန်တကယ်ရရှိမည် မဟုတ်သော်လည်း လူကြီးမင်း၏ Bank Account မှ အဆိုပါ ပစ္စည်းတန်ဖိုး၏ ကျသင့်ငွေ ဖြတ်သွားမည်ဖြစ်ပါကြောင်း အသိပေးကြေညာ အပ်ပါသည်။</p>
            </div>

            <button id="proceedBtn" class="paySubmit" style="margin-left: 40%;">Submit</button>
            <div id="loading" hidden></div>
        </div>
    </div>
</section>
<script>
    var modal = document.getElementById("myModal");
    var btns = document.querySelectorAll(".myBtn");
    var span = document.getElementsByClassName("close")[0];
    var proceedBtn = document.getElementById("proceedBtn");
    var loadingIndicator = document.getElementById("loading");
    var nextRoute = "";
    btns.forEach(function(btn) {
        btn.onclick = function(event) {
            event.preventDefault();
            nextRoute = btn.getAttribute("data-route");
            modal.style.display = "block";
        }
    });
    span.onclick = function() {
        modal.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    proceedBtn.onclick = function() {
        loadingIndicator.style.display = "block";
        modal.style.display = "none";
        setTimeout(function() {
            window.location.href = nextRoute;
        }, 100);
    }
</script>

{{--data-id="{{ $category->id }}"--}}
@endsection