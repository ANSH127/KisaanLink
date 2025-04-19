@include('components.navbar')

<div class="max-w-7xl mx-auto py-6">

    @if ($products->isEmpty())
        <p class="text-gray-600 text-center">No products available.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($products as $product)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">

                    <!-- Product Image -->
                    <img src="{{ $product->image_url ?? asset('images/default-product.jpg') }}"
                        alt="{{ $product->product_name }}" class="w-full h-48 object-cover">

                    <!-- Product Details -->
                    <div class="p-4">
                        <!-- Product Name -->
                        <h2 class="text-lg font-bold text-gray-800">{{ $product->product_name }}</h2>

                        <!-- Produce Type -->
                        <p class="text-sm text-gray-600 mb-2">
                            <span
                                class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded">{{ $product->produce_type }}</span>
                            @if ($product->quality_grade)
                                <span
                                    class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2 py-1 rounded">{{ $product->quality_grade }}</span>

                            @endif
                            @if($product->quantity > 0)
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded">Available</span>
                            @endif


                        </p>

                        <!-- Price -->
                        <p class="text-gray-800 font-semibold mb-4">${{ $product->price }} / kg</p>

                        <!-- Seller Name -->
                        <p class="text-sm text-gray-600 mb-4">Seller: <span
                                class="font-medium text-gray-800">{{ $product->seller->name }}</span></p>

                        <!-- Buttons -->
                        <div class="flex justify-between">
                            <a href="/productdetail/{{ $product->id }}"
                                class="bg-blue-500 text-white text-sm font-medium px-4 py-2 rounded hover:bg-blue-600 transition duration-200">View</a>
                            @if (
                                session('user')->role != 'Seller' && $product->quantity > 0
                                && $product->available_dates_from <= date('Y-m-d')
                                && $product->available_dates_to >= date('Y-m-d')
                            )
                                            <a href="/buy/{{ $product->id }}"
                                                class="bg-green-500 text-white text-sm font-medium px-4 py-2 rounded hover:bg-green-600 transition duration-200">Buy</a>

                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>