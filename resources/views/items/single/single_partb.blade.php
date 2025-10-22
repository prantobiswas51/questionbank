<x-guest-layout>    
    <div class="max-w-6xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Part B answer</h1>

        <div
            class="bg-white border rounded-lg shadow-md p-5 flex flex-col justify-between hover:shadow-lg transition-shadow duration-200 ease-in-out">
            <div>
                <p class="text-xl font-bold text-gray-900 mb-1">{{ $question->id }} . {{ $question->part_b_qs }}</p>
                
                <div class="mt-4">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">Answer:</h2>
                    <p class="text-gray-700">{!! $question->part_b_ans !!}</p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
