<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Portal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-semibold mb-6">Welcome to the Student Portal</h3>

                    <!-- Join Class Section -->
                    <section id="join-class" class="mb-12">
                        <h4 class="text-xl font-semibold mb-4">Join a Class</h4>
                        <form action="{{ route('student.join_class') }}" method="POST" class="space-y-4">
                            @csrf
                            <!-- Subject/Teacher Code -->
                            <div>
                                <label for="invitation_code" class="block text-gray-700">Enter Class Code</label>
                                <input type="text" id="invitation_code" name="invitation_code" class="w-full px-4 py-2 border rounded-lg bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-600" required placeholder="Enter invitation code">
                            </div>

                            <!-- Student ID -->
                            <div>
                                <label for="student_id" class="block text-gray-700">Your Student ID</label>
                                <input type="text" id="student_id" name="student_id" class="w-full px-4 py-2 border rounded-lg bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-600" required placeholder="Enter your student ID">
                            </div>

                            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600">
                                Join Class
                            </button>
                        </form>
                    </section>

                    <!-- Quiz Access Section -->
                    <section id="quiz-access">
                        <h4 class="text-xl font-semibold mb-4">Quiz Access</h4>
                        <p class="text-gray-700 mb-4">Access your quizzes and view your results below.</p>

                        <!-- Button to View Quizzes -->
                        <a href="{{ route('student.view_quizzes') }}" class="block text-blue-600 hover:underline mb-4">
                            ➡️ View My Quizzes
                        </a>

                        <!-- Button to View Results -->
                        <a href="{{ route('student.view_results') }}" class="block text-blue-600 hover:underline">
                            ➡️ View My Results
                        </a>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
