@include('components.navbar')

<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-white  rounded-lg p-6">
        <!-- Left: Product Image -->
        <div>
            <img src="{{ $product->image_url ?? asset('images/default-product.jpg') }}"
                alt="{{ $product->product_name }}" class="w-full h-96 object-cover rounded-lg">
        </div>

        <!-- Right: Product Details -->
        <div>
            <!-- Product Name -->
            <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $product->product_name }}</h1>



            <!-- Price -->
            <p class="text-2xl font-semibold text-green-600 mb-4">${{ $product->price }} / kg</p>

            <!-- Product Description -->
            <p class="text-gray-600 mb-4">
                @if ($product->additional_notes)
                        <strong>Description:</strong>
                    <ul class="list-disc pl-5 font-semibold text-gray-700">
                        @foreach (explode(',', $product->additional_notes) as $note)
                            <li>{{ trim($note) }}</li>
                        @endforeach
                    </ul>

                @else
                    <strong>No Description Available</strong>

                @endif


            </p>
            <!-- Tags -->
            <div class="my-4">
                <span
                    class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded">{{ $product->produce_type }}</span>
                @if ($product->quality_grade)
                    <span
                        class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2 py-1 rounded">{{ $product->quality_grade }}</span>
                @endif
                @if (
                    $product->quantity > 0
                    && $product->available_dates_from <= date('Y-m-d')
                    && $product->available_dates_to >= date('Y-m-d')
                )
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded">Available</span>
                @else
                    <span class="bg-red-100 text-red-800 text-xs font-medium px-2 py-1 rounded">Out of Stock</span>
                @endif
            </div>

            <!-- Buy Button -->
            @if (session('user')->role != 'Seller' && $product->quantity > 0 
                && $product->available_dates_from <= date('Y-m-d')
                && $product->available_dates_to >= date('Y-m-d')
            )

                <a href="/buy/{{ $product->id }}"
                    class="bg-green-500 text-white text-sm font-medium px-6 py-3 rounded hover:bg-green-600 transition duration-200 mt-4">
                    Buy Now
                </a>
            @endif
            <!--  quantity left -->
            <p class="text-sm text-gray-600 mt-3">Quantity Left: <span
                    class="font-medium text-gray-800">{{ $product->quantity }} kg</span></p>


            <!-- Seller Details -->
            <div class="mt-8">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Seller Details</h2>
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('images/avatar.avif') }}" alt="Seller Avatar"
                        class="w-16 h-16 rounded-full border border-gray-300 shadow-md" />
                    <div>
                        <p class="text-sm text-gray-600">
                            <span class="font-semibold text-gray-800">Name:</span> {{ $product->seller->name }}
                        </p>
                        <p class="text-sm text-gray-600">
                            <span class="font-semibold text-gray-800">Email:</span> {{ $product->seller->email }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>