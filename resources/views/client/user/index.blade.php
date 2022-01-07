@extends('client.layouts.app', ['activePage' => 'cart', 'title' => 'Thông tin'])
@section('content')
Đây là trang thông tin khách hàng
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.15/lodash.min.js"></script>
<script>
$(document).ready(function() {
    $(".closed").on("click", function(e) {
        e.preventDefault()
        const _this = $(this)
        $.ajax({
            url: '/cart/remove',
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                product_id: $(this).data('product-id'),
            },
            success: function() {
                _this.parents(".product-cart").remove()
                window.location.reload(false)
            }
        })
    })

    $(".input-quantity").on("change", _.debounce(function() {
        const quantity = $(this).val()
        const product_id = $(this).data('product-id')
        const _input_quantity_context = $(this)
        $.ajax({
            url: '/cart/update',
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                product_id: product_id,
                quantity: quantity
            },
            success: function(response) {
                _input_quantity_context
                    .parents('.product-cart')
                    .find('.unit-price')
                    .text(response.itemSubTotal + ' đ')

                $(".cart-total").text(response.total + ' đ')
            }
        })
    }, 1000))
})
</script>

@endpush
