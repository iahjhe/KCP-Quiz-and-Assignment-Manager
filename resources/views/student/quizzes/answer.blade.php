<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Answer Quiz: ') . $quiz->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-semibold mb-6">{{ $quiz->title }}</h3>
                    <form action="{{ route('student.submit_quiz', $quiz->id) }}" method="POST">
                        @csrf
                        @foreach($quiz->questions as $index => $question)
                            <div class="mb-6">
                                <p class="text-lg font-semibold">{{ $index + 1 }}. {{ $question->question }}</p>
                                @foreach(json_decode($question->options, true) as $option)
                                    <label class="block mt-2">
                                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option }}" required>
                                        {{ $option }}
                                    </label>
                                @endforeach
                            </div>
                        @endforeach
                        <button type="submit" 
                                class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                            Submit Answers
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
