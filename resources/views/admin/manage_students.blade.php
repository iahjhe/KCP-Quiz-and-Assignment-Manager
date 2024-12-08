<x-app-layout>
    <nav class="bg-gray-900 text-white shadow" x-data="{ open: false }">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <a href="#" class="text-2xl font-bold">Manage Students</a>
            <ul class="hidden md:flex space-x-6">
                <li>
                    <a href="{{ route('admin.manage_teachers') }}" class="hover:text-gray-400">Teacher Accounts</a>
                </li>
                <li>
                    <a href="{{ route('admin.manage_students') }}" class="hover:text-gray-400">Student Accounts</a>
                </li>
            </ul>
            <button @click="open = !open" class="md:hidden focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
        <div x-show="open" class="md:hidden">
            <ul class="space-y-2 px-6 pb-4">
                <li>
                    <a href="{{ route('admin.manage_teachers') }}" class="hover:text-gray-400">Teacher Accounts</a>
                </li>
                <li>
                    <a href="{{ route('admin.manage_students') }}" class="hover:text-gray-400">Student Accounts</a>
                </li>
            </ul>
        </div>
    </nav>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-600 text-white rounded-lg">
            {{ session('success') }}
        </div>
    @endif


    <!-- Student Management Table -->
    <div class="overflow-x-auto bg-gray-800 shadow-md rounded-lg">
        <table class="min-w-full table-auto border-collapse border border-gray-700">
            <thead>
                <tr class="bg-gray-700 text-gray-200">
                    <th class="border border-gray-600 px-4 py-2 text-left">ID</th>
                    <th class="border border-gray-600 px-4 py-2 text-left">Name</th>
                    <th class="border border-gray-600 px-4 py-2 text-left">Email</th>
                    <th class="border border-gray-600 px-4 py-2 text-left">Role</th>
                    <th class="border border-gray-600 px-4 py-2 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $student)
                    <tr class="text-gray-300 hover:bg-gray-700">
                        <td class="border border-gray-600 px-4 py-2">{{ $student->id }}</td>
                        <td class="border border-gray-600 px-4 py-2">{{ $student->name }}</td>
                        <td class="border border-gray-600 px-4 py-2">{{ $student->email }}</td>
                        <td class="border border-gray-600 px-4 py-2">{{ $student->role }}</td>
                        <td class="border border-gray-600 px-4 py-2 text-center space-x-2">
                            <a href="{{ url('edit_student', $student->id) }}" class="text-blue-400 hover:underline">
                                Edit
                            </a>

                            <form action="{{ url('delete_student', $student->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:underline">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="text-gray-500">
                        <td colspan="5" class="border border-gray-600 px-4 py-2 text-center">
                            No students found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


    <!-- Create Student Form -->
    <div class="bg-gray-900 shadow-md rounded-lg p-6 mb-6">
        <h2 class="text-xl font-semibold text-white mb-4">Create Student Account</h2>

        <form action="{{ route('admin.store_student') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-gray-400">Name</label>
                <input type="text" id="name" name="name" class="w-full bg-gray-700 text-gray -300 rounded-lg px-4 py-2 focus:outline-none focus:ring" required>
            </div>

            <div>
                <label for="email" class="block text-gray-400">Email</label>
                <input type="email" id="email" name="email" class="w-full bg-gray-700 text-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring" required>
            </div>

            <div>
                <label for="password" class="block text-gray-400">Password</label>
                <input type="password" id="password" name="password" class="w-full bg-gray-700 text-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring" required>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white rounded-lg py-2 hover:bg-blue-500">
                Create Student
            </button>
        </form>
    </div>
    <div class="mt-4 flex justify-center">
        <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:underline">Back to Dashboard</a>
    </div>
</x-app-layout>