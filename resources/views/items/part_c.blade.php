<x-guest-layout>
    <div class="max-w-6xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Part C Questions</h1>

        @if ($partc->isEmpty())
        <p class="text-gray-600">No Part C questions found.</p>
        @else
        <div class="grid  grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($partc as $question)
            <a href="{{ route('partc.show', $question->id) }}">
                <div
                    class="bg-white border rounded-lg shadow-md p-5 flex flex-col justify-between hover:shadow-lg transition-shadow duration-200 ease-in-out">
                    <div>
                        <div class="flex justify-between">
                            <p class="text-xl font-bold text-gray-900 mb-1">{{ $question->id }} . {{
                                $question->part_c_qs }}</p>
                            <p class="text-lg text-gray-700 "> </p>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        @endif
    </div>
</x-guest-layout>