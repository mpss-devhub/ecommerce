@extends('layouts.frontend.master')
@section('title')
octoverse| Cart Page
@endsection
@section('content')
<section class="sec-cart">
    <div class="l-inner">
        <div class="cart-mv">
            <div class="cart-box clearfix">

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                    <path d="M96 0C107.5 0 117.4 8.19 119.6 19.51L121.1 32H541.8C562.1 32 578.3 52.25 572.6 72.66L518.6 264.7C514.7 278.5 502.1 288 487.8 288H170.7L179.9 336H488C501.3 336 512 346.7 512 360C512 373.3 501.3 384 488 384H159.1C148.5 384 138.6 375.8 136.4 364.5L76.14 48H24C10.75 48 0 37.25 0 24C0 10.75 10.75 0 24 0H96zM128 464C128 437.5 149.5 416 176 416C202.5 416 224 437.5 224 464C224 490.5 202.5 512 176 512C149.5 512 128 490.5 128 464zM512 464C512 490.5 490.5 512 464 512C437.5 512 416 490.5 416 464C416 437.5 437.5 416 464 416C490.5 416 512 437.5 512 464z" />
                </svg>
                <h2 class="cmn-ttl "> Shopping Cart</h2>
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
                        @php $total_price += $item['price'] * $item['qty'] @endphp
                        <tr class="cart-item-list">
                            <input type="hidden" class="product_id" value="{{ $item['id'] }}">
                            <td>
                                @if($item['photo'])
                                    <img src="{{asset('uploads/product/'.$item['photo'])}}" alt="">
                                @else
                                    <img src="{{asset('frontend/img/img_watch5.jpg')}}" alt="">
                                @endif
                            </td>
                            <td>{{ $item['name'] }}</td>
                            <td>
                                <div class="qty-box clearfix">
                                    <a href="javascript:;" class="update-cart minus">&minus;</a>
                                    <input type="number" disabled class="qty" value="{{ $item['qty'] }}">
                                    <a href="javascript:;" class="update-cart plus">&plus;</a>
                                </div>
                            </td>
                            <td>
                                $ {{ $item['price'] }}
                            </td>
                            <td>
                                $ <span class="sub-total">{{ number_format($item['qty'] * $item['price']) }}</span>
                            </td>
                            <td>
                                <form action="{{ route('cart.destroy', $item['id']) }}" style="display: inline" method="GET" 
                                class="removeCartItemForm{{$item['id']}}">
                                @csrf
                                    <a href="javascript:;" class="remove-cart-item" data-id="{{ $item['id'] }}">
                                        <svg class="del-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                            <path class="del-icon" d="M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM31.1 128H416V448C416 483.3 387.3 512 352 512H95.1C60.65 512 31.1 483.3 31.1 448V128zM111.1 208V432C111.1 440.8 119.2 448 127.1 448C136.8 448 143.1 440.8 143.1 432V208C143.1 199.2 136.8 192 127.1 192C119.2 192 111.1 199.2 111.1 208zM207.1 208V432C207.1 440.8 215.2 448 223.1 448C232.8 448 240 440.8 240 432V208C240 199.2 232.8 192 223.1 192C215.2 192 207.1 199.2 207.1 208zM304 208V432C304 440.8 311.2 448 320 448C328.8 448 336 440.8 336 432V208C336 199.2 328.8 192 320 192C311.2 192 304 199.2 304 208z" />
                                        </svg>
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
                                $ <span class="sub-total">{{ number_format($total_price) }}</span>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <div class="cart-table clearfix">
                    <div class="btn-blk">
                        <a href="{{ route('product') }}" class="cart-btn back">BACK</a>
                        <form action="{{ route('cart.clear') }}" style="display: inline" method="GET" class="clearCartForm">
                        @csrf
                            <a href="javascript:;" class="cart-btn clear">CLEAR</a>
                        </form>
                        <a href="{{ route('checkout') }}" class="cart-btn checkout">CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{--data-id="{{ $category->id }}"--}}
@endsection