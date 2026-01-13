<x-layouts.admin title="Manajemen Event">
    <div class="min-h-screen bg-white">
        @if (session('success'))
            <div class="fixed bottom-4 right-4 z-50 max-w-sm">
                <div class="bg-white border border-gray-200 rounded-lg shadow-lg p-4 flex items-start gap-3">
                    <svg class="h-5 w-5 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <div>
                        <p class="text-sm font-medium text-gray-900">Berhasil</p>
                        <p class="text-sm text-gray-600 mt-1">{{ session('success') }}</p>
                    </div>
                </div>
            </div>

            <script>
                setTimeout(() => {
                    document.querySelector('[role="status"]')?.closest('.fixed')?.remove();
                }, 5000);
            </script>
        @endif
        <div class="border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900">Manajemen Event</h1>
                    <p class="text-sm text-gray-500 mt-1">Kelola semua event yang tersedia di platform</p>
                </div>
                <a href="{{ route('admin.events.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium text-sm transition">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Event
                </a>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200">
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">No</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Event</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kategori</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Lokasi</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($events as $index => $event)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-medium">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            @if($event->image)
                                                <button onclick="openImageModal('{{ asset('images/events/' . $event->image) }}', '{{ $event->title }}')" class="flex-shrink-0 hover:opacity-75 transition cursor-pointer">
                                                    <img src="{{ asset('images/events/' . $event->image) }}" alt="{{ $event->title }}" class="h-10 w-10 rounded object-cover">
                                                </button>
                                            @else
                                                <div class="h-10 w-10 rounded bg-gray-200 flex items-center justify-center flex-shrink-0">
                                                    <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            @endif
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate">{{ $event->title }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $event->category->name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $event->date_time->format('d M Y') }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ Str::limit($event->location, 30) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                                        <a href="{{ route('admin.events.show', $event->id) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-blue-600 border border-blue-200 rounded hover:bg-blue-50 transition font-medium text-xs">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Detail
                                        </a>
                                        <a href="{{ route('admin.events.edit', $event->id) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-amber-600 border border-amber-200 rounded hover:bg-amber-50 transition font-medium text-xs">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </a>
                                        <button onclick="openDeleteModal(this)" data-id="{{ $event->id }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-red-600 border border-red-200 rounded hover:bg-red-50 transition font-medium text-xs">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="h-12 w-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                            </svg>
                                            <p class="text-gray-500 font-medium mb-1">Tidak ada event</p>
                                            <p class="text-gray-400 text-sm">Mulai dengan membuat event baru</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <dialog id="delete_modal" class="modal">
        <form method="POST" class="modal-box rounded-lg shadow-lg border border-gray-200 max-w-sm">
            @csrf
            @method('DELETE')
            <input type="hidden" name="event_id" id="delete_event_id">

            <h3 class="text-lg font-semibold text-gray-900 mb-2">Hapus Event</h3>
            <p class="text-gray-600 text-sm mb-4">Apakah Anda yakin ingin menghapus event ini? Tindakan ini tidak dapat dibatalkan dan semua data yang terkait akan dihapus.</p>

            <div class="flex gap-3 justify-end mt-6">
                <button type="button" onclick="delete_modal.close()" class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-100 font-medium text-sm transition">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 font-medium text-sm transition">
                    Hapus Event
                </button>
            </div>
        </form>
        <form method="dialog" class="modal-backdrop">
            <button type="button" onclick="delete_modal.close()">close</button>
        </form>
    </dialog>

    <script>
        function openDeleteModal(button) {
            const id = button.dataset.id;
            const form = document.querySelector('#delete_modal form[method="POST"]');
            document.getElementById("delete_event_id").value = id;
            form.action = `/admin/events/${id}`;
            delete_modal.showModal();
        }

        function openImageModal(imageSrc, imageTitle) {
            document.getElementById('modal_image_src').src = imageSrc;
            document.getElementById('modal_image_title').textContent = imageTitle;
            document.getElementById('image_modal').showModal();
        }
    </script>

    <dialog id="image_modal" class="modal">
        <div class="modal-box rounded-lg shadow-lg border border-gray-200 max-w-2xl p-0 overflow-hidden">
            <div class="bg-gray-50 border-b border-gray-200 px-6 py-4">
                <h3 id="modal_image_title" class="text-lg font-semibold text-gray-900"></h3>
            </div>
            <div class="bg-white p-6 flex items-center justify-center max-h-96">
                <img id="modal_image_src" src="" alt="" class="max-w-full max-h-80 object-contain rounded-lg">
            </div>
            <div class="bg-gray-50 border-t border-gray-200 px-6 py-4 flex justify-end">
                <button type="button" onclick="document.getElementById('image_modal').close()" class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-100 font-medium text-sm transition">
                    Tutup
                </button>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button type="button" onclick="image_modal.close()">close</button>
        </form>
    </dialog>
</x-layouts.admin>