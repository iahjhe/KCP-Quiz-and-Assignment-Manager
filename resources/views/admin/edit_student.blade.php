<x-app-layout>
    <h1 class="text-3xl font-bold text-white mb-6">Edit Student</h1>
    @if (session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
        {{ session('success') }}
    </div>
@endif
    <form action="{{ route('admin.update_student', $student->id) }}" method="POST" class="bg-gray-800 shadow-md rounded-lg p-6">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="block text-gray-400">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $student->name) }}" class="w-full px-4 py-2 border bg-gray-700 text-gray-200 rounded-lg" required>
            @error('name')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-gray-400">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $student->email) }}" class="w-full px-4 py-2 border bg-gray-700 text-gray-200 rounded-lg" required>
            @error('email')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <!-- Role -->
        <div class="mb-4">
            <label for="role" class="block text-gray-400">Role</label>
            <input type="text" name="role" id="role" value="{{ old('role', $student->role) }}" class="w-full px-4 py-2 border bg-gray-700 text-gray-200 rounded-lg" required>
            @error('role')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4 text-center">
            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                Update Student
            </button>
        </div>
    </form>
    <div class="mt-4 flex justify-center">
    <a href="{{ route('admin.manage_students') }}" class="text-gray-400 hover:underline">Back to Student Management</a>
    </div>
</x-app-layout>
