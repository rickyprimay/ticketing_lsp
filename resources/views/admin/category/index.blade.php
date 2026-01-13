<x-layouts.admin title="Manajemen Kategori">
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
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900">Manajemen Kategori</h1>
                    <p class="text-sm text-gray-500 mt-1">Kelola semua kategori event yang tersedia</p>
                </div>
                <button onclick="add_modal.showModal()" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium text-sm transition">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Kategori
                </button>
            </div>
        </div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200">
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">No</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama Kategori</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($categories as $index => $category)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-medium">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">{{ $category->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                                        <button onclick="openEditModal(this)" data-id="{{ $category->id }}" data-name="{{ $category->name }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-blue-600 border border-blue-200 rounded hover:bg-blue-50 transition font-medium text-xs">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </button>
                                        <button onclick="openDeleteModal(this)" data-id="{{ $category->id }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-red-600 border border-red-200 rounded hover:bg-red-50 transition font-medium text-xs">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="h-12 w-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                            </svg>
                                            <p class="text-gray-500 font-medium mb-1">Tidak ada kategori</p>
                                            <p class="text-gray-400 text-sm">Mulai dengan membuat kategori baru</p>
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

    <dialog id="add_modal" class="modal">
        <form method="POST" action="{{ route('admin.categories.store') }}" class="modal-box rounded-lg shadow-lg border border-gray-200 max-w-md">
            @csrf
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Tambah Kategori</h3>
            
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Kategori <span class="text-red-500">*</span>
                </label>
                <input type="text" placeholder="Masukkan nama kategori" class="w-full px-3.5 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none" name="name" required />
            </div>

            <div class="flex gap-3 justify-end">
                <button type="button" onclick="add_modal.close()" class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50 font-medium text-sm transition">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium text-sm transition">
                    Simpan
                </button>
            </div>
        </form>
        <form method="dialog" class="modal-backdrop">
            <button type="button" onclick="add_modal.close()">close</button>
        </form>
    </dialog>

    <dialog id="edit_modal" class="modal">
        <form method="POST" class="modal-box rounded-lg shadow-lg border border-gray-200 max-w-md">
            @csrf
            @method('PUT')
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Edit Kategori</h3>
            
            <input type="hidden" name="category_id" id="edit_category_id">

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Kategori <span class="text-red-500">*</span>
                </label>
                <input type="text" placeholder="Masukkan nama kategori" class="w-full px-3.5 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none" id="edit_category_name" name="name" required />
            </div>

            <div class="flex gap-3 justify-end">
                <button type="button" onclick="edit_modal.close()" class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50 font-medium text-sm transition">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium text-sm transition">
                    Simpan
                </button>
            </div>
        </form>
        <form method="dialog" class="modal-backdrop">
            <button type="button" onclick="edit_modal.close()">close</button>
        </form>
    </dialog>

    <dialog id="delete_modal" class="modal">
        <form method="POST" class="modal-box rounded-lg shadow-lg border border-gray-200 max-w-sm">
            @csrf
            @method('DELETE')

            <input type="hidden" name="category_id" id="delete_category_id">

            <h3 class="text-lg font-semibold text-gray-900 mb-2">Hapus Kategori</h3>
            <p class="text-gray-600 text-sm mb-4">Apakah Anda yakin ingin menghapus kategori ini? Tindakan ini tidak dapat dibatalkan.</p>
            
            <div class="flex gap-3 justify-end">
                <button type="button" onclick="delete_modal.close()" class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50 font-medium text-sm transition">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 font-medium text-sm transition">
                    Hapus
                </button>
            </div>
        </form>
        <form method="dialog" class="modal-backdrop">
            <button type="button" onclick="delete_modal.close()">close</button>
        </form>
    </dialog>

    <script>
        function openEditModal(button) {
            const name = button.dataset.name;
            const id = button.dataset.id;
            const form = document.querySelector('#edit_modal form');
            
            document.getElementById("edit_category_name").value = name;
            document.getElementById("edit_category_id").value = id;
            form.action = `/admin/categories/${id}`;

            edit_modal.showModal();
        }

        function openDeleteModal(button) {
            const id = button.dataset.id;
            const form = document.querySelector('#delete_modal form');
            document.getElementById("delete_category_id").value = id;
            form.action = `/admin/categories/${id}`;

            delete_modal.showModal();
        }
    </script>
</x-layouts.admin>