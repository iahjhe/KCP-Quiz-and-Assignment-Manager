<x-app-layout>
    <h1 class="text-3xl font-bold text-white mb-6">Edit Teacher</h1>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.update-teacher', $teachers->id) }}" method="POST" class="bg-gray-800 shadow-md rounded-lg p-6">
        @csrf
        @method('PUT')

        <!-- Teacher Name -->
        <div class="mb-4">
            <label for="name" class="block text-gray-400">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $teachers->name) }}" class="w-full px-4 py-2 border border-gray-600 bg-gray-700 text-gray-200 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required>
            @error('name')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <!-- Teacher Email -->
        <div class="mb-4">
            <label for="email" class="block text-gray-400">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $teachers->email) }}" class="w-full px-4 py-2 border border-gray-600 bg-gray-700 text-gray-200 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required>
            @error('email')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <!-- Teacher Role -->
        <div class="mb-4">
            <label for="role" class="block text-gray-400">Role</label>
            <input type="text" name="role" id="role" value="{{ old('role', $teachers->role) }}" class="w-full px-4 py-2 border border-gray-600 bg-gray-700 text-gray-200 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required>
            @error('role')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="mb-4 text-center">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">Update</button>
        </div>
    </form>
    <div class="mt-4 flex justify-center">
    <a href="{{ route('admin.manage_teachers') }}" class="text-gray-400 hover:underline">Back to Teacher Management</a>
    </div>

</x-app-layout>
