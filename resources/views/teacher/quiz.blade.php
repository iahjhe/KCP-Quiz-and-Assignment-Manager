<x-app-layout>
    <div class="container mx-auto py-12 px-6">
        <!-- Quiz Header -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h1 class="text-3xl font-bold text-gray-800">{{ $quiz->title }}</h1>
            <p class="text-gray-600 mt-2">{{ $quiz->description }}</p>
        </div>

        <!-- Questions Section -->
        @if(!empty($quiz->questions) && is_array($quiz->questions))
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Questions</h2>
                <ul class="space-y-6">
                    @foreach ($quiz->questions as $index => $question)
                        <li class="bg-gray-50 shadow-sm p-4 rounded-lg border border-gray-200">
                            <div class="mb-2">
                                <span class="text-gray-700 font-semibold">{{ $index + 1 }}.</span>
                                <span class="text-gray-800">{{ $question['question'] }}</span>
                            </div>
                            <ul class="space-y-2 mt-2">
                                @if(!empty($question['options']) && is_array($question['options']))
                                    @foreach ($question['options'] as $option)
                                        <li class="bg-gray-100 px-3 py-2 rounded-lg border border-gray-200">
                                            <span class="text-gray-700">•</span>
                                            <span class="text-gray-800">{{ $option }}</span>
                                        </li>
                                    @endforeach
                                @else
                                    <li>
                                        <p class="text-gray-600 italic">No options available.</p>
                                    </li>
                                @endif
                            </ul>

                            <!-- Display Correct Answer -->
                            @if(!empty($question['correct_answer']))
                                <p class="text-green-600 font-semibold mt-4">
                                    Correct Answer: 
                                    <span class="font-normal text-gray-800">{{ $question['correct_answer'] }}</span>
                                </p>
                            @else
                                <p class="text-gray-600 italic mt-4">No correct answer available.</p>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            <!-- No Questions Placeholder -->
            <div class="bg-white shadow-md rounded-lg p-6 mt-6">
                <p class="text-gray-600 text-center">No questions available for this quiz.</p>
            </div>
        @endif

        <!-- Back Button -->
        <div class="mt-8 flex justify-center">
            <a href="{{ route('teacher.show_quiz') }}" class="text-blue-600 hover:underline text-lg font-medium">
                ← Back to Quizzes
            </a>
        </div>
    </div>
</x-app-layout>
