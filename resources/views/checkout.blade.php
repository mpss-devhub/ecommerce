@extends('layouts.frontend.master')
@section('title')
octoverse| Checkout Page
@endsection
@section('content')
<button onclick="topFunction()" id="myBtn" class="myBtn" title="Go to top">
    <img src="img/home/img_up_arrow5.jpg" alt="UpArrow" class="up-img">
</button>

<section class="sec-checkout">
    <form action="{{ route('checkout') }}" method="POST">
    @csrf
        <div class="l-inner clearfix">
            <div class="left-col">
                <h3 class="checkout-ttl">
                    Personal Info
                </h3>

                <div class="user-info-blk">
                    <div class="input-bx">
                        <label for="">Username</label>
                        <input type="text" name="name" value="{{ @old('name', $user->name) }}">
                        <span class="text-danger">{{ $errors->first('name') }}</span><br>
                    </div>

                    <div class="input-bx">
                        <label for="">Email Address</label>
                        <input type="text" name="email" value="{{ @old('email', $user->email) }}">
                        <span class="text-danger">{{ $errors->first('email') }}</span><br>
                    </div>

                    <div class="input-bx">
                        <label for="">Phone Number</label>
                        <input type="text" name="phone" value="{{ @old('phone', $user->phone) }}">
                        <span class="text-danger">{{ $errors->first('phone') }}</span><br>
                    </div>

                    <div class="input-bx">
                        <label for="">Address</label>
                        <input type="text" name="address" value="{{ @old('address', $user->address) }}">
                        <span class="text-danger">{{ $errors->first('address') }}</span><br>
                    </div>

                    <div class="">
                        <button class="checkout-btn btn">Submit Order</button>
                    </div>
                </div>
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
                            @foreach($cart as $item)
                            @php $total_price += $item['price'] * $item['qty'] @endphp
                            <input type="hidden" class="product_id" value="{{ $item['id'] }}">
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>
                                    {{ $item['name'] }}
                                </td>
                                <td>{{ $item['qty'] }}</td>
                                <td>$ {{ number_format($item['price']) }}</td>
                                <td>
                                    <span class="sub-total">$ {{ number_format($item['qty'] * $item['price']) }}</span>
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
                                    $ {{ number_format($total_price) }}             
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </form>
</section>
@endsection