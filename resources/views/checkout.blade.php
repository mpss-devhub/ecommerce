@extends('layouts.frontend.master')
@section('title')
octoverse| Checkout Page
@endsection
@section('content')
<section class="sec-checkout">
    <form action="{{ route('checkout') }}" method="POST">
        @csrf
        <div class="l-inner clearfix">
            <div class="left-col">
                <div class="Ewallet">
                    <h2>E-Wallet</h2>
                    <div class="clearfix">
                        <div class="pay-list">
                            <a href="#" class="showFormLink"><img src="{{ asset('img/bank_logo/KBZPay.png') }}" alt="KBZPay"></a>
                            <a href="#" class="showFormLink"><img src="{{ asset('img/bank_logo/CBPay.png') }}" alt="CBPay"></a>
                            <a href="#" class="showFormLink"><img src="{{ asset('img/bank_logo/UABPay.png') }}" alt="UBPay"></a>
                            <a href="#" class="showFormLink"> <img src="{{ asset('img/bank_logo/AYAPay.png') }}" alt="AYAPay"></a>
                            <a href="#" class="showFormLink"><img src="{{ asset('img/bank_logo/onePay.png') }}" alt="onePay"></a>
                            <a href="#" class="showFormLink"><img src="{{ asset('img/bank_logo/MoMoney.png') }}" alt="MoMoney"></a>
                        </div>
                    </div>
                </div>
                <div class="QR">
                    <h2>QR Pay</h2>
                    <div class="clearfix">
                        <div class="pay-list">
                            <a href="#" class="showFormLink"><img src="{{ asset('img/bank_logo/KBZPay.png') }}" alt="KBZPay"></a>
                            <a href="#" class="showFormLink"><img src="{{ asset('img/bank_logo/CBPay.png') }}" alt="CBPay"></a>
                            <a href="#" class="showFormLink"> <img src="{{ asset('img/bank_logo/AYAPay.png') }}" alt="AYAPay"></a>
                            <a href="#" class="showFormLink"><img src="{{ asset('img/bank_logo/MoMoney.png') }}" alt="MoMoney"></a>
                        </div>
                    </div>
                </div>
                <div class="webpay">
                    <h2>Web Pay</h2>
                    <div class="clearfix">
                        <div class="pay-list">
                            <a href="#" class="showFormLink"><img src="{{ asset('img/bank_logo/Wavepay.png') }}" alt="Wave"></a>
                            <a href="#" class="showFormLink"><img src="{{ asset('img/bank_logo/OkDollar.png') }}" alt="OkDollar"></a>
                            <a href="#" class="showFormLink"><img src="{{ asset('img/bank_logo/MPU.png') }}" alt="MPU"></a>
                            <a href="#" class="showFormLink"> <img src="{{ asset('img/bank_logo/Visa & Master.png') }}" alt="Visa&Master"></a>
                            <a href="#" class="showFormLink"> <img src="{{ asset('img/bank_logo/M-Pitesan.png') }}" alt="M-pitesan"></a>
                        </div>
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
    </form>
</section>
<!-- Modal structure -->
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span> <!-- Ensure this exists -->
    <h2 id="modalHeader">Payment Information</h2>
    <form id="paymentForm">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <button type="submit">Submit</button>
    </form>
  </div>
</div>
<script>
 document.addEventListener('DOMContentLoaded', function() {
  // Get modal and other elements
  const modal = document.getElementById('myModal');
  const closeModalBtn = document.getElementsByClassName('close')[0];
  const showModalLinks = document.querySelectorAll('.showFormLink');
  const modalHeader = document.getElementById('modalHeader');

//   Function to show the modal
  function showModal(paymentType) {
    modalHeader.innerText = `${paymentType} Payment Information`;
    modal.style.display = 'block';
  }

  // Function to hide the modal
  function hideModal() {
    modal.style.display = 'none';
  }

  // Loop through each link and add click event listener to show the modal
  showModalLinks.forEach(link => {
    link.addEventListener('click', function(event) {
      event.preventDefault(); // Prevent default link behavior
      const paymentType = link.getAttribute('data-payment');
      showModal(paymentType);  // Show the modal and pass the payment type
    });
  });

  // Close the modal when the 'x' button is clicked
  closeModalBtn.onclick = function() {
    hideModal();
  }

  // Close the modal if the user clicks outside the modal content
  window.onclick = function(event) {
    if (event.target == modal) {
      hideModal();
    }
  }
});

</script>
@endsection