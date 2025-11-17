<x-guest-layout>
    <div class="max-w-6xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Part C Questions</h1>

        <div class="search_box py-2 mb-4">
            <form action="{{ route('part_c') }}" method="get"
                class="flex flex-nowrap gap-2 items-center overflow-x-auto">

                <input type="text" name="search" class="rounded-lg border min-w-[220px] border-gray-300"
                    placeholder="Search Part C Questions" value="{{ request('search') }}">

                <select class="rounded-md border-gray-300 min-w-[150px]" name="paper_id" id="paper_id">
                    <option value="">Select Paper</option>
                    @foreach($papers as $paper)
                    <option value="{{ $paper->id }}" {{ request('paper_id')==$paper->id ? 'selected' : '' }}>
                        {{ $paper->paper_name }}
                    </option>
                    @endforeach
                </select>

                <select class="rounded-md border-gray-300 min-w-[150px]" name="story_id" id="story_id">
                    <option value="">Select Story</option>
                    @foreach($stories as $story)
                    <option value="{{ $story->id }}" {{ request('story_id')==$story->id ? 'selected' : '' }}>
                        {{ $story->story_name }}
                    </option>
                    @endforeach
                </select>

                <button type="submit" class="border px-4 py-2 rounded-lg bg-blue-500 text-white min-w-[90px]">
                    Search
                </button>

                <a href="{{ route('part_c') }}"
                    class="border px-4 py-2 rounded-lg bg-red-500 text-white min-w-[70px] text-center">
                    Clear
                </a>
            </form>
        </div>


        @if ($partc->isEmpty())
        <p class="text-gray-600">No Part C questions found.</p>
        @else
        <div class="columns-1 sm:columns-2 md:columns-3 lg:columns-4 gap-4">
            @foreach ($partc as $question)
            <a href="{{ route('partc.show', $question->id) }}"
                class="break-inside-avoid mb-4 bg-white border rounded-lg shadow-md p-5 flex flex-col justify-between hover:shadow-lg transition-shadow duration-200 ease-in-out">

                <div>
                    <div class="flex justify-between">
                        <p class="font-bold text-gray-900 mb-1">
                            {{ $question->id }} . {{ $question->part_c_qs }}
                        </p>
                    </div>

                    <p class="text-sm text-green-700 bg-green-100/50 p-2 rounded-[50px]">
                        Story : {{ $question->story->story_name }}
                    </p>
                </div>
            </a>
            @endforeach
        </div>

        @endif
    </div>
</x-guest-layout>