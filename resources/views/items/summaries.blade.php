<x-guest-layout>
    <div class="max-w-6xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Summaries</h1>

        @if ($summaries->isEmpty())
        <p class="text-gray-600">No summaries found.</p>
        @else
        <div class="grid  grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($summaries as $summary)
            <a href="{{ route('summaries.show', $summary->id) }}">
                <div
                    class="bg-white border rounded-lg shadow-md p-5 flex flex-col justify-between hover:shadow-lg transition-shadow duration-200 ease-in-out">
                    <div>
                        <div class="flex justify-between">
                            <p class="text-xl font-bold text-gray-900 mb-1">{{ $summary->story->story_name }}</p>
                            <p class="text-lg text-gray-700 ">{{ $summary->story->year_id }}</p>
                        </div>
                        <p class="text-sm text-green-700 bg-green-100/50 p-2 rounded-[50px]"> Story : {{  $summary->story->author->name }} </p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        @endif
    </div>
</x-guest-layout>