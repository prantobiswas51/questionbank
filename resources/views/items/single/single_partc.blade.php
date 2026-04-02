<x-guest-layout>

    {{-- Add Word Modal --}}
    <div class="fixed inset-0 bg-gray-600 bg-opacity-75 items-center justify-center p-4 z-50 hidden" id="addWordModal">
        <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-sm relative">
            <h3 class="text-xl font-semibold mb-4 text-gray-800">Add New Word</h3>
            <form id="addWordForm" action="{{ route('save_word') }}" method="POST" class="space-y-4">
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
                    <button type="submit" id="addWordSubmitBtn"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-200 ease-in-out">
                        Add Word
                    </button>
                </div>
            </form>
            <p id="addWordFeedback" class="mt-3 text-sm hidden"></p>
            <button type="button" id="closeModalButton" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600"
                aria-label="Close modal">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>
    </div>

    <div class="max-w-8xl flex flex-col md:flex-row mx-auto p-4">

        {{-- question annswer side --}}
        <div class="left min-w-[60%] md:max-w-[65%] ">
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


        {{-- AI message side --}}
        <div class="p-2 right w-full mt-10 h-auto">
            <div class="bg-white border rounded-lg shadow-md p-4 min-h-[85vh] h-auto flex flex-col">
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-lg font-semibold text-slate-800 mb-3">Ask AI</h2>
                    <button id="openAddWordModal" type="button"
                        class="px-3 py-1 text-sm bg-indigo-600 text-white rounded-md hover:bg-indigo-700">+Add
                        word</button>
                </div>

                <div id="chatMessages" class="flex-1 overflow-y-auto border rounded-md p-3 bg-slate-50 space-y-3">
                    <div class="text-sm text-slate-600">
                        Ask anything about this Part C question. The chat area is scrollable.
                    </div>
                </div>

                <form id="chatForm" class="mt-3 flex flex-col gap-2">
                    <textarea id="chatInput" placeholder="Type your message..."
                        class="w-full border max-h-[250px] border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 transition-all resize-none"
                        rows="3" required></textarea>

                    <div class="flex justify-end gap-2">
                        <select name="model" id="modelSelect" class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors border-gray-100">
                            {{-- show puterjs model lists --}}
                            <option value="gpt-5-nano">GPT-5 Nano</option>
                            <option value="gpt-4">GPT-4</option>
                        </select>
                        <!-- Clear Button: type="button" prevents form submission -->
                        <button id="clearBtn" type="button"
                            class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                            Clear
                        </button>
                        <!-- Send Button -->
                        <button id="sendBtn" type="submit"
                            class="px-6 py-2 text-sm font-medium bg-sky-600 text-white rounded-lg hover:bg-sky-700 shadow-sm transition-all active:scale-95 disabled:opacity-60">
                            Send
                        </button>
                    </div>
                </form>
            </div>
        </div>


    </div>


    <script src="https://js.puter.com/v2/"></script>

    <script>
        const addWordModal = document.getElementById('addWordModal');
        const addWordForm = document.getElementById('addWordForm');
        const openAddWordModalButton = document.getElementById('openAddWordModal');
        const cancelAddWordButton = document.getElementById('cancelAddWord');
        const closeModalButton = document.getElementById('closeModalButton');
        const addWordSubmitBtn = document.getElementById('addWordSubmitBtn');
        const addWordFeedback = document.getElementById('addWordFeedback');
        const addWordCsrfToken = addWordForm.querySelector('input[name="_token"]')?.value;

        function setAddWordFeedback(message, type = 'info') {
            const typeClass = {
                success: 'text-green-600',
                error: 'text-red-600',
                info: 'text-blue-600',
            };

            addWordFeedback.className = `mt-3 text-sm ${typeClass[type] || typeClass.info}`;
            addWordFeedback.classList.remove('hidden');
            addWordFeedback.textContent = message;
        }

        function resetAddWordSubmitState() {
            addWordSubmitBtn.disabled = false;
            addWordSubmitBtn.textContent = 'Add Word';
        }

        function openAddWordModal() {
            addWordModal.classList.remove('hidden');
            addWordModal.classList.add('flex');
            addWordFeedback.classList.add('hidden');
            addWordFeedback.textContent = '';
            resetAddWordSubmitState();
        }

        function closeAddWordModal() {
            addWordModal.classList.remove('flex');
            addWordModal.classList.add('hidden');
        }

        // Add Word modal handlers
        openAddWordModalButton.addEventListener('click', openAddWordModal);
        cancelAddWordButton.addEventListener('click', closeAddWordModal);
        closeModalButton.addEventListener('click', closeAddWordModal);

        addWordModal.addEventListener('click', (e) => {
            if (e.target === addWordModal) {
                closeAddWordModal();
            }
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !addWordModal.classList.contains('hidden')) {
                closeAddWordModal();
            }
        });

        // Submit to route('save_word') as JSON and keep user on the same page.
        addWordForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            addWordSubmitBtn.disabled = true;
            addWordSubmitBtn.textContent = 'Saving...';
            setAddWordFeedback('Saving word...', 'info');

            const formData = new FormData(addWordForm);

            try {
                const response = await fetch(addWordForm.action, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': addWordCsrfToken || '',
                    },
                    body: formData,
                });

                const data = await response.json();

                if (!response.ok || !data.success) {
                    const validationError = data?.errors ? Object.values(data.errors).flat()[0] : null;
                    const errorMessage = validationError || data?.message || 'Failed to save word.';
                    setAddWordFeedback(errorMessage, 'error');
                    resetAddWordSubmitState();
                    return;
                }

                setAddWordFeedback(data.message || 'Word added successfully!', 'success');

                setTimeout(() => {
                    addWordForm.reset();
                    closeAddWordModal();
                    resetAddWordSubmitState();
                }, 1000);
            } catch (error) {
                console.error('Save word failed:', error);
                setAddWordFeedback('Something went wrong while saving.', 'error');
                resetAddWordSubmitState();
            }
        });

        const form = document.getElementById('chatForm');
        const input = document.getElementById('chatInput');
        const messages = document.getElementById('chatMessages');
        const clearBtn = document.getElementById('clearBtn');
        const modelSelect = document.getElementById('modelSelect');

        let chatHistory = [];

        /* =========================
        LOAD + FILTER MODELS
        ========================= */
        async function loadModels() {
            try {
                const models = await puter.ai.listModels();

                console.log('ALL MODELS:', models); // inspect once

                modelSelect.innerHTML = '';

                // 🔥 FILTER LOGIC (robust, not naive)
                const chatModels = models.filter(model => {
                    // handle different possible structures
                    return (
                        model?.type === 'chat' ||
                        model?.capabilities?.includes?.('chat') ||
                        model?.id?.toLowerCase().includes('gpt') // fallback heuristic
                    );
                });

                // ❗ fallback if filter fails
                const finalModels = chatModels.length ? chatModels : models;

                finalModels.forEach(model => {
                    const option = document.createElement('option');

                    const value = model.id || model.name || model;
                    option.value = value;
                    option.textContent = value;

                    modelSelect.appendChild(option);
                });

            } catch (err) {
                console.error('Model load failed:', err);
            }
        }

        loadModels();


        /* =========================
        CHAT
        ========================= */
        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            const message = input.value.trim();
            if (!message) return;

            const selectedModel = modelSelect.value;

            appendMessage('You', message);
            input.value = '';

            chatHistory.push({ role: "user", content: message });

            try {
                const loadingEl = appendMessage('AI', 'Typing...');

                const response = await puter.ai.chat(chatHistory, {
                    model: selectedModel
                });

                const rawReply = response?.message?.content || '';
                const reply = cleanReply(rawReply) || 'No response';

                loadingEl.querySelector('span').textContent = reply;

                chatHistory.push({ role: "assistant", content: reply });

            } catch (err) {
                appendMessage('AI', 'Model failed, try another');
                console.error(err);
            }
        });


        /* =========================
        CLEAR
        ========================= */
        clearBtn.addEventListener('click', () => {
            messages.innerHTML = '';
            chatHistory = [];
        });


        /* =========================
        UI
        ========================= */
        function appendMessage(sender, text) {
            const div = document.createElement('div');
            div.className = "text-sm";

            div.innerHTML = `
                <strong>${sender}:</strong>
                <span class="text-slate-700">${text}</span>
            `;

            messages.appendChild(div);
            messages.scrollTop = messages.scrollHeight;

            return div;
        }


        // ============================
        // post processing for AI responses (optional)
        // ============================
        function cleanReply(text) {
            if (!text) return '';

            return text
                // remove markdown bullets / symbols
                .replace(/[\*\-\•]+/g, ' ')

                // remove numbered lists (1. 2. etc)
                .replace(/\d+\.\s+/g, ' ')

                // remove headings (#, ##, etc)
                .replace(/#+\s*/g, '')

                // remove extra line breaks
                .replace(/\n{3,}/g, '\n\n')

                // collapse multiple spaces
                .replace(/\s{2,}/g, ' ')

                // trim spaces
                .trim();
        }

        // Buttons to use Enter key for sending and Shift+Enter for new line
        input.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                form.dispatchEvent(new Event('submit'));
            }
        });
    </script>
</x-guest-layout>