
@include('components.navbar')

<div>
    <div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-lg overflow-hidden flex flex-col md:flex-row">
            <!-- Product Image -->
            <div class="md:w-1/3">
                <img src="{{ $product->image_url ?? asset('images/default-product.jpg') }}"
                    alt="{{ $product->product_name }}" class="w-full h-40 md:h-48 object-cover rounded-lg">
            </div>

            <!-- Product Details -->
            <div class="md:w-2/3 p-4">
                <h2 class="text-xl font-bold text-gray-800 mb-2">{{ $product->product_name }}</h2>
                <p class="text-md font-semibold text-green-600 mb-2">${{ $product->price }} / kg</p>

                <!-- Tags -->
                <div class="mb-2">
                    <span
                        class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded">{{ $product->produce_type }}</span>

                    <span
                        class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2 py-1 rounded">{{ $product->quality_grade }}</span>
                </div>

                <!-- Quantity -->
                <p class="text-sm text-gray-600">Quantity left: <span class="font-medium">{{ $product->quantity }}
                        kg</span></p>
            </div>
        </div>

        <!-- Checkout Form -->
        <div class="bg-white shadow-md rounded-lg mt-6 p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Checkout Form</h2>
            <form action="/checkout/{{ $product->id }}" method="POST">
                @csrf
                <!-- seller id -->
                <input type="hidden" name="seller_id" value="{{ $product->seller->id }}">
                <!-- Quantity -->
                <div class="mb-4">
                    <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity (kg)</label>
                    <input type="number" id="quantity" name="quantity" min="1" max="{{ $product->quantity }}" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                </div>

                <!-- Offer Price -->
                <div class="mb-4">
                    <label for="offer_price" class="block text-sm font-medium text-gray-700">Your Offer Price ($/kg)</label>
                    <input type="number" id="offer_price" name="offer_price" step="0.01" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                        class="w-full bg-green-500 text-white py-2 rounded-md hover:bg-green-600 transition duration-200">
                        Submit Order
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>