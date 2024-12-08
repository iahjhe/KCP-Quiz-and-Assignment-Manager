<x-app-layout>
    <div class="container mx-auto py-12 px-6">
        <section id="student-list" class="bg-white shadow rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Manage Students</h2>
            
            <!-- Check if there are students -->
            @if($students->isEmpty())
                <p class="text-gray-600">No students found.</p>
            @else
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 text-gray-700">Student Name</th>
                            <th class="px-4 py-2 text-gray-700">Subjects</th>
                            <th class="px-4 py-2 text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $student->name }}</td>
                                <!-- Display assigned subjects -->
                                <td class="px-4 py-2">
                                    @if($student->subjects->isNotEmpty())
                                        @foreach($student->subjects as $subject)
                                            <div class="flex items-center space-x-2">
                                                <p class="text-gray-600">{{ $subject->name }}</p>
                                                
                                                <!-- Delete assigned subject form -->
                                                <form action="{{ route('teacher.delete_assigned_subject', [$student->id, $subject->id]) }}" method="POST" class="inline-block" onsubmit="return confirmRemoval()">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800">Remove</button>
                                                </form>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-gray-500">No Subjects Assigned</p>
                                    @endif
                                </td>
                                <td class="px-4 py-2 space-x-2">
                                    <!-- Assign Subject Form -->
                                    <form action="{{ route('teacher.assign_subject', $student->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        <select name="subject_id[]" class="px-4 py-2 border rounded-lg bg-gray-100 text-gray-700 focus:ring-2 focus:ring-blue-600 focus:outline-none" multiple required>
                                            <option value="">Select Subjects</option>
                                            @foreach($subjects as $subject)
                                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg">Assign Subjects</button>
                                    </form>
                                    
                                    <!-- Delete Student Form -->
                                    <form action="{{ route('teacher.delete_student', $student->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this student?')" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-white bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </section>
    </div>

    <script>
        function confirmRemoval() {
            return confirm("Are you sure you want to remove this subject?");
        }
    </script>
</x-app-layout>
