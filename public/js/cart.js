// Store Cart
$('.add-to-cart-btn').click(function (e) {
    e.preventDefault();
    let id = $(this).data('id');
    
    $.ajax({
        type: 'GET',
        url: '/addToCart',
        data: { id: id },

        success: function (response) {
            let cart_count = Object.keys(response.cart).length;

            if (response.msg == 'success') {
                toastr.success('Item Added to Your Cart Successfully &nbsp;<i class="fa fa-check-circle"></i>', 'SUCCESS', {
                    closeButton: true,
                    progressBar: true,
                });
            } else {
                toastr.error('Item Already Exist in Your Cart &nbsp;<i class="fa fa-exclamation-circle"></i>', 'WARNING', {
                    closeButton: true,
                    progressBar: true,
                });
            }

            $('.cart-count').html(cart_count);
        }
    })
});


// Update Cart Qty
$('.minus').click(function (e) {
    e.preventDefault();
    let qty = $(this).parent('.qty-box').find('.qty').val();
    let value = parseInt(qty, 10);
    value = isNaN(value) ? 0 : value;

    if (value > 1) {
        value--;
        $(this).parent('.qty-box').find('.qty').val(value);
    }
});

$('.plus').click(function (e) {
    e.preventDefault();
    let qty = $(this).parent('.qty-box').find('.qty').val();
    let value = parseInt(qty, 10);
    value = isNaN(value) ? 0 : value;

    if (value < 10) {
        value++;
        $(this).parent('.qty-box').find('.qty').val(value);
    }
});


// Update Cart
$('.update-cart').click(function (e) {
    let thisEl = $(this);
    console.log(thisEl);

    let id = $(this).closest('.cart-item-list').find('.product_id').val();
    let qty = $(this).closest('.cart-item-list').find('.qty').val();

    $.ajax({
        type: 'GET',
        url: '/cart/update',
        data: { id: id, qty: qty },

        success: function (response) {
            console.table(response);
            thisEl.closest('.cart-item-list').find('.sub-total').text(response.sub_total);
            $('#cartListTable tfoot').load(location.href + ' .grand-total-row');
        }
    })
});

// Clear Cart
$(document).on('click', '.btn-blk .clear', function (e) {
    e.preventDefault();
    //let id = $(this).data('id');
    //alert('123');

    Swal.fire({
        title: 'Are You Sure?',
        text: "Do You Want to Delete Your Cart?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'OK',
        cancelButtonText: 'CANCEL',
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            $('.clearCartForm').submit();
        }
    })
});

// Remove Cart Item
$(document).on('click', '.remove-cart-item', function (e) {
    e.preventDefault();
    let id = $(this).data('id');

    Swal.fire({
        title: 'Are You Sure?',
        text: "Do You Want to Remove this Item?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'OK',
        cancelButtonText: 'CANCEL',
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            $('.removeCartItemForm' + id).submit();
        }
    })
});
