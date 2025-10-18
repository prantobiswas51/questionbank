<x-guest-layout>

    {{-- Add Word Modal --}}
    <div class="fixed inset-0 bg-gray-600 bg-opacity-75 flex  items-center justify-center p-4 z-50 hidden"
        id="addWordModal">
        <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-sm relative">
            <h3 class="text-xl font-semibold mb-4 text-gray-800">Add New Word</h3>
            <form action="{{ route('save_word') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="main_word" class="block text-sm font-medium text-gray-700 mb-1">Main Word</label>
                    <input type="text" id="main_word" name="main_word" required
                        class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="e.g., Hello">
                </div>
                <div>
                    <label for="translate_word" class="block text-sm font-medium text-gray-700 mb-1">Translated
                        Word</label>
                    <input type="text" id="translate_word" name="translate_word" required
                        class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="e.g., ওহে">
                </div>
                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Notes (Optional)</label>
                    <textarea id="notes" name="notes" rows="3"
                        class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Any additional context or examples..."></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" id="cancelAddWord"
                        class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition duration-200 ease-in-out">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-200 ease-in-out">
                        Add Word
                    </button>
                </div>
            </form>
            <button type="button" id="closeModalButton" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600"
                aria-label="Close modal">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>
    </div>

    <h3 class="text-lg font-semibold p-2">Explore ... </h3>

    <div class=" p-2 grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
        <a href="{{ route('subjects') }}" class="p-2 px-4 text-center hover:cursor-pointer rounded-lg bg-sky-600 text-white">Subjects ({{ $subjects }})</a>
        <a href="{{ route('papers') }}" class="p-2 px-4 text-center hover:cursor-pointer rounded-lg bg-sky-600 text-white">Papers ({{ $papers }})</a>
        <a href="{{ route('stories') }}" class="p-2 px-4 text-center hover:cursor-pointer rounded-lg bg-sky-600 text-white">Stories ({{ $stories }})</a>
        <a href="{{ route('part_a') }}" class="p-2 px-4 text-center hover:cursor-pointer rounded-lg bg-sky-600 text-white">Part A ({{ $parta }})</a>
        <a href="{{ route('part_b') }}" class="p-2 px-4 text-center hover:cursor-pointer rounded-lg bg-sky-600 text-white">Part B ({{ $partb }})</a>
        <a href="{{ route('part_c') }}" class="p-2 px-4 text-center hover:cursor-pointer rounded-lg bg-sky-600 text-white">Part C ({{ $partc }})</a>
        <a href="{{ route('part_c') }}" class="p-2 px-4 text-center hover:cursor-pointer rounded-lg bg-sky-600 text-white">Summaries</a>
    </div>


    {{-- Search and Add --}}
    <div
        class="flex  p-2 flex-col sm:flex-row items-stretch sm:items-center justify-between py-4 px-4 mx-auto max-w-6xl gap-3">

        <form action="" method="get" class="flex items-center space-x-2 w-full sm:w-auto flex-grow">
            <input type="search" id="search-words" name="q" placeholder="Search words..." value="{{ request('q') }}"
                class="px-4 py-2 border border-gray-300 shadow-sm w-full rounded-full focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200 ease-in-out"
                aria-label="Search for words">
            <button type="submit"
                class="p-2 bg-gray-100 shadow-sm text-gray-700 rounded-full hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition duration-200 ease-in-out"
                aria-label="Search">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </button>
        </form>

        <button type="button" id="openAddWordModal"
            class="flex-shrink-0 px-5 py-2 bg-indigo-600 text-white rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-200 ease-in-out text-center">
            + Add New
        </button>
    </div>

    {{-- Show the words --}}
    <div class="px-4 mx-auto max-w-6xl bg-amber-400/50 p-2">
        {{-- Check if there are words to display --}}
        @if ($words->isEmpty())
        <div class="bg-white rounded-lg shadow p-6 text-center text-gray-600">
            <p class="text-lg font-semibold mb-2">No words found.</p>
            <p>Start by adding a new word or adjust your search query.</p>
        </div>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            {{-- Loop through your words from the database --}}
            @foreach ($words as $word)
            <div
                class="bg-white rounded-lg shadow-md p-5 flex flex-col justify-between hover:shadow-lg transition-shadow duration-200 ease-in-out">
                <div>
                    <div class="flex justify-between">
                        <p class="text-xl font-bold text-gray-900 mb-1">{{ $word->english_word }}</p>
                        <p class="text-lg text-gray-700 ">{{ $word->meaning }}</p>
                    </div>
                    @if ($word->notes)
                    <p class="text-sm text-gray-500 mt-2">{{ $word->notes }}</p>
                    @endif
                </div>
                <div class="mt-4 flex justify-end space-x-2">
                    <button class="text-blue-500 hover:text-blue-700 text-sm font-medium"
                        aria-label="Edit word {{ $word->main_word }}">Edit</button>
                    <button class="text-red-500 hover:text-red-700 text-sm font-medium"
                        aria-label="Delete word {{ $word->main_word }}">Delete</button>
                </div>
            </div>
            @endforeach
        </div>
        {{-- Pagination links if you have them --}}
        {{-- <div class="mt-6">
            {{ $words->links() }}
        </div> --}}
        @endif
    </div>


    <script>
        const addWordModal = document.getElementById('addWordModal');
            const openAddWordModalButton = document.getElementById('openAddWordModal');
            const cancelAddWordButton = document.getElementById('cancelAddWord');
            const closeModalButton = document.getElementById('closeModalButton'); // New close button

            openAddWordModalButton.addEventListener('click', () => {
                addWordModal.classList.remove('hidden');
            });

            cancelAddWordButton.addEventListener('click', () => {
                addWordModal.classList.add('hidden');
            });

            closeModalButton.addEventListener('click', () => { // Event listener for the new close button
                addWordModal.classList.add('hidden');
            });

            // Close modal when clicking outside of it
            addWordModal.addEventListener('click', (e) => {
                if (e.target === addWordModal) {
                    addWordModal.classList.add('hidden');
                }
            });

            // Optional: Close modal with Escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && !addWordModal.classList.contains('hidden')) {
                    addWordModal.classList.add('hidden');
                }
            });
    </script>
</x-guest-layout>