<x-guest-layout>
    <div class="max-w-6xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Papers of {{ $paper->paper_name }}</h1>


        @foreach ($stories as $story)
        <div
            class="bg-white border my-2 rounded-lg shadow-md p-5 flex flex-col justify-between hover:shadow-lg transition-shadow duration-200 ease-in-out">
            <div class="flex flex-col sm:flex-row gap-2">
                <p class="text-md font-bold text-gray-900 mb-1">{{ $story->story_name }}</p>
                <div class="gap-2 flex">
                    <a href="{{ route('part_a', ['search' => '', 'paper_id' => $paper->id, 'story_id' => $story->id]) }}"
                        class="p-1 px-2 text-sm border border-gray-300 rounded-xl hover:bg-amber-200/50">View Part A
                    </a>
                    <a href="{{ route('part_b', ['search' => '', 'paper_id' => $paper->id, 'story_id' => $story->id]) }}"
                        class="p-1 px-2 text-sm border border-gray-300 rounded-xl hover:bg-amber-200/50">View Part B
                    </a>
                    <a href="{{ route('part_c', ['search' => '', 'paper_id' => $paper->id, 'story_id' => $story->id]) }}"
                        class="p-1 px-2 text-sm border border-gray-300 rounded-xl hover:bg-amber-200/50">View Part C
                    </a>
                </div>
            </div>
        </div>
        @endforeach


    </div>
</x-guest-layout>