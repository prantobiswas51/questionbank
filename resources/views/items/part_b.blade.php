<x-guest-layout>
    <div class="max-w-6xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Part B Questions</h1>

        @if ($partb->isEmpty())
        <p class="text-gray-600">No Part B questions found.</p>
        @else
        <div class="grid  grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($partb as $question)
            <a href="{{ route('partb.show', $question->id) }}">
                <div
                    class="bg-white border rounded-lg shadow-md p-5 flex flex-col justify-between hover:shadow-lg transition-shadow duration-200 ease-in-out">
                    <div>
                        <div class="flex justify-between">
                            <p class="text-xl font-bold text-gray-900 mb-1">{{ $question->id }} . {{
                                $question->part_b_qs }}</p>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end space-x-2">

                    </div>
                </div>
            </a>
            @endforeach
        </div>
        @endif
    </div>
</x-guest-layout>