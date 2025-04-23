@include('components.navbar')
@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif
@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert">
        <strong class="font-bold">Error!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
@endif
<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold text-center mb-8">Your Orders</h1>
    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mt-4" role="alert">
        <strong class="font-bold">Warning!</strong>
        <span class="block sm:inline">
            Please note that the payment for your order is only valid for 24 hours. If you do not complete the payment
            within this time frame, your order will be automatically cancelled.
        </span>
    </div>


    @if ($orders->isEmpty())
        <p class="text-center text-gray-600">You have no orders yet.</p>
    @else
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <ul class="divide-y divide-gray-200">
                @foreach ($orders as $order)
                    <li class="flex flex-col sm:flex-row items-center sm:items-start px-6 py-4 hover:bg-gray-50">
                        <!-- Product Image -->
                        <div class="w-24 h-24 flex-shrink-0 bg-gray-100 rounded-lg overflow-hidden">
                            <img src="{{ $order->product->image_url ?? asset('images/default-product.jpg') }}"
                                alt="{{ $order->product->product_name }}" class="w-full h-full object-cover">
                        </div>

                        <!-- Order Details -->
                        <div class="flex-1 sm:ml-6">

                        <!-- show a warning if price is Counterd -->
                        @if($order->status=='Countered')
                            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-1 rounded relative mt-1"
                                role="alert">
                                <strong class="font-bold">Counter Offer!</strong>
                                <span class="block sm:inline">
                                    The seller has made a counter offer for your order. Please check the details.
                                </span>
                            </div>
                        @endif


                            <h5 class="text-lg font-bold text-gray-800 mb-2">Order ID: {{ $order->id }}</h5>
                            <p class="text-sm text-gray-600 mb-1">Product Name:
                                <span class="font-medium">{{ $order->product->product_name }}</span>
                            </p>
                            <p class="text-sm text-gray-600 mb-1">Order Quantity:
                                <span class="font-medium">{{ $order->quantity }} kg</span>
                            </p>
                            <p class="text-sm text-gray-600 mb-1">Original Price:
                                <span class="font-medium">${{ $order->product->price }}</span>
                            </p>
                            <p class="text-sm text-gray-600 mb-1">Offer Price:
                                <span class="font-medium">${{ $order->offer_price }}</span>
                            </p>
                            <p class="text-sm text-gray-600 mb-1">Order Status:
                                <span
                                    class="px-2 py-1 rounded text-xs font-medium 
                                                                            {{ $order->status == 'Pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                                            {{ $order->status == 'Accepted' ? 'bg-green-100 text-green-800' : '' }}
                                                                            {{ $order->status == 'Rejected' ? 'bg-red-100 text-red-800' : '' }}
                                                                            {{ $order->status == 'Delivered' ? 'bg-blue-100 text-blue-800' : '' }}
                                                                            {{ $order->status == 'Cancelled' ? 'bg-red-100 text-red-800' : '' }}
                                                                            {{ $order->status=='Countered'?'bg-orange-100 text-orange-800':'' }}
                                                                            
                                                                            ">
                                    {{ $order->status }}
                                </span>
                            </p>
                            <p class="text-sm text-gray-600 my-1">Payment Status:
                                <span
                                    class="px-2 py-1 rounded text-xs font-medium 
                                                                            {{ $order->payment_status == 'Pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                                            {{ $order->payment_status == 'Completed' ? 'bg-green-100 text-green-800' : '' }}
                                                                            {{ $order->payment_status == 'Failed' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ $order->payment_status }}
                                </span>
                            </p>



                            <p class="text-sm text-gray-600">Order Date:
                                <span class="font-medium">{{ $order->created_at->format('d M Y') }}</span>
                            </p>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-4 sm:mt-0 sm:ml-6 flex space-x-2">

                            @if ($order->status == 'Pending')
                                <form action="/orders/{{ $order->id }}/cancel" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="bg-red-500 text-white text-sm font-medium px-4 py-2 rounded hover:bg-red-600 transition duration-200">
                                        Cancel Order
                                    </button>
                                </form>
                            @endif
                            @if(($order->status == 'Accepted' || $order->status=='Countered') && $order->payment_status == 'Pending')

                                <!--  display pay now button iff the duration is less than or equal to 24 diffrence from the time of updated and now -->

                                @if($order->updated_at->diffInHours(now()) <= 24)
                                    <form action="/razorpay-payment" method="POST">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                        <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ env('RAZORPAY_KEY') }}"
                                            data-amount="{{ 
                                                $order->status == 'Countered' ? $order->counter_price * $order->quantity * 100 : 
                                                $order->offer_price * $order->quantity * 100 
                                            }}" data-currency="INR"
                                            data-buttontext="Pay Now"
                                            data-name="Farmers Market" data-description="Order Payment"
                                            data-prefill.name="{{ $order->buyer->name }}"
                                            data-prefill.email="{{ $order->buyer->email }}" data-theme.color="#ff7529">
                                            </script>



                                    </form>
                                @else
                                
                                    <p class="text-sm text-red-500">Payment time expired.</p>
                                @endif


                            @endif
                            <a href="/orders/{{ $order->id }}"
                                class="bg-blue-500 text-white text-sm font-medium px-4 py-2 rounded hover:bg-blue-600 transition duration-200">
                                View Details
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif


</div>

<style>
    .razorpay-payment-button {
        background-color: #38a169 !important;
        /* Green background */
        color: white !important;
        /* White text */
        font-size: 16px !important;
        /* Font size */
        font-weight: 600 !important;
        /* Bold text */
        padding: 8px 20px !important;
        /* Padding */
        border-radius: 8px !important;
        /* Rounded corners */
        border: none !important;
        /* Remove border */
        cursor: pointer !important;
        /* Pointer cursor */
        transition: background-color 0.3s ease !important;
        /* Smooth hover effect */
    }

    .razorpay-payment-button:hover {
        background-color: #2f855a !important;
        /* Darker green on hover */
    }
</style>