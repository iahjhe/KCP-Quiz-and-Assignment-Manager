<x-app-layout>
    <div class="container mx-auto py-12 px-6">
        <section id="quiz-list" class="bg-white shadow rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Your Created Quizzes</h2>
            
            @if ($quizzes->isEmpty())
                <p class="text-gray-600">You haven't created any quizzes yet.</p>
            @else
                <div class="space-y-4">
                    @foreach ($quizzes as $quiz)
                        <div class="border-b border-gray-200 pb-4">
                            <h3 class="text-xl font-medium text-gray-800">{{ $quiz->title }}</h3>
                            <p class="text-gray-600">{{ Str::limit($quiz->description, 100) }}</p>
                            
                            <div class="mt-4 flex">
                                <a href="{{ route('teacher.showQuiz', $quiz->id) }}" class="mr-6 text-blue-600 hover:underline">View Quiz</a>
                                <a href="{{ route('teacher.editQuiz', $quiz->id) }}" class="mr-6 text-yellow-600 hover:underline">Edit Quiz</a>
                                <form action="{{ route('teacher.deleteQuiz', $quiz->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete Quiz</button>
                                </form>
                            </div>
                            
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    </div>
    <div class="mt-4 flex justify-center">
        <a href="{{ route('teacher.dashboard') }}" class="text-gray-400 hover:underline">Back to Dashboard</a>
    </div>
</x-app-layout>
