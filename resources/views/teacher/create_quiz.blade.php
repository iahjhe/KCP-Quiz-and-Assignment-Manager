<x-app-layout>
    <div class="container mx-auto py-12 space-y-12 px-6">
        <!-- Quiz Creation Form -->
        <section id="quiz-creation" class="bg-white shadow rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Create a New Quiz</h2>
            <form action="{{ route('teacher.storeQuiz') }}" method="POST">
                @csrf

                <!-- Select Subject -->
                <div class="mb-6">
                    <label for="subject_id" class="block text-gray-800 font-medium">Select Subject</label>
                    <select name="subject_id" id="subject_id" class="w-full p-3 border border-gray-300 rounded" required>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                
                

                <!-- Quiz Title -->
                <div class="mb-6">
                    <label for="title" class="block text-gray-800 font-medium">Quiz Title</label>
                    <input type="text" name="title" id="title" class="w-full p-3 border border-gray-300 rounded" required>
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description (Optional)</label>
                    <textarea name="description" id="description" class="mt-1 block w-full" rows="4"></textarea>
                </div>

                <!-- Questions Section -->
                <div id="questions-container" class="space-y-6">
                    <div class="question mb-6">
                        <label for="question-1" class="block text-gray-800 font-medium">Question 1</label>
                        <input type="text" name="questions[0][question]" id="question-1" class="w-full p-3 border border-gray-300 rounded mb-4" required>

                        <label for="options-1" class="block text-gray-800 font-medium">Options (comma separated)</label>
                        <input type="text" name="questions[0][options][]" class="w-full p-3 border border-gray-300 rounded mb-2" required>
                        <input type="text" name="questions[0][options][]" class="w-full p-3 border border-gray-300 rounded mb-2" required>
                        <input type="text" name="questions[0][options][]" class="w-full p-3 border border-gray-300 rounded mb-2" required>

                        <label for="correct-answer-1" class="block text-gray-800 font-medium">Correct Answer</label>
                        <input type="text" name="questions[0][correct_answer]" id="correct-answer-1" class="w-full p-3 border border-gray-300 rounded mb-4" required>
                    </div>
                </div>

                <!-- Add More Questions Button -->
                <div class="mb-6">
                    <button type="button" id="add-question" class="text-blue-600 hover:underline">+ Add More Questions</button>
                </div>

                <button type="submit" class="bg-blue-600 text-black px-6 py-3 rounded-lg hover:bg-blue-500">Create Quiz</button>
            </form>
        </section>
    </div>
    <div class="mt-4 flex justify-center">
        <a href="{{ route('teacher.dashboard') }}" class="text-gray-400 hover:underline">Back to Dashboard</a>
    </div>
    <script>
        document.getElementById('add-question').addEventListener('click', function() {
            const questionCount = document.querySelectorAll('.question').length + 1;
            const questionContainer = document.createElement('div');
            questionContainer.classList.add('question', 'mb-6');
            questionContainer.innerHTML = `
                <label for="question-${questionCount}" class="block text-gray-800 font-medium">Question ${questionCount}</label>
                <input type="text" name="questions[${questionCount - 1}][question]" id="question-${questionCount}" class="w-full p-3 border border-gray-300 rounded mb-4" required>

                <label for="options-${questionCount}" class="block text-gray-800 font-medium">Options (comma separated)</label>
                <input type="text" name="questions[${questionCount - 1}][options][]" class="w-full p-3 border border-gray-300 rounded mb-2" required>
                <input type="text" name="questions[${questionCount - 1}][options][]" class="w-full p-3 border border-gray-300 rounded mb-2" required>
                <input type="text" name="questions[${questionCount - 1}][options][]" class="w-full p-3 border border-gray-300 rounded mb-2" required>

                <label for="correct-answer-${questionCount}" class="block text-gray-800 font-medium">Correct Answer</label>
                <input type="text" name="questions[${questionCount - 1}][correct_answer]" id="correct-answer-${questionCount}" class="w-full p-3 border border-gray-300 rounded mb-4" required>
            `;
            document.getElementById('questions-container').appendChild(questionContainer);
        });
    </script>
</x-app-layout>
