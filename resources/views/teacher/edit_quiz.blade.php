<x-app-layout>
    <div class="container mx-auto py-12 px-6">
        <h1 class="text-white text-2xl font-bold">Edit Quiz: {{ $quiz->title }}</h1>

        <form action="{{ route('teacher.updateQuiz', $quiz->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="title" class="block text-white font-medium">Quiz Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $quiz->title) }}" class="w-full p-3 border border-gray-300 rounded mb-4" required>
            </div>

            <div class="mb-6">
                <label for="description" class="block text-white font-medium">Quiz Description</label>
                <textarea name="description" id="description" class="w-full p-3 border border-gray-300 rounded mb-4">{{ old('description', $quiz->description) }}</textarea>
            </div>

            <h2 class="text-xl text-white font-semibold mt-8">Questions</h2>
            <div id="questions-container">
                @foreach ($questions as $index => $question)
                    <div class="question mb-6">
                        <label for="question-{{ $index }}" class="block text-gray-400 font-medium">Question {{ $index + 1 }}</label>
                        <input type="text" name="questions[{{ $index }}][question]" id="question-{{ $index }}" value="{{ old('questions.'.$index.'.question', $question['question']) }}" class="w-full p-3 border border-gray-300 rounded mb-4" required>

                        <label for="options-{{ $index }}" class="block text-gray-400 font-medium">Options</label>
                        @foreach ($question['options'] as $optIndex => $option)
                            <input type="text" name="questions[{{ $index }}][options][]" value="{{ old('questions.'.$index.'.options.'.$optIndex, $option) }}" class="w-full p-3 border border-gray-300 rounded mb-2" required>
                        @endforeach

                        <label for="correct-answer-{{ $index }}" class="block text-gray-400 font-medium">Correct Answer</label>
                        <input type="text" name="questions[{{ $index }}][correct_answer]" id="correct-answer-{{ $index }}" value="{{ old('questions.'.$index.'.correct_answer', $question['correct_answer']) }}" class="w-full p-3 border border-gray-300 rounded mb-4" required>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded">Update Quiz</button>
        </form>
    </div>
    <div class="mt-4 flex justify-center">
        <a href="{{ route('teacher.show_quiz') }}" class="text-gray-400 hover:underline">Back to Quizzes</a>
    </div>
</x-app-layout>
