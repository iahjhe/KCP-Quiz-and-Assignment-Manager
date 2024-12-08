<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Results') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class= dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-semibold mb-6">Quiz Results</h3>

                    @if($results->isEmpty())
                        <p class="text-gray-700">You have no results yet.</p>
                    @else
                        <table class="w-full text-left table-auto">
                            <thead>
                                <tr class="text-gray-300">
                                    <th class="px-4 py-2">Quiz Title</th>
                                    <th class="px-4 py-2">Score</th>
                                    <th class="px-4 py-2">Total</th>
                                    <th class="px-4 py-2">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($results as $result)
                                    <tr class="border-t">
                                        <td class="px-4 py-2">{{ $result->quiz->title }}</td>
                                        <td class="px-4 py-2">{{ $result->score }}</td>
                                        <td class="px-4 py-2">{{ $result->total }}</td>
                                        <td class="px-4 py-2">{{ $result->created_at->format('F d, Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4 flex justify-center">
        <a href="{{ route('student.portal') }}" class="text-gray-400 hover:underline">Back to Dashboard</a>
    </div>
</x-app-layout>
