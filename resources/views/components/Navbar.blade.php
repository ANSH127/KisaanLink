<head>
    @vite('resources/css/app.css')
</head>
<div class="bg-black text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Left: Website Name -->
            <div class="flex-shrink-0">
                <a href="/dashboard" class="text-xl font-bold hover:text-green-300">FarmerPortal</a>
            </div>

            <!-- Right: Navigation Links -->
            @if (session('user'))
                <div class="hidden md:flex space-x-6">

                    @if (session('user')->role == 'Seller')


                        <a href="/dashboard" class="hover:text-green-300 py-2">Dashboard</a>
                        <a href="/products" class="hover:text-green-300 py-2">Products</a>
                        <a href="/add-product" class="hover:text-green-300 py-2">Add Product</a>
                        <a href="/f/orders" class="hover:text-green-300 py-2">Orders</a>

                    @else
                        <a href="/dashboard" class="hover:text-green-300 py-2">Dashboard</a>
                        <a href="/orders" class="hover:text-green-300 py-2">Orders</a>
                    @endif


                    <form method="POST" action="/logout" class="inline">
                        @csrf
                        <button type="submit" class="hover:text-red-300
                                    bg-blue-500  p-2 rounded-lg text-white font-semibold hover:bg-blue-600 cursor-pointer">

                            <span class="hidden md:inline">Logout</span>
                        </button>
                    </form>

            @else
                <div class="hidden md:flex space-x-3">
                    <a href="/login" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg">Login</a>
                    <a href="/signup" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg">Sign Up</a>
                </div>
            @endif

            </div>
        </div>
    </div>
</div>