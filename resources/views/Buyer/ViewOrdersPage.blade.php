@include('components.navbar')

<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold text-center mb-8">Your Orders</h1>

    @if ($orders->isEmpty())
        <p class="text-center text-gray-600">You have no orders yet.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($orders as $order)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <!-- Card Body -->
                    <div class="p-6">
                        <h5 class="text-lg font-bold text-gray-800 mb-2">Order ID: {{ $order->id }}</h5>
                        <p class="text-sm text-gray-600 mb-2">Product Name: <span
                                class="font-medium">{{ $order->product->product_name }}</span></p>
                        <p class="text-sm text-gray-600 mb-2">Order Quantity: <span class="font-medium">{{ $order->quantity }}
                                kg</span></p>

                        <p class="text-sm text-gray-600 mb-2"> Orignal Price: <span
                                class="font-medium">${{ $order->product->price }}</span></p>
                        <p class="text-sm text-gray-600 mb-2"> Offer Price: <span
                                class="font-medium">${{ $order->offer_price }}</span></p>
                        <p class="text-sm text-gray-600 mb-2">Status:
                            <span class="px-2 py-1 rounded text-xs font-medium 
                                        {{ $order->status == 'Pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $order->status == 'Accepted' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $order->status == 'Rejected' ? 'bg-red-100 text-red-800' : '' }}
                                        {{ $order->status == 'Delivered' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $order->status == 'Cancelled' ? 'bg-red-100 text-red-800' : '' }}
                                        ">
                                {{ $order->status }}
                            </span>
                        </p>
                        <p class="text-sm text-gray-600 mb-4">Order Date: <span
                                class="font-medium">{{ $order->created_at->format('d M Y') }}</span></p>


                        <!-- Buttons -->
                        <div class="flex justify-between">
                            <a href="/orders/{{ $order->id }}"
                                class="bg-blue-500 text-white text-sm font-medium px-4 py-2 rounded hover:bg-blue-600 transition duration-200">View
                                Details</a>
                            @if ($order->status == 'Pending')
                                <form action="/orders/{{ $order->id }}/cancel" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="bg-red-500 text-white text-sm font-medium px-4 py-2 rounded hover:bg-red-600 transition duration-200">Cancel
                                        Order</button>
                                </form>
                            @endif

                           
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>