<x-guest-layout>    
    <div class="max-w-6xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Subjects</h1>

        @if ($subjects->isEmpty())
        <p class="text-gray-600">No subjects found.</p>
        @else
        <div class="grid  grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($subjects as $subject)
            <div
                class="bg-white border rounded-lg shadow-md p-5 flex flex-col justify-between hover:shadow-lg transition-shadow duration-200 ease-in-out">
                <div>
                    <div class="flex justify-between">
                        <p class="text-xl font-bold text-gray-900 mb-1">{{ $subject->subject_name }}</p>
                        <p class="text-lg text-gray-700 ">Year : {{ $subject->year_id }}</p>
                    </div>
                </div>
                <div class="mt-4 flex justify-end space-x-2">
                    <button class="text-blue-500 hover:text-blue-700 text-sm font-medium"
                        aria-label="Edit subject {{ $subject->name }}">Edit</button>
                    <button class="text-red-500 hover:text-red-700 text-sm font-medium"
                        aria-label="Delete subject {{ $subject->name }}">Delete</button>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</x-guest-layout>