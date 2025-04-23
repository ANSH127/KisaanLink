@include('components.navbar')
<div class="max-w-4xl mx-auto py-10 px-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Your Profile</h1>
    <div class="bg-white shadow-md rounded-lg p-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Name -->
            <div>
                <p class="text-sm font-medium text-gray-600">Name</p>
                <p class="text-lg font-semibold text-gray-800">{{ $user->name }}</p>
            </div>
            <!-- Email -->
            <div>
                <p class="text-sm font-medium text-gray-600">Email</p>
                <p class="text-lg font-semibold text-gray-800">{{ $user->email }}</p>
            </div>
            <!-- Phone -->
            <div>
                <p class="text-sm font-medium text-gray-600">Phone</p>
                <p class="text-lg font-semibold text-gray-800">{{ $user->phone?? "NA" }}</p>
            </div>
            <!-- Address -->
            <div>
                <p class="text-sm font-medium text-gray-600">Address</p>
                <p class="text-lg font-semibold text-gray-800">{{ $user->address }}</p>
            </div>
            <!-- Role -->
            <div>
                <p class="text-sm font-medium text-gray-600">Role</p>
                <p class="text-lg font-semibold text-gray-800">{{ ucfirst($user->role) }}</p>
            </div>
        </div>
    </div>
</div>