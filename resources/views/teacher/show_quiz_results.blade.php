<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quiz Results') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
                <h3 class="text-2xl font-semibold mb-6">All Quiz Results</h3>

                @if($quizzes->isEmpty())
                    <p class="text-gray-700">No quizzes have been created yet.</p>
                @else
                    @foreach($quizzes as $quiz)
                        <div class="mb-8">
                            <h4 class="text-xl font-semibold">{{ $quiz->title }}</h4>
                            <p class="text-gray-600">{{ $quiz->description }}</p>
                            <p class="text-gray-500 mb-4">Created on {{ $quiz->created_at->format('F d, Y') }}</p>

                            <table class="w-full border-collapse border border-gray-300 mb-6">
                                <thead>
                                    <tr class="bg-gray-100 text-left">
                                        <th class="border border-gray-300 px-4 py-2">Student Name</th>
                                        <th class="border border-gray-300 px-4 py-2">Score</th>
                                        <th class="border border-gray-300 px-4 py-2">Date Taken</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($quiz->results as $result)
                                        <tr>
                                            <td class="border border-gray-300 px-4 py-2">{{ $result->student->name }}</td>
                                            <td class="border border-gray-300 px-4 py-2">{{ $result->score }}</td>
                                            <td class="border border-gray-300 px-4 py-2">{{ $result->created_at->format('F d, Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="mt-4 flex justify-center">
        <a href="{{ route('teacher.dashboard') }}" class="text-gray-400 hover:underline">Back to Dashboard</a>
    </div>
</x-app-layout>
