<x-filament-panels::page>
    <div class="space-y-6">
        <script src="https://cdn.tailwindcss.com"></script>
        <div class="flex justify-end">
            <button onclick="openUploadModal()" class="bg-blue-600 hover:bg-blue-700 text-white font-bold p-2 px-4 rounded-lg flex items-center transition-colors">
                + Add Media
            </button>
        </div>

        <div class="columns-2 sm:columns-3 md:columns-4 lg:columns-5 xl:columns-6 gap-3">

        @forelse($this->getImages() as $image)
            <button
               onclick="openImageModal('{{ $image }}')"
               class="mb-3 block break-inside-avoid group relative overflow-hidden rounded-lg shadow-md hover:shadow-lg transition-shadow w-full">

                <!-- Auto aspect ratio image -->
                <img
                    src="{{ $image }}"
                    alt="Media image"
                    loading="lazy"
                    class="w-full h-auto shadow-lg border border-gray-500 rounded-lg transition-transform duration-300 group-hover:scale-105">

                <!-- Hover overlay -->
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors flex items-center justify-center">
                    <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity"
                         fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/>
                    </svg>
                </div>

            </button>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500 text-lg">No images found in media folder</p>
            </div>
        @endforelse

        </div>

        <!-- Image Modal -->
        <div id="imageModal" class="hidden fixed inset-0 bg-black/75 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-lg shadow-2xl max-w-2xl w-full  flex flex-col h-[800px]">
                <!-- Modal Header -->
                <div class="flex justify-between items-center p-4 border-b">
                    <h3 class="text-lg font-semibold">Image Preview</h3>
                    <button onclick="closeImageModal()" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="flex-1 overflow-auto flex items-center justify-center p-4">
                    <img id="modalImage" src="" alt="Full size image" class="max-w-full shadow-xl border border-red-500" style="height: -webkit-fill-available;">
                </div>

                <!-- Modal Footer -->
                <div class="flex gap-2 p-4 border-t justify-end">
                    <button onclick="copyImagePath()" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-colors flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                        Copy Path
                    </button>
                    <button onclick="deleteImage()" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition-colors flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3H4v2h16V7h-3z"/>
                        </svg>
                        Delete
                    </button>
                    <button onclick="closeImageModal()" class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                        Close
                    </button>
                </div>
            </div>
        </div>

        <!-- Upload Modal -->
        <div id="uploadModal" class="hidden fixed inset-0 bg-black/75 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-lg shadow-2xl max-w-md w-full">
                <!-- Modal Header -->
                <div class="flex justify-between items-center p-4 border-b">
                    <h3 class="text-lg font-semibold">Upload Media</h3>
                    <button onclick="closeUploadModal()" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="p-6 space-y-4">
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                        <input type="file" id="fileInput" multiple accept="image/*" onchange="handleFileSelect(event)" class="hidden" />
                        <button onclick="document.getElementById('fileInput').click()" class="text-blue-600 hover:text-blue-700 font-semibold">
                            Click to select images or drag and drop
                        </button>
                        <p class="text-gray-500 text-sm mt-2">Supported formats: JPG, PNG, GIF, WebP, SVG</p>
                    </div>

                    <div id="selectedFiles"></div>

                    <div id="uploadProgress" class="hidden">
                        <div class="space-y-2">
                            <p class="text-center text-gray-600 text-sm font-semibold">Uploading...</p>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div id="progressBar" class="bg-blue-600 h-2.5 rounded-full" style="width: 0%;"></div>
                            </div>
                            <p id="progressText" class="text-center text-gray-600 text-sm">0%</p>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="flex gap-2 p-4 border-t justify-end">
                    <button onclick="closeUploadModal()" class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                        Cancel
                    </button>
                    <button id="uploadButton" onclick="uploadMedia()" disabled class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                        Upload
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>

@include('filament.pages.media-scripts')
