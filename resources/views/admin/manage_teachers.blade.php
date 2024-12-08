<x-app-layout>
    <nav class="bg-gray-800 text-white shadow" x-data="{ open: false }">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <a href="#" class="text-2xl font-bold">Manage Teachers</a>
            <ul class="hidden md:flex space-x-6">
                
                <li>
                    <a href="{{ route('admin.manage_teachers') }}" class="hover:text-gray-400">Teacher Accounts</a>
                </li>
                <li>
                    <a href="{{ route('admin.manage_students') }}" class="hover:text-gray-400">Student Accounts</a>
                </li>
            </ul>
            <!-- Mobile Menu Button -->
            <button @click="open = !open" class="md:hidden focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
        <!-- Mobile Menu -->
        <div x-show="open" class="md:hidden">
            <ul class="space-y-2 px-6 pb-4">
                <li>
                    <a href="{{ route('admin.manage_teachers') }}" class="block text-gray-200 hover:text-gray-400">Teaceher Accounts</a>
                </li>
                <li>
                    <a href="{{ route('admin.manage_students') }}" class="block text-gray-200 hover:text-gray-400">Student Accounts</a>
                </li>
 
            </ul>
        </div>
    </nav>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-white rounded-lg text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-gray-800 shadow-md rounded-lg mx-auto mt-8 p-6 max-w-full">
        <h2 class="text-white text-lg mb-4 font-bold">Teacher Accounts</h2>
        <table class="min-w-full table-auto border-collapse border border-gray-700">
            <thead>
                <tr class="bg-gray-700 text-gray-400">
                    <th class="border border-gray-600 px-4 py-2 text-left w-1/12">ID</th>
                    <th class="border border-gray-600 px-4 py-2 text-left w-2/12">Name</th>
                    <th class="border border-gray-600 px-4 py-2 text-left w-3/12">Email</th>
                    <th class="border border-gray-600 px-4 py-2 text-left w-2/12">Role</th>
                    <th class="border border-gray-600 px-4 py-2 text-center w-1/12">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($teachers as $teacher)
                    <tr class="text-gray-400 hover:bg-gray-700">
                        <td class="border border-gray-600 px-4 py-2">{{ $teacher->id }}</td>
                        <td class="border border-gray-600 px-4 py-2">{{ $teacher->name }}</td>
                        <td class="border border-gray-600 px-4 py-2">{{ $teacher->email }}</td>
                        <td class="border border-gray-600 px-4 py-2">{{ $teacher->role }}</td>
                        <td class="border border-gray-600 px-4 py-2 text-center space-x-2">
                            <a href="{{ url('edit_teacher', $teacher->id) }}" class="text-blue-400 hover:underline">
                                Edit
                            </a>

                            <form action="{{ url('admin.delete_teacher', $teacher->id) }}" method="POST" class="inline">
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
                            No teachers found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="bg-gray-800 shadow-md rounded-lg mx-auto mt-8 p-6 max-w-full">
        <h2 class="text-white text-lg mb-4 font-bold">Create New Teacher Account</h2>
        <form action="{{ url('create_teacher') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-gray-400">Name</label>
                <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded-lg bg-gray-700 text-gray-100" required>
            </div>
            <div>
                <label for="email" class="block text-gray-400">Email</label>
                <input type="email" name="email" id="email" class="w-full px-4 py-2 border rounded-lg bg-gray-700 text-gray-100" required>
            </div>
            <div>
                <label for="password" class="block text-gray-400">Password</label>
                <input type="password" name="password" id="password" class="w-full px-4 py-2 border rounded-lg bg-gray-700 text-gray-100" required>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Create Teacher
            </button>
        </form>
    </div>
    <div class="mt-4 flex justify-center">
        <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:underline">Back to Dashboard</a>
    </div>
</x-app-layout>
