@include('components.navbar')

<div class="max-w-2xl mx-auto py-10 px-6">
    <div class="flex flex-col items-center mb-8">
        <!-- User Avatar -->
        <div
            class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-2xl font-bold">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
        <h1 class="text-2xl font-bold text-gray-800 mt-4">{{ $user->name }}</h1>
    </div>

    <div class="space-y-6">
        <!-- Email -->
        <div>
            <p class="text-sm font-medium text-gray-600">Email</p>
            <input type="text" value="{{ $user->email }}" readonly
                class="w-full bg-gray-100 border border-gray-300 rounded-md px-4 py-2 text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <!-- Phone -->
        <div>
            <p class="text-sm font-medium text-gray-600">Phone</p>
            <input type="text" value="{{ $user->phone ?? 'NA' }}" readonly
                class="w-full bg-gray-100 border border-gray-300 rounded-md px-4 py-2 text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <!-- Address -->
        <div>
            <p class="text-sm font-medium text-gray-600">Address</p>
            <input type="text" value="{{ $user->address }}" readonly
                class="w-full bg-gray-100 border border-gray-300 rounded-md px-4 py-2 text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <!-- Role -->
        <div>
            <p class="text-sm font-medium text-gray-600">Role</p>
            <input type="text" value="{{ ucfirst($user->role) }}" readonly
                class="w-full bg-gray-100 border border-gray-300 rounded-md px-4 py-2 text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <!-- Logout button -->
        <div class="mt-6 text-center">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-semibold text-sm rounded-md hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-200 transition duration-200">
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>