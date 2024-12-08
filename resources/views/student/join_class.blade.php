<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Under Construction') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-center text-gray-900 dark:text-gray-100">
                    <h1 class="text-3xl font-bold mb-4">🚧 This Page is Under Construction 🚧</h1>
                    <p class="text-lg mb-6">We're working hard to bring you this feature soon. Stay tuned!</p>

                    <!-- Animation Section -->
                    <div class="flex justify-center items-center space-x-4">
                        <img src="https://cdn-icons-png.flaticon.com/512/3097/3097200.png" 
                             alt="Construction Icon" 
                             class="w-16 h-16 animate-bounce">
                        <div class="loader"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4 flex justify-center">
        <a href="{{ route('student.portal') }}" class="text-gray-400 hover:underline">Back to Dashboard</a>
    </div>
    <style>
        /* Loader Animation */
        .loader {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</x-app-layout>
