Hello <i>{{ $order->receiver }}</i>,
<p>Cảm ơn đã mua hàng</p>

<p><u>Đơn hàng của bạn đã đặt là :</u></p>

<div>
    @foreach ($order->name as $item)
        <p><b>{{ $item->name }} x</b>&nbsp;{{ $item->quantity }}</p>
    @endforeach
</div>

Thank You.
<br/>
<i>{{ $order->sender }}</i>
