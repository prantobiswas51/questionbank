<x-guest-layout>
    <div class="max-w-6xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Part B Questions</h1>

        <div class="search_box py-2 mb-4 ">
            <form action="{{ route('part_b') }}" method="get" class="flex flex-wrap gap-2 items-center">
                <input type="text" name="search" class="rounded-lg border sm:min-w-[300px] border-gray-300"
                    placeholder="Search Part B Questions" value="{{ request('search') }}">

                <select class="rounded-md border-gray-300" name="paper_id" id="paper_id">
                    <option value="">Select Paper</option>
                    @foreach($papers as $paper)
                    <option value="{{ $paper->id }}" {{ request('paper_id')==$paper->id ? 'selected' : '' }}>
                        {{ $paper->paper_name }}
                    </option>
                    @endforeach
                </select>

                <select class="rounded-md border-gray-300" name="story_id" id="story_id">
                    <option value="">Select Story</option>
                    @foreach($stories as $story)
                    <option value="{{ $story->id }}" {{ request('story_id')==$story->id ? 'selected' : '' }}>
                        {{ $story->story_name }}
                    </option>
                    @endforeach
                </select>

                <button type="submit" class="border p-2 rounded-lg bg-blue-500 text-white">Search</button>
                <a href="{{ route('part_b') }}" class="border p-2 rounded-lg bg-red-500 text-white">Clear</a>
            </form>

        </div>

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
                    <p class="text-sm text-green-700 bg-green-100/50 p-2 rounded-[50px]"> Story : {{
                        $question->story->story_name }} </p>
                </div>
            </a>
            @endforeach
        </div>
        @endif
    </div>
</x-guest-layout>