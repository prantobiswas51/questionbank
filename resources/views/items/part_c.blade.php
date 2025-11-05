<x-guest-layout>
    <div class="max-w-6xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Part C Questions</h1>

        <div class="search_box py-2 mb-4 ">
            <form action="{{ route('part_c') }}" method="get">
                <input type="text" name="search" class="rounded-lg border sm:min-w-[300px] border-gray-300"
                    placeholder="Search Part C Questions" value="{{ request('search') }}">

                <button type="submit" class="border p-2 rounded-lg">Search</button>
                <a href="{{ route('part_c') }}"><button type="button" class="border p-2 rounded-lg">Clear</button></a>
            </form>
        </div>

        @if ($partc->isEmpty())
        <p class="text-gray-600">No Part C questions found.</p>
        @else
        <div class="grid  grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($partc as $question)
            <a href="{{ route('partc.show', $question->id) }}">
                <div
                    class="bg-white border rounded-lg shadow-md p-5 flex flex-col justify-between hover:shadow-lg transition-shadow duration-200 ease-in-out">
                    <div>
                        <div class="flex justify-between">
                            <p class="text-xl font-bold text-gray-900 mb-1">{{ $question->id }} . {{
                                $question->part_c_qs }}</p>

                        </div>
                        <p class="text-sm text-green-700 bg-green-100/50 p-2 rounded-[50px]"> Story : {{
                            $question->story->story_name }} </p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        @endif
    </div>
</x-guest-layout>