<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Quizzes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('status'))
                <div class="mb-6 p-4 bg-green-100 text-green-800 border border-green-400 rounded-lg">
                    {{ session('status') }}
                </div>
            @endif
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-semibold mb-6">Available Quizzes</h3>

                    @if($quizzes->isEmpty())
                        <p class="text-gray-700">No quizzes are available at the moment.</p>
                    @else
                        <ul class="space-y-4">
                            @foreach($quizzes as $quiz)
                                <li class="bg-gray-100 p-4 rounded-lg shadow">
                                    <h4 class="text-lg font-semibold">{{ $quiz->title }}</h4>
                                    <p class="text-gray-600">{{ $quiz->description }}</p>
                                    <small class="text-gray-500">Created on {{ $quiz->created_at->format('F d, Y') }}</small>
                                    <a href="{{ route('student.answer_quiz', $quiz->id) }}" 
                                       class="block mt-4 bg-blue-600 text-white text-center px-4 py-2 rounded-lg hover:bg-blue-700">
                                        Answer Quiz
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4 flex justify-center">
        <a href="{{ route('student.portal') }}" class="text-gray-400 hover:underline">Back to Dashboard</a>
    </div>
</x-app-layout>
