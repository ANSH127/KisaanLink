@include('components.navbar')

<div>

    <head>
        @vite('resources/css/app.css')
    </head>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-5 mx-auto w-full max-w-md"
            role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>

        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-5 mx-auto w-full max-w-md"
            role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 p-5 md:p-10 gap-3">

        <div class="col-span-1">
            <img src="{{ asset('images/signup.jpg') }}" alt="Login Image" class="w-full h-3/4 lg:h-full object-cover">
        </div>
        <div class="w-full flex items-center justify-center">
            <div class="w-full px-6 md:px-4"> <!-- Increased max width and padding -->
                <h2 class="text-2xl md:text-3xl font-bold mb-6 text-center">Welcome Back</h2> <!-- Larger heading -->
                <form method="POST">
                    @csrf
                    <div class="mb-6"> <!-- Increased margin for spacing -->
                        <label for="email" class="block text-base font-medium text-gray-700">Email</label>
                        <!-- Larger label -->
                        <input type="email" name="email" id="email" required
                            class="py-3 mt-2 block w-full rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-base border-1 border-black">
                        <!-- Larger input -->
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block text-base font-medium text-gray-700">Password</label>
                        <input type="password" name="password" id="password" required
                            class="mt-2 py-3 block w-full  rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-base border-1 border-black">
                    </div>
                    <div class="mt-6 mb-4 text-center">
                        <p class="text-sm text-gray-600">Don't have an account? <a href="{{ route('signup') }}"
                                class="text-blue-600 hover:underline">Sign up</a></p>
                    </div>
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-3 rounded-md hover:bg-blue-700 transition duration-200 text-lg">Log
                        In</button> <!-- Larger button -->
                </form>
            </div>
        </div>
    </div>

</div>