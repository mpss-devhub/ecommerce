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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.showFormLink').forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const paymentCode = this.getAttribute('data-code');
                const paymentTypeContainer = this.closest('.pay-list').parentNode.parentNode;
                const paymentTypeElement = paymentTypeContainer.querySelector('h2');
                const paymentType = paymentTypeElement ? paymentTypeElement.innerText.trim() : '';
                console.log('Selected Payment Code:', paymentCode);
                console.log('Selected Payment Type:', paymentType);
                document.getElementById('selectedPaymentCode').value = paymentCode;
                showModal(paymentType);
            });
        });
        const modal = document.getElementById('myModal');
        const closeModalBtn = document.getElementsByClassName('close')[0];
        const modalHeader = document.getElementById('modalHeader');

        function showModal(paymentType) {
            modalHeader.innerText = `${paymentType} Payment Information`;
            modal.style.display = 'block';
        }

        function hideModal() {
            modal.style.display = 'none';
            resetForm();
        }

        closeModalBtn.onclick = function() {
            hideModal();
        };

        window.onclick = function(event) {
            if (event.target == modal) {
                hideModal();
            }
        };

        function resetForm() {
            document.getElementById('phoneNo').value = '';
            document.getElementById('email').value = '';
            document.getElementById('name').value = '';
            document.getElementById('selectedPaymentCode').value = '';
            document.querySelector('.QR-block').style.display = 'none';
        }

        document.querySelector('.paySubmit').addEventListener('click', function(event) {
    event.preventDefault();

    const submitButton = this;
    submitButton.disabled = true; 

    $.ajax({
        type: 'POST',
        url: '/checkout',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        contentType: 'application/json',
        data: JSON.stringify({
            phoneNo: $('#phoneNo').val(),
            email: $('#email').val(),
            name: $('#name').val(),
            selectedPaymentCode: $('#selectedPaymentCode').val(),
            _token: $('meta[name="csrf-token"]').attr('content')
        }),
        success: function(response) {
            console.log(response);
            if (response.message) {
                toastr.error(response.message);
                submitButton.disabled = false;  
            } else if (response.data) {
                if (response.data.type === 'QR') {
                    const qrImageElement = document.querySelector('.QR-block img');
                    qrImageElement.src = response.data.data;
                    document.querySelector('.QR-block').style.display = 'block';
                } else if (response.data.type === 'DEEP_LINK') {
                    window.location.href = response.data.data;
                } else if (response.data.type === 'REDIRECT_URL') {
                    window.location.href = response.data.data; 
                } else if (response.data.type === 'MESSAGE') {
                    toastr.success(response.data.data);
                    setTimeout(function() {
                        window.location.href = '/';  
                    }, 100);
                }
            }
        },
        error: function(xhr, status, error) {
            console.error("Error occurred: ", error);
            toastr.error("An error occurred. Please try again.");
            submitButton.disabled = false; 
        }
    });
});

    });
</script>

@endsection