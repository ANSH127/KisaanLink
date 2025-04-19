@include('components.navbar')

<div>

    <head>
        @vite('resources/css/app.css')
    </head>
    <div class="min-h-screen bg-gray-100 flex items-center justify-center">
        <div class="w-full max-w-2xl bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold text-center mb-6">Update Produce Details</h1>
            <form method="POST" action="/products/{{ $product->id }}">
                @csrf
                @method('PUT')


                <!-- Produce Name -->
                <div class="mb-6">
                    <label for="product_name" class="block text-lg font-medium text-gray-700">Produce Name</label>
                    <select id="product_name" name="product_name" required
                        class="mt-2 block w-full border-gray-300 rounded-lg shadow-md focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 text-gray-700">
                        <option value="Tomatoes" {{ $product->product_name == 'Tomatoes' ? 'selected' : '' }}>Tomatoes
                        </option>
                        <option value="Potatoes" {{ $product->product_name == 'Potatoes' ? 'selected' : '' }}>Potatoes
                        </option>
                        <option value="Wheat" {{ $product->product_name == 'Wheat' ? 'selected' : '' }}>Wheat</option>
                    </select>
                </div>

                <!-- Produce Type -->
                <div class="mb-6">
                    <label for="produce_type" class="block text-lg font-medium text-gray-700">Produce Type</label>
                    <select id="produce_type" name="produce_type" required
                        class="mt-2 block w-full border-gray-300 rounded-lg shadow-md focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 text-gray-700">
                        <option value="Hybrid" {{ $product->produce_type == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                        <option value="Organic" {{ $product->produce_type == 'Organic' ? 'selected' : '' }}>Organic
                        </option>
                    </select>
                </div>

                <!-- Quantity -->
                <div class="mb-6">
                    <label for="quantity" class="block text-lg font-medium text-gray-700">Quantity (in kg)</label>
                    <input type="number" id="quantity" name="quantity" required
                        class="mt-2 block w-full border-gray-300 rounded-lg shadow-md focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 text-gray-700"
                        value="{{ $product->quantity }}">

                </div>

                <!-- Price -->
                <div class="mb-6">
                    <label for="price" class="block text-lg font-medium text-gray-700">Price (per kg)</label>
                    <input type="number" id="price" name="price" required
                        class="mt-2 block w-full border-gray-300 rounded-lg shadow-md focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 text-gray-700"
                        value="{{ $product->price }}">


                </div>

                <!-- Quality Grade -->
                <div class="mb-6">
                    <label for="quality_grade" class="block text-lg font-medium text-gray-700">Quality Grade</label>
                    <select id="quality_grade" name="quality_grade" required class="mt-2 block w-full border-gray-300 rounded-lg shadow-md focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 text-gray-700
                        

                        ">
                        <option value="Premium" {{ $product->quality_grade == 'Premium' ? 'selected' : '' }}>Premium
                        </option>
                        <option value="Standard" {{ $product->quality_grade == 'Standard' ? 'selected' : '' }}>Standard
                        </option>
                        <option value="Low" {{ $product->quality_grade == 'Low' ? 'selected' : '' }}>Low</option>
                    </select>
                </div>

                <!-- Available Dates -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="available_dates_from" class="block text-lg font-medium text-gray-700">Available
                            From</label>
                        <input type="date" id="available_dates_from" name="available_dates_from" required
                            class="mt-2 block w-full border-gray-300 rounded-lg shadow-md focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 text-gray-700"
                            value="{{ $product->available_dates_from }}">

                    </div>
                    <div>
                        <label for="available_dates_to" class="block text-lg font-medium text-gray-700">Available
                            To</label>
                        <input type="date" id="available_dates_to" name="available_dates_to" required
                            class="mt-2 block w-full border-gray-300 rounded-lg shadow-md focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 text-gray-700"
                            value="{{ $product->available_dates_to }}">

                    </div>
                </div>

                <!-- Image url -->
                <div class="mb-6 mt-3">
                    <label for="image_url" class="block text-lg font-medium text-gray-700">Image URL</label>
                    <input type="text" id="image_url" name="image_url" required
                        class="mt-2 block w-full border-gray-300 rounded-lg shadow-md focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 text-gray-700"
                        value="{{ $product->image_url }}">


                </div>

                <!-- Additional Notes -->
                <div class="mb-6">
                    <label for="additional_notes" class="block text-lg font-medium text-gray-700">Additional
                        Notes</label>
                    <textarea id="additional_notes" name="additional_notes" rows="4" 
                        class="mt-2 block w-full border-gray-300 rounded-lg shadow-md focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 text-gray-700">{{ $product->additional_notes }}</textarea>

                </div>

                <!-- Submit Button -->
                <div class="mt-8">
                    <button type="submit"
                        class="w-full  text-white bg-blue-500 py-3 rounded-lg shadow-md transition duration-300 text-lg font-semibold">
                        Update Produce Details
                    </button>
                </div>




            </form>
        </div>
    </div>
</div>