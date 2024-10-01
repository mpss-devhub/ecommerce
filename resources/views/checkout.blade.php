@extends('layouts.frontend.master')
@section('title')
octoverse| Checkout Page
@endsection
@section('content')
<section class="sec-checkout">
    <form action="{{ route('checkout') }}" method="POST">
        @csrf
        <input type="hidden" id="selectedPaymentCode" name="payment_code" value="">
        <div class="l-inner clearfix">
            <div class="left-col">
                @foreach($response as $item)
                <div class="Ewallet">
                    <h2>{{ $item['paymentType'] }}</h2>
                    <div class="clearfix">
                        <div class="pay-list">
                            @foreach($item['payments'] as $payment)
                            <a href="#" class="showFormLink" name="payment_code" data-code="{{ $payment['paymentCode'] }}">
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
                            @foreach($cart as $item)
                            @php $total_price += $item['price'] * $item['qty'] @endphp
                            <input type="hidden" class="product_id" value="{{ $item['id'] }}">
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>
                                    {{ $item['product_name'] }}
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
                <hr>
            </div>
        </div>
        <!-- Modal structure -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span> <!-- Ensure this exists -->
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

                    <button type="submit" class="paySubmit">Submit</button>
                </div>
            </div>
        </div>
    </form>
</section>
<script>
    document.querySelectorAll('.showFormLink').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const paymentCode = this.getAttribute('data-code');
            console.log('Selected Payment Code:', paymentCode);
            document.getElementById('selectedPaymentCode').value = paymentCode;
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('myModal'); // Ensure the modal ID matches
        const closeModalBtn = document.getElementsByClassName('close')[0];
        const modalHeader = document.getElementById('modalHeader');

        function showModal(paymentType) {
            modalHeader.innerText = `${paymentType} Payment Information`;
            modal.style.display = 'block';
        }

        function hideModal() {
            modal.style.display = 'none';
        }

        // Add event listeners to all elements with the class 'showFormLink'
        document.querySelectorAll('.showFormLink').forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const paymentType = this.querySelector('img').alt;
                showModal(paymentType);
            });
        });

        closeModalBtn.onclick = function() {
            hideModal();
        };

        window.onclick = function(event) {
            if (event.target == modal) {
                hideModal();
            }
        };
    });
</script>
@endsection