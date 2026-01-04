<x-guest-layout>    
    <div class="max-w-6xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Part C answer</h1>

        <div
            class="bg-white border rounded-lg shadow-md p-5 flex flex-col justify-between hover:shadow-lg transition-shadow duration-200 ease-in-out">
            <div>
                <p class="text-xl font-bold text-gray-900 mb-1">{{ $question->id }} . {{ $question->part_c_qs }}</p>
                
                <div class="mt-4">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">Answer:</h2>
                    <div class="text-gray-800 prose prose-sm max-w-none [&>p]:mb-4 [&>p]:leading-relaxed">{!! $question->part_c_ans !!}</div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
