
//******************** GLOBAL *********************
$(document).ready(function () {
    loadCartCount();
});

function loadCartCount() {
    $.ajax({
        url: 'cart/get-count',
        type: 'POST',
        dataType: 'JSON',
        beforeSend: function () { },
        complete: function () { },
        success: function (data) {
            let count = data.data;
            if (count != 0) {
                $('.cart-count').html(count);
                $('.cart-count').show();
            } else {
                $('.cart-count').html(count);
                $('.cart-count').hide();
            }
        },
        error: function (data) { }
    });
}


//******************** HOME *********************
$(document).ready(function () {
    loadBookList(0);
});

$('#category').change(function () {
    loadBookList($(this).val());
});

function loadBookList(id) {
    $.ajax({
        url: 'get-book-list',
        type: 'POST',
        data: {
            cat_id: id
        },
        beforeSend: function () {
            $('#bookList').hide();
            $('#loading').fadeIn();
        },
        complete: function () {
            $('#loading').hide();
            $('#bookList').fadeIn();
        },
        success: function (data) {
            $('#bookList').html(data);
        },
        error: function (data) { }
    });
}

function addToCart(id) {
    $.ajax({
        url: 'cart/add',
        type: 'POST',
        dataType: 'JSON',
        data: {
            item_id: id
        },
        beforeSend: function () { },
        complete: function () { },
        success: function (data) {
            alert(data.message);
            loadCartCount();
        },
        error: function (data) {
            alert("Something went wrong");
        }
    });
}


//******************** CART *********************
$('.cart-qty-input').change(function () {
    updateCart(this);
});

$('.remove-item').click(function () {
    removeCart(this);
});

function updateCart(e) {

    let item_id = $(e).data('id');
    let qty = $(e).val();

    $.ajax({
        url: 'cart/update',
        type: 'POST',
        dataType: 'JSON',
        data: {
            item_id: item_id,
            qty: qty
        },
        beforeSend: function () { },
        complete: function () { },
        success: function (data) {
            $(e).parent().parent().find('.item-total').html(data.data.item_total);
            $('.sub-total').html(data.data.total);
            loadCartCount();
        },
        error: function (data) {
            alert("Something went wrong");
        }
    });
}

function removeCart(e) {

    let item_id = $(e).data('id');

    $.ajax({
        url: 'cart/remove',
        type: 'POST',
        dataType: 'JSON',
        data: {
            item_id: item_id
        },
        beforeSend: function () { },
        complete: function () { },
        success: function (data) {
            $('.sub-total').html(data.data);
            loadCartCount();
            $(e).parent().parent().remove();
        },
        error: function (data) {
            alert("Something went wrong");
         }
    });
}


//******************** CHECKOUT *********************

function couponVarify() {

    let code = $("#couponCodeInput").val();

    $.ajax({
        url: 'checkout/coupon-varify',
        type: 'POST',
        dataType: 'JSON',
        data: {
            code: code
        },
        beforeSend: function () { },
        complete: function () { },
        success: function (data) {
            alert(data.message);
            $('#couponCodeInput').prop('readonly', true);
            $('.checkout-discount').html(data.data.discount);
            $('.checkout-coupon-discount').html(data.data.coupon_discount);
            $('.checkout-net-total').html(data.data.net_total);
        },
        error: function (data) { 
            alert("Something went wrong");
        }
    });
}

$('#checkoutForm').submit(function () {
    $.ajax({
        url: 'checkout/submit',
        type: 'POST',
        dataType: 'JSON',
        data: $('#checkoutForm').serialize(),
        beforeSend: function () { },
        complete: function () { },
        success: function (data) {
            alert(data.message);
            window.location.href = "/";
        },
        error: function (data) { 
            alert("Something went wrong");
        }
    });
});