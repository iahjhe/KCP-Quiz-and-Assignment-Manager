<x-app-layout>
    <!-- Navbar -->
    <nav class="bg-gray-800 text-white shadow" x-data="{ open: false }">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold">Teacher Panel</a>
            <ul class="hidden md:flex space-x-6">
                {{-- Additional navigation links can be added here --}}
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
                {{-- Additional mobile menu links can be added here --}}
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto py-12 space-y-12 px-6">
        <!-- Quiz Creation Section -->
        <section id="quiz-creation" class="bg-white shadow rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Quiz Creation</h2>
            <p class="text-gray-600 mb-6">Create multiple-choice exams/quizzes with items</p>
            <div class="space-y-4">
                <a href="{{ route('teacher.create_quiz') }}" class="block text-blue-600 hover:underline">
                    ➡️ Create Quiz
                </a>
                <a href="{{ route('teacher.show_quiz') }}" class="block text-blue-600 hover:underline">
                    ➡️ Show Quizzes Created
                </a>
                <a href="{{ route('teacher.show_quiz_results') }}" class="block text-blue-600 hover:underline">
                    ➡️ Show Quizzes Results
                </a>
            </div>
        </section>

        <!-- Student Management Section -->
        <section id="student-management" class="bg-white shadow rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Student Management</h2>
            <p class="text-gray-600 mb-6">Manage students per subject and remove them if needed</p>
            <div class="space-y-4">
                <a href="{{ route('teacher.manage_students') }}" class="block text-blue-600 hover:underline">
                    ➡️ Manage Students
                </a>
            </div>
        </section>

        <!-- Invitation Section -->
      
    </div>
</x-app-layout>
