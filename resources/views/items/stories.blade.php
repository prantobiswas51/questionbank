<x-guest-layout>    
    <div class="max-w-6xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Stories</h1>

        @if ($stories->isEmpty())
        <p class="text-gray-600">No Story found.</p>
        @else
        <div class="grid  grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($stories as $story)
            <div
                class="bg-white border rounded-lg shadow-md p-5 flex flex-col justify-between hover:shadow-lg transition-shadow duration-200 ease-in-out">
                <div>
                    <div class="flex flex-col items-start">
                        <p class="text-xl font-bold text-gray-900 mb-1">{{ $story->story_name }}</p>
                        <p class="text-sm text-gray-700 ">Paper : {{ $story->paper->paper_name }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</x-guest-layout>