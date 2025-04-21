@include('components.navbar')

<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <!-- Product Image -->
    <div class=" rounded-lg overflow-hidden mb-6 flex items-center justify-center shadow-lg">
        <img src="{{ $order->product->image_url ?? asset('images/default-product.jpg') }}"
            alt="{{ $order->product->product_name }}"
            class="w-48 h-48 object-cover rounded-lg border-4 border-white shadow-md">
    </div>

    <!-- Order Details -->
    <div class=" rounded-lg p-12">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-8 text-center pb-4">Order Details</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Product Name -->
            <div>
                <p class="text-sm font-bold text-gray-500 uppercase tracking-wide">Product Name</p>
                <p class="font-semibold text-xl text-gray-900">{{ $order->product->product_name }}</p>
            </div>

            <!-- Quantity -->
            <div>
                <p class="text-sm font-bold text-gray-500 uppercase tracking-wide">Quantity Ordered</p>
                <p class="font-semibold text-xl text-gray-900">{{ $order->quantity }} kg</p>
            </div>

            <!-- Offer Price -->
            <div>
                <p class="text-sm font-bold text-gray-500 uppercase tracking-wide">Offer Price</p>
                <p class="font-semibold text-xl text-gray-900">${{ $order->offer_price }} / kg</p>
            </div>

            <!-- Original Price -->
            <div>
                <p class="text-sm font-bold text-gray-500 uppercase tracking-wide">Original Price</p>
                <p class="font-semibold text-xl text-gray-900">${{ $order->product->price }} / kg</p>
            </div>

            <!-- Total Price -->
            <div>
                <p class="text-sm font-bold text-gray-500 uppercase tracking-wide">Total Price</p>
                <p class="font-semibold text-xl text-gray-900">${{ $order->quantity * $order->offer_price }}</p>
            </div>

            <!--Order Status -->
            <div>
                <p class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-3">Order Status</p>
                <span class="px-4 py-2 rounded-full text-sm font-semibold 
                    {{ $order->status == 'Pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                    {{ $order->status == 'Accepted' ? 'bg-green-100 text-green-800' : '' }}
                    {{ $order->status == 'Rejected' ? 'bg-red-100 text-red-800' : '' }}

                    {{ $order->status == 'Delivered' ? 'bg-blue-100 text-blue-800' : '' }}
                    {{ $order->status == 'Cancelled' ? 'bg-red-100 text-red-800' : '' }}
                    ">
                    {{ $order->status }}
                </span>
            </div>
            <!--Payment Status -->
            <div>
                <p class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-3">Payment Status</p>
                <span class="px-4 py-2 rounded-full text-sm font-semibold 
                {{ $order->payment_status == 'Pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                    {{ $order->payment_status == 'Completed' ? 'bg-green-100 text-green-800' : '' }}
                    {{ $order->payment_status == 'Failed' ? 'bg-red-100 text-red-800' : '' }}"
                    ">
                    {{ $order->payment_status }}
                </span>
            </div>
            




            <!-- Delivery Address -->
            <div >
                <p class="text-sm font-bold text-gray-500 uppercase tracking-wide">Delivery Address</p>
                <p class="font-semibold text-xl text-gray-900">{{ $order->delivery_address ?? "Not Available" }}</p>
            </div>

            <!-- Delivery Date -->
            <div>
                <p class="text-sm font-bold text-gray-500 uppercase tracking-wide">Delivery Date</p>
                <p class="font-semibold text-xl text-gray-900">
                    {{ $order->delivery_date ? \Carbon\Carbon::parse($order->delivery_date)->format('d M Y, h:i A') : 'Not Scheduled' }}
                </p>
            </div>

            <!-- Payment id -->
            <div>
                <p class="text-sm font-bold text-gray-500 uppercase tracking-wide">Payment ID</p>
                <p class="font-semibold text-xl text-gray-900">
                    {{ $order->razorpay_payment_id ?? 'Not Available' }}
                </p>
            </div>


        </div>
    </div>
</div>