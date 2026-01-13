<x-layouts.admin title="Edit Event">
    <div class="min-h-screen bg-white">
        <div class="border-b border-gray-200">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <h1 class="text-2xl font-semibold text-gray-900">Edit Event</h1>
                <p class="text-sm text-gray-500 mt-1">Perbarui informasi event yang sudah ada</p>
            </div>
        </div>
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <form id="eventForm" method="post" action="{{ route('admin.events.update', $event->id) }}" enctype="multipart/form-data" class="bg-white rounded-lg shadow-sm border border-gray-200">
                @csrf
                @method('PUT')
                <div class="px-6 sm:px-8 py-6 space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Judul Event <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="title"
                            placeholder="Contoh: Konser Musik Rock 2026"
                            class="w-full px-3.5 py-2 border border-gray-300 rounded-md text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                            value="{{ $event->title }}"
                            required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Deskripsi <span class="text-red-500">*</span>
                        </label>
                        <textarea
                            name="description"
                            placeholder="Deskripsi lengkap tentang event..."
                            class="w-full px-3.5 py-2 border border-gray-300 rounded-md text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition resize-none"
                            rows="4"
                            required>{{ $event->description }}</textarea>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Tanggal & Waktu <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="datetime-local"
                                name="date_time"
                                class="w-full px-3.5 py-2 border border-gray-300 rounded-md text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                                value="{{ $event->date_time->format('Y-m-d\TH:i') }}"
                                required />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Lokasi <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                name="location"
                                placeholder="Contoh: Stadion GBK"
                                class="w-full px-3.5 py-2 border border-gray-300 rounded-md text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                                value="{{ $event->location }}"
                                required />
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <select name="category_id" class="w-full px-3.5 py-2 border border-gray-300 rounded-md text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $event->category_id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Gambar Event
                        </label>
                        <input type="file" name="image" id="imageInput" accept="image/*" class="hidden" />
                        <label for="imageInput" class="flex items-center justify-center w-full px-4 py-8 border-2 border-dashed border-gray-300 rounded-md cursor-pointer hover:border-gray-400 transition bg-gray-50">
                            <div class="text-center">
                                <svg class="mx-auto h-10 w-10 text-gray-400 mb-2" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-8l-3.172-3.172a4 4 0 00-5.656 0L28 20M9 20l3.172-3.172a4 4 0 015.656 0L28 20m19 13a2 2 0 11-4 0 2 2 0 014 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <p class="text-sm text-gray-700 font-medium">Drag & drop atau klik untuk upload</p>
                                <p class="text-xs text-gray-500 mt-1">JPG, PNG, max 5MB</p>
                            </div>
                        </label>
                    </div>
                    <div id="imagePreview" class="{{ $event->image ? '' : 'hidden' }}">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Preview Gambar</label>
                        <div class="relative inline-block w-full max-w-xs">
                            <img id="previewImg" src="{{ $event->image ? asset('images/events/' . $event->image) : '' }}" alt="Preview" class="w-full rounded-md border border-gray-200">
                            <button type="button" id="removeImage" class="absolute top-2 right-2 bg-red-500 text-white rounded p-1 hover:bg-red-600 transition">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="px-6 sm:px-8 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.events.index') }}" class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-100 font-medium text-sm transition">
                        Batal
                    </a>
                    <button type="reset" class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-100 font-medium text-sm transition">
                        Reset
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium text-sm transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const imageInput = document.getElementById('imageInput');
        const imagePreview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        const removeBtn = document.getElementById('removeImage');

        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });

        removeBtn?.addEventListener('click', function(e) {
            e.preventDefault();
            imageInput.value = '';
            imagePreview.classList.add('hidden');
            previewImg.src = '';
        });

        const dropZone = document.querySelector('label[for="imageInput"]');
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, unhighlight, false);
        });

        function highlight(e) {
            dropZone.classList.add('border-gray-400', 'bg-gray-100');
        }

        function unhighlight(e) {
            dropZone.classList.remove('border-gray-400', 'bg-gray-100');
        }

        dropZone.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            imageInput.files = files;
            const event = new Event('change', { bubbles: true });
            imageInput.dispatchEvent(event);
        }
    </script>
</x-layouts.admin>
