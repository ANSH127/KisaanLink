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
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Orders Received</h1>

    @if ($orders->isEmpty())
        <p class="text-gray-600 text-center">No orders received yet.</p>
    @else
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="text-left px-6 py-3 text-sm font-medium text-gray-600">Order Received</th>
                        <th class="text-left px-6 py-3 text-sm font-medium text-gray-600">Last Updated</th>
                        <th class="text-left px-6 py-3 text-sm font-medium text-gray-600">Buyer Name</th>
                        <th class="text-left px-6 py-3 text-sm font-medium text-gray-600">Buyer Address</th>
                        <th class="text-left px-6 py-3 text-sm font-medium text-gray-600">Product Name</th>
                        <th class="text-left px-6 py-3 text-sm font-medium text-gray-600">Quantity</th>
                        <th class="text-left px-6 py-3 text-sm font-medium text-gray-600">Offering Price</th>
                        <th class="text-left px-6 py-3 text-sm font-medium text-gray-600">Actual Price</th>
                        <th class="text-left px-6 py-3 text-sm font-medium text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $order->created_at->format('d M Y, h:i A') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $order->updated_at->format('d M Y, h:i A') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $order->buyer->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $order->buyer->address }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $order->product->product_name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $order->quantity }} kg</td>
                            <td class="px-6 py-4 text-sm text-gray-800">${{ $order->offer_price }} / kg</td>
                            <td class="px-6 py-4 text-sm text-gray-800">${{ $order->product->price }} / kg</td>
                            <td class="px-6 py-4 text-sm">
                                <div class="flex space-x-2">
                                    <!-- Accept Button -->
                                    @if($order->status == 'Pending')
                                        <form action="/f/orders/{{ $order->id }}/accept" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition duration-200">
                                                Accept
                                            </button>
                                        </form>
                                        <form action="/f/orders/{{ $order->id }}/counter" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200">
                                                Counter
                                            </button>
                                        </form>
                                        <form action="/f/orders/{{ $order->id }}/reject" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition duration-200">
                                                Reject
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-500 px-4 py-2 rounded hover:bg-gray-600 transition duration-200">
                                            @if($order->status == 'Accepted')
                                                <span class="text-green-500">Accepted</span>
                                            @elseif($order->status == 'Rejected')
                                                <span class="text-red-500">Rejected</span>
                                            @elseif($order->status == 'Countered')
                                                <span class="text-blue-500">Countered</span>
                                            @elseif($order->status == 'Completed')
                                                <span class="text-gray-500">Completed</span>
                                            @elseif($order->status == 'Cancelled')
                                                <span class="text-red-500">Cancelled</span>
                                            @endif
                                        </span>


                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>