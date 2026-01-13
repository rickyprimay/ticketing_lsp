<x-layouts.admin title="Detail Event">
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
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex items-center justify-between">
                    <div>
                        <a href="{{ route('admin.events.index') }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-medium text-sm mb-3">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            Kembali ke Daftar
                        </a>
                        <h1 class="text-2xl font-semibold text-gray-900">Detail Event</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden sticky top-6">
                        @if($event->image)
                            <button onclick="openImageModal('{{ asset('images/events/' . $event->image) }}', '{{ $event->title }}')" class="w-full h-48 overflow-hidden bg-gray-100 hover:opacity-90 transition cursor-pointer block">
                                <img src="{{ asset('images/events/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover" />
                            </button>
                        @else
                            <div class="h-48 bg-gray-100 flex items-center justify-center">
                                <svg class="h-16 w-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif

                        <div class="p-6 space-y-4">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900 mb-2">{{ $event->title }}</h2>
                                <div class="flex items-center gap-2 flex-wrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $event->category->name ?? 'Uncategorized' }}
                                    </span>
                                    <span class="text-xs text-gray-400">•</span>
                                    <span class="text-xs text-gray-600">{{ $event->date_time->format('d M Y, H:i') }}</span>
                                </div>
                            </div>

                            <div class="border-t border-gray-200 pt-4 space-y-3">
                                <div>
                                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Lokasi</p>
                                    <p class="text-sm text-gray-900 font-medium">{{ $event->location }}</p>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Deskripsi</p>
                                    <p class="text-sm text-gray-600 line-clamp-4">{{ $event->description }}</p>
                                </div>
                            </div>

                            <div class="border-t border-gray-200 pt-4 flex gap-2">
                                <a href="{{ route('admin.events.edit', $event->id) }}" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium text-sm transition text-center">
                                    Edit
                                </a>
                                <button onclick="openDeleteModal()" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 font-medium text-sm transition">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Daftar Tiket</h3>
                                <p class="text-sm text-gray-500 mt-1">Kelola tiket yang tersedia untuk event ini</p>
                            </div>
                            <button id="btnAddTicket" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium text-sm transition">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Tambah Tiket
                            </button>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="bg-gray-50 border-b border-gray-200">
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">No</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tipe</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Harga</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Stok</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @forelse ($tickets as $index => $ticket)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-600">{{ $index + 1 }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 capitalize">
                                                    {{ $ticket->type ?? $ticket->tipe }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                                Rp {{ number_format($ticket->price ?? $ticket->harga, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                                <div class="flex items-center gap-2">
                                                    <div class="w-2 h-2 rounded-full {{ ($ticket->stock ?? $ticket->stok) > 0 ? 'bg-green-500' : 'bg-red-500' }}"></div>
                                                    {{ $ticket->stock ?? $ticket->stok }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                                                <button class="inline-flex items-center gap-1.5 px-3 py-1.5 text-blue-600 border border-blue-200 rounded hover:bg-blue-50 transition font-medium text-xs" 
                                                    onclick="openEditModal(this)"
                                                    data-id="{{ $ticket->id }}"
                                                    data-type="{{ $ticket->type ?? $ticket->tipe }}"
                                                    data-price="{{ $ticket->price ?? $ticket->harga }}"
                                                    data-stock="{{ $ticket->stock ?? $ticket->stok }}">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                    Edit
                                                </button>

                                                <button class="inline-flex items-center gap-1.5 px-3 py-1.5 text-red-600 border border-red-200 rounded hover:bg-red-50 transition font-medium text-xs"
                                                    onclick="openDeleteTicketModal(this)"
                                                    data-id="{{ $ticket->id }}">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-12 text-center">
                                                <div class="flex flex-col items-center justify-center">
                                                    <svg class="h-12 w-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1m2-1v2.5M2 21h20M7 8h10m0 0l1-1m-1 1l-1-1m1 1v2.5" />
                                                    </svg>
                                                    <p class="text-gray-500 font-medium">Belum ada tiket</p>
                                                    <p class="text-gray-400 text-sm mt-1">Mulai dengan menambah tiket baru</p>
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
        </div>
    </div>

    <dialog id="add_ticket_modal" class="modal">
        <form method="POST" action="{{ route('admin.tickets.store') }}" class="modal-box rounded-lg shadow-lg border border-gray-200 max-w-md">
            @csrf
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Tambah Tiket Baru</h3>
            <input type="hidden" name="event_id" value="{{ $event->id }}">

            <div class="space-y-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Tipe Tiket <span class="text-red-500">*</span>
                    </label>
                    <select name="type" class="w-full px-3.5 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none" required>
                        <option value="" disabled selected>Pilih Tipe Tiket</option>
                        <option value="reguler">Regular</option>
                        <option value="premium">Premium</option>
                        <option value="vip">VIP</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Harga <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="price" placeholder="50000" class="w-full px-3.5 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none" required />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Stok <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="stock" placeholder="100" class="w-full px-3.5 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none" required />
                </div>
            </div>

            <div class="flex gap-3 justify-end">
                <button type="button" onclick="document.getElementById('add_ticket_modal').close()" class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50 font-medium text-sm transition">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium text-sm transition">
                    Tambah Tiket
                </button>
            </div>
        </form>
        <form method="dialog" class="modal-backdrop">
            <button type="button" onclick="add_ticket_modal.close()">close</button>
        </form>
    </dialog>

    <dialog id="edit_ticket_modal" class="modal">
        <form method="POST" class="modal-box rounded-lg shadow-lg border border-gray-200 max-w-md" id="editTicketForm">
            @csrf
            @method('PUT')
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Edit Tiket</h3>
            <input type="hidden" name="ticket_id" id="edit_ticket_id">

            <div class="space-y-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Tipe Tiket <span class="text-red-500">*</span>
                    </label>
                    <select name="type" id="edit_type" class="w-full px-3.5 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none" required>
                        <option value="reguler">Regular</option>
                        <option value="premium">Premium</option>
                        <option value="vip">VIP</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Harga <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="price" id="edit_price" class="w-full px-3.5 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none" required />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Stok <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="stock" id="edit_stock" class="w-full px-3.5 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none" required />
                </div>
            </div>

            <div class="flex gap-3 justify-end">
                <button type="button" onclick="document.getElementById('edit_ticket_modal').close()" class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50 font-medium text-sm transition">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium text-sm transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
        <form method="dialog" class="modal-backdrop">
            <button type="button" onclick="edit_ticket_modal.close()">close</button>
        </form>
    </dialog>

    <dialog id="delete_ticket_modal" class="modal">
        <form method="POST" class="modal-box rounded-lg shadow-lg border border-gray-200 max-w-sm" id="deleteTicketForm">
            @csrf
            @method('DELETE')
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Hapus Tiket</h3>
            <p class="text-gray-600 text-sm mb-4">Apakah Anda yakin ingin menghapus tiket ini? Tindakan ini tidak dapat dibatalkan.</p>
            <input type="hidden" name="ticket_id" id="delete_ticket_id">

            <div class="flex gap-3 justify-end">
                <button type="button" onclick="document.getElementById('delete_ticket_modal').close()" class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50 font-medium text-sm transition">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 font-medium text-sm transition">
                    Hapus Tiket
                </button>
            </div>
        </form>
        <form method="dialog" class="modal-backdrop">
            <button type="button" onclick="delete_ticket_modal.close()">close</button>
        </form>
    </dialog>

    <dialog id="delete_event_modal" class="modal">
        <form method="POST" class="modal-box rounded-lg shadow-lg border border-gray-200 max-w-sm" id="deleteEventForm">
            @csrf
            @method('DELETE')
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Hapus Event</h3>
            <p class="text-gray-600 text-sm mb-4">Apakah Anda yakin ingin menghapus event ini? Semua tiket yang terkait juga akan dihapus. Tindakan ini tidak dapat dibatalkan.</p>

            <div class="flex gap-3 justify-end">
                <button type="button" onclick="document.getElementById('delete_event_modal').close()" class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50 font-medium text-sm transition">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 font-medium text-sm transition">
                    Hapus Event
                </button>
            </div>
        </form>
        <form method="dialog" class="modal-backdrop">
            <button type="button" onclick="delete_event_modal.close()">close</button>
        </form>
    </dialog>

    <script>
        document.getElementById('btnAddTicket')?.addEventListener('click', function () {
            document.getElementById('add_ticket_modal').showModal();
        });

        function openEditModal(button) {
            const id = button.dataset.id;
            const type = button.dataset.type;
            const price = button.dataset.price;
            const stock = button.dataset.stock;

            document.getElementById('edit_ticket_id').value = id;
            document.getElementById('edit_type').value = type;
            document.getElementById('edit_price').value = price;
            document.getElementById('edit_stock').value = stock;

            const form = document.getElementById('editTicketForm');
            form.action = `/admin/tickets/${id}`;
            document.getElementById('edit_ticket_modal').showModal();
        }

        function openDeleteTicketModal(button) {
            const id = button.dataset.id;
            document.getElementById('delete_ticket_id').value = id;
            const form = document.getElementById('deleteTicketForm');
            form.action = `/admin/tickets/${id}`;
            document.getElementById('delete_ticket_modal').showModal();
        }

        function openDeleteModal() {
            const form = document.getElementById('deleteEventForm');
            form.action = `/admin/events/{{ $event->id }}`;
            document.getElementById('delete_event_modal').showModal();
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
