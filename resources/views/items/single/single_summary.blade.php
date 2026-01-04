<x-guest-layout>    
    <div class="max-w-6xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">{{ $summary->story->story_name }} Summary</h1>
        <div
            class="bg-white border rounded-lg shadow-md p-5 flex flex-col justify-between hover:shadow-lg transition-shadow duration-200 ease-in-out">
            <div>
                <div class="text-gray-800 prose prose-sm max-w-none [&>p]:mb-4 [&>p]:leading-relaxed">{!! $summary->summary_content !!}</div>
            </div>
        </div>
    </div>
</x-guest-layout>
