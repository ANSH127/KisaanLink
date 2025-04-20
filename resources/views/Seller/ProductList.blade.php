@include('components.navbar')

<div class="min-h-screen bg-gray-100 py-8">

    <head>
        @vite('resources/css/app.css')
    </head>
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative max-w-4xl mx-auto mb-6"
            role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="max-w-6xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Product List</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-3 px-4 border-b text-left text-sm font-medium text-gray-700">Product Image</th>
                        <th class="py-3 px-4 border-b text-left text-sm font-medium text-gray-700">Product Name</th>
                        <th class="py-3 px-4 border-b text-left text-sm font-medium text-gray-700">Product Type</th>
                        <th class="py-3 px-4 border-b text-left text-sm font-medium text-gray-700">Quality Grade</th>
                        <th class="py-3 px-4 border-b text-left text-sm font-medium text-gray-700">Available From</th>
                        <th class="py-3 px-4 border-b text-left text-sm font-medium text-gray-700">Available To</th>
                        <th class="py-3 px-4 border-b text-left text-sm font-medium text-gray-700">Qty Left(in kg)</th>
                        <th class="py-3 px-4 border-b text-left text-sm font-medium text-gray-700">Additional Notes</th>
                        <th class="py-3 px-4 border-b text-left text-sm font-medium text-gray-700">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="hover:bg-gray-100">
                            <td class="py-3 px-4 border-b text-sm text-gray-700">
                                <img src="{{ $product->image_url}}" alt="Product Image"
                                    class="w-16 h-16 object-cover rounded">
                            </td>
                            <td class="py-3 px-4 border-b text-sm text-gray-700">{{ $product->product_name }}</td>
                            <td class="py-3 px-4 border-b text-sm text-gray-700">{{ $product->produce_type }}</td>
                            <td class="py-3 px-4 border-b text-sm text-gray-700">{{ $product->quality_grade }}</td>
                            <td class="py-3 px-4 border-b text-sm text-gray-700">{{ $product->available_dates_from }}</td>
                            <td class="py-3 px-4 border-b text-sm text-gray-700">{{ $product->available_dates_to }}</td>
                            <td class="py-3 px-4 border-b text-sm text-gray-700">{{ $product->quantity }}</td>
                            <td class="py-3 px-4 border-b text-sm text-gray-700">

                                <ul class="list-disc pl-5">
                                    @foreach (explode(',', $product->additional_notes) as $note)
                                        <li>{{ trim($note) }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="py-9 px-4 border-b text-sm text-gray-700">
                                <a href="/products/{{$product->id }}/edit" class="text-blue-500 hover:text-blue-700 font-medium
                                            bg-green-100 hover:bg-green-200 rounded px-2 py-1  block">Edit</a>
                                <form method="POST" action="/products/{{ $product->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 font-medium
                                                bg-red-100 hover:bg-red-200 rounded px-2 py-1 mt-1 block">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>