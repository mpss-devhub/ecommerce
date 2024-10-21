@extends('layouts.frontend.master')
@section('title')
Octoverse
@endsection
@section('content')
<section class="sec-cart">
    <div class="l-inner">
        @foreach($data as $key => $invoice)
        <div class='history'>
            <div class="history-invoice">
                <div class="history-div">
                    <label>Invoice No : </label>
                    <p>{{ $invoice->invoice_no }} </p>
                </div>
            </div>
            <div class="history-products">
                @php
                $product_names = explode(',', $invoice->product_names);
                $product_images = explode(',', $invoice->product_images);
                $quantities = explode(',', $invoice->quantities);
                @endphp
                @for($i = 0; $i < count($product_names) && $i < 9; $i++)
                    <div class="history-product">
                        <img class='history-img' src="{{ asset('img/products/' . $product_images[$i]) }}" alt="Product Image" />
                        <div class='history-info'>
                            <div class="history-div">
                                <label>Product Name : </label>
                                <p>{{ $product_names[$i] }}</p>
                            </div>
                            <div class="history-div">
                                <label>Qty : </label>
                                <p>{{ $quantities[$i] }}</p>
                            </div>
                        </div>
                    </div>
                    @endfor
            </div>
            <div class="history-total">
                <div class="history-div">
                    <label>Total Amount : </label>
                    <p>{{ $invoice->total_amount }} <span> MMK</span></p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection