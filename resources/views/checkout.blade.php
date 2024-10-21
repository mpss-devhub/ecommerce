@extends('layouts.frontend.master')
@section('title')
Octoverse
@endsection
@section('content')
<section class="sec-checkout">
    <div>
        @csrf
        <input type="hidden" id="selectedPaymentCode" value="">
        <div class="l-inner clearfix">
            <div class="left-col">
                @foreach($response as $item)
                <div class="{{$item['paymentType']}}">
                    <h2>{{ $item['paymentType'] }}</h2>
                    <div class="clearfix">
                        <div class="pay-list">
                            @foreach($item['payments'] as $payment)
                            <a href="#" class="showFormLink" data-code="{{ $payment['paymentCode'] }}">
                                <img src="{{ $payment['logo'] }}" alt="{{ $payment['paymentName'] }}">
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="right-col">
                <h3 class="checkout-ttl">
                    Order Details
                </h3>
                <div class="order-info-blk">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Qty</th>
                                <th>Unit Price</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total_price = 0 @endphp
                            @foreach($cart as $key => $item)
                            @php
                            $product = $item['product'];
                            $total_price += $item['price'] * $item['qty'];
                            @endphp
                            <input type="hidden" class="product_id" value="{{ $product['id'] }}">
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>
                                    {{ $product['product_name'] }}
                                </td>
                                <td>{{ $item['qty'] }}</td>
                                <td> {{ number_format($item['price']) }} MMK</td>
                                <td>
                                    <span class="sub-total">{{ number_format($item['qty'] * $item['price']) }} MMK</span>
                                </td>
                            </tr>
                            @endforeach
                            <input type="hidden" value="{{ $total_price }}" name="total_amt">
                        </tbody>

                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Grand Total</td>
                                <td>
                                    {{ number_format($total_price) }} MMK
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <hr>
                <div class="clearfix">
                        <a href="/cart" class="cart-btn back" style="float: right;">BACK</a>
                </div>
            </div>
        </div>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2 id="modalHeader" class="modalHeader">Payment Information</h2>
                <div id="paymentForm" class="paymentForm">
                    <div class="paymentBox clearfix">
                        <label for="name" class="title">Name:</label>
                        <input type="text" id="name" name="name" class="paytxt-box" required>
                    </div>
                    <div class="paymentBox clearfix">
                        <label for="phone" class="title">Phone:</label>
                        <input type="text" id="phoneNo" name="phoneNo" class="paytxt-box" required>
                    </div>
                    <div class="paymentBox clearfix">
                        <label for="email" class="title">Email:</label>
                        <input type="email" id="email" name="email" class="paytxt-box" required>
                    </div>
                    <input type="button" name="button" class="paySubmit" value="Pay Now" />
                </div>
                <div class="QR-block" style="display: none;">
                    <img src="" alt="">
                </div>
            </div>
        </div>
        </form>
</section>


@endsection