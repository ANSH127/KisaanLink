@include('components.navbar')

<div>
    <head>
        @vite('resources/css/app.css')
    </head>

    <div class="grid grid-cols-1 lg:grid-cols-2 p-5 md:p-10 gap-3">
        <div class="col-span-1">
            <img src="{{ asset('images/login.jpg') }}" alt="Sign Up Image" class="w-full h-3/4 lg:h-full object-cover">
        </div>
        <div class="w-full flex items-center justify-center">
            <div class="w-full px-6 md:px-4"> <!-- Increased max width and padding -->
                <h2 class="text-2xl md:text-3xl font-bold mb-6 text-center">Create an Account</h2> <!-- Larger heading -->
                <form method="POST">
                    @csrf
                    

                    <div class="mb-6">
                        <label for="role" class="block text-base font-medium text-gray-700">Role</label>
                        <select name="role" id="role" required
                            class="focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 w-full py-3  rounded-md shadow-sm text-base border-1 border-black">
                            <option>Purchaser</option>
                            <option>Seller</option>
                        </select>
                    </div>
                    <div class="mb-6"> <!-- Increased margin for spacing -->
                        <label for="name" class="block text-base font-medium text-gray-700">Name</label> <!-- Larger label -->
                        <input type="text" name="name" id="name" required
                            class="py-3 mt-2 block w-full  rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-base border-1 border-black"> <!-- Larger input -->
                    </div>

                    <div class="mb-6">
                        <label for="email" class="block text-base font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" required
                            class="mt-2 py-3 block w-full rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-base border-1 border-black">
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block text-base font-medium text-gray-700">Password</label>
                        <input type="password" name="password" id="password" required
                            class="mt-2 py-3 block w-full  rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-base border-1 border-black">
                    </div>
                    <div class="mb-6">
                        <label for="phone"  class="block text-base font-medium text-gray-700">Phone</label>
                        <input type="text" name="phone" id="phone" 
                            class="mt-2 py-3 block w-full  rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-base border-1 border-black">
                    </div>
                    <div class="mb-6">
                        <label for="address" class="block text-base font-medium text-gray-700">Address</label>
                        <input type="text" name="address" id="address" 
                            class="mt-2 py-3 block w-full  rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-base border-1 border-black">
                    </div>


                    <div class="mt-6 mb-4 text-center">
                        <p class="text-sm text-gray-600">Already have an account? <a href="{{ route('login') }}"
                                class="text-blue-600 hover:underline">Log in</a></p>
                    </div>
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-3 rounded-md hover:bg-blue-700 transition duration-200 text-lg">Sign
                        Up</button> <!-- Larger button -->
                </form>
            </div>
        </div>
    </div>
</div>