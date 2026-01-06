<x-guest-layout>    
    <div class="max-w-6xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Part C answer</h1>

        <div
            class="bg-white border rounded-lg shadow-md p-5 flex flex-col justify-between hover:shadow-lg transition-shadow duration-200 ease-in-out">
            <div>
                <p class="text-xl font-bold text-sky-800 mb-1">{{ $question->id }} . {{ $question->part_c_qs }}</p>
                
                <div class="mt-4">
                    <x-answer-with-tooltips :answer="$question->translated_answer" />
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
