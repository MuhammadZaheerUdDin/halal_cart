<!DOCTYPE html>
<html>
<head>
    <title>
        <img src="{{ asset('assets/imgs/meet-logo.png') }}" alt="Client Logo" width="35%" />
        Order Confirmation
    </title>
</head>
<body>
    <h2>
        <img src="{{ asset('assets/imgs/meet-logo.png') }}" alt="Client Logo" width="5%" />
        Thank you for your order, {{ $order->user->name }}!
    </h2>

    <p>Your order has been successfully placed. Here are your order details:</p>

    <h3>Order #{{ $order->id }}</h3>
    <p><strong>Items:</strong></p>
    <ul>
        @foreach ($order->orderProducts as $item)
            <li>{{ $item->product_name }} (x{{ $item->quantity }}) - ${{ $item->price }}</li>
        @endforeach
    </ul>

    <p><strong>Total:</strong> ${{ $order->total }}</p>
    <p><strong>Shipping Address:</strong> {{ $order->shipping_address }}</p>

    <p>We will notify you once your order is shipped.</p>
    <p>Thank you for shopping with us!</p>

    <p>Best Regards,<br> My Halal Cart</p>
</body>
</html>
