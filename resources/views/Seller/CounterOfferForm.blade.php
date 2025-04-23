
@include('components.navbar')

<div class="max-w-3xl mx-auto py-10 px-6 sm:px-8 lg:px-10">
    <div class="bg-white shadow-md rounded-lg p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Counter Offer</h2>
        <form action="{{ route('makecounterOffer', $order->id) }}" method="POST">
            @csrf
            <!-- Counter Price Input -->
            <div class="mb-6">
                <label for="counter_offer_price" class="block text-sm font-medium text-gray-700 mb-2">Counter Price</label>
                <input type="number" name="counter_offer_price" id="counter_offer_price" value="{{ $order->offer_price }}" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-900 px-4 py-2">
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center">
                <button type="submit"
                    class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold text-sm rounded-md hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-200 transition duration-200">
                    Send Counter Offer
                </button>
            </div>
        </form>
    </div>
</div>