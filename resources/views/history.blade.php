@extends('layouts.frontend.master')
@section('title')
Octoverse
@endsection
@section('content')
<section class="sec-cart">
    <div class="l-inner ">
        <div class="history-tbl">
            @if($data->isEmpty())
            <p>No order history found.</p>
            @endif
            @foreach($data as $key => $invoice)
            <div class="history-margin">
                <div class="history-space history-div">
                    <div class="history-div">
                        <label>Invoice No: </label>
                        <p>{{ $invoice->invoice_no }}</p>
                    </div>
                    <div class="history-div">
                        <label>Transaction </label>
                        <p>{{$invoice->check_out_flg}}</p>
                    </div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $product_names = explode(',', $invoice->product_names);
                        $product_images = explode(',', $invoice->product_images);
                        $quantities = explode(',', $invoice->quantities);
                        $prices = explode(',', $invoice->prices);
                        @endphp

                        @for($i = 0; $i < count($product_names) && $i < 9; $i++)
                            <tr>
                            <td class="history-img">
                                <img src="{{ asset('img/products/' . $product_images[$i]) }}" alt="Product Image" class="history-img-small">
                                {{ $product_names[$i] }}
                            </td>
                            <td>{{ $quantities[$i] }}</td>
                            <td>{{ $prices[$i] }} MMK</td>
                            <td>{{ $quantities[$i] * $prices[$i] }} MMK</td>
                            </tr>
                            @endfor
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"><strong>Total Amount:</strong></td>
                            <td><strong>{{ $invoice->total_amount }} MMK</strong></td>
                        </tr>
                    </tfoot>
                </table>
                <br><br>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection