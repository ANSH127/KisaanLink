<div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
    <h2 style="text-align: center; color: #4CAF50;">Order Confirmation</h2>
    <p>Dear {{ $order->buyer->name }},</p>
    <p>Thank you for your purchase! Your order has been successfully placed. Below are the details of your order:</p>

    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <tr>
            <th style="text-align: left; padding: 8px; border-bottom: 1px solid #ddd;">Order ID</th>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $order->id }}</td>
        </tr>
        <tr>
            <th style="text-align: left; padding: 8px; border-bottom: 1px solid #ddd;">Product</th>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $order->product->product_name }}</td>
        </tr>
        <tr>
            <th style="text-align: left; padding: 8px; border-bottom: 1px solid #ddd;">Quantity</th>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $order->quantity }} kg</td>
        </tr>
        <tr>
            <th style="text-align: left; padding: 8px; border-bottom: 1px solid #ddd;">Total Price</th>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                @if($order->status=="Countered")
                ${{ $order->counter_price * $order->quantity }}
                @else
                ${{ $order->offer_price * $order->quantity }}
                @endif
            </td>
        </tr>
        <tr>
            <th style="text-align: left; padding: 8px; border-bottom: 1px solid #ddd;">Delivery Date</th>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $order->delivery_date->format('d M Y') }}</td>
        </tr>
    </table>

    <p style="margin-top: 20px;">We will notify you once your order is shipped. If you have any questions, feel free to contact us.</p>
    <p>Thank you for choosing us!</p>

    <p style="text-align: center; margin-top: 30px; font-size: 14px; color: #888;">&copy; {{ date('Y') }} FarmerPortal. All rights reserved.</p>
</div>