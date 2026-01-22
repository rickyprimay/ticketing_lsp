<x-layouts.app>
    <div class="hero bg-blue-900 min-h-screen">
        <div class="hero-content text-center text-white">
            <div class="max-w-4xl">
                <h1 class="text-5xl font-bold">Hi, Amankan Tiketmu yuk.</h1>
                <p class="py-6">
                    BengTix: Beli tiket, auto asik.
                </p>
            </div>
        </div>
    </div>

    <section class="max-w-7xl mx-auto py-12 px-6">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-black uppercase italic">Events</h2>
            <div class="flex gap-2 flex-wrap">
                <button 
                    type="button"
                    data-category-id="" 
                    class="category-filter btn btn-sm rounded-full px-6 normal-case font-medium transition-all {{ !request('category') ? '!bg-blue-800 !text-white hover:!bg-blue-800' : 'bg-white border-blue-900 text-blue-900 hover:bg-blue-900 hover:text-white' }}"
                >
                    All
                </button>
                @foreach($categories as $category)
                <button 
                    type="button"
                    data-category-id="{{ $category->id }}"
                    class="category-filter btn btn-sm rounded-full px-6 normal-case font-medium transition-all {{ request('category') == $category->id ? '!bg-blue-800 !text-white hover:!bg-blue-800' : 'bg-white border-blue-900 text-blue-900 hover:bg-blue-900 hover:text-white' }}"
                >
                    {{ $category->name }}
                </button>
                @endforeach
            </div>
        </div>

        <div id="events-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($events as $event)
            <x-user.event-card 
                :title="$event->title" 
                :date="$event->date_time" 
                :location="$event->location"
                :price="$event->tickets_min_price" 
                :image="$event->image" 
                :href="route('events.show', $event)" 
            />
            @empty
            <div class="col-span-full text-center py-12">
                <p class="text-xl text-gray-500">Tidak ada event yang tersedia saat ini.</p>
            </div>
            @endforelse
        </div>
    </section>

    <script>
        document.querySelectorAll('.category-filter').forEach(btn => {
            btn.addEventListener('click', async (e) => {
                const categoryId = e.target.dataset.categoryId;
                
                document.querySelectorAll('.category-filter').forEach(b => {
                    b.classList.remove('!bg-blue-800', '!text-white', 'hover:!bg-blue-800');
                    b.classList.add('bg-white', 'border-blue-900', 'text-blue-900', 'hover:bg-blue-900', 'hover:text-white');
                });
                
                e.target.classList.remove('bg-white', 'border-blue-900', 'text-blue-900', 'hover:bg-blue-900', 'hover:text-white');
                e.target.classList.add('!bg-blue-800', '!text-white', 'hover:!bg-blue-800');
                
                const container = document.getElementById('events-container');
                container.style.opacity = '0.5';
                container.style.pointerEvents = 'none';
                
                try {
                    const url = categoryId 
                        ? `{{ route('home') }}?category=${categoryId}` 
                        : `{{ route('home') }}`;
                    
                    const response = await fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                        }
                    });
                    
                    const html = await response.text();
                    
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newContainer = doc.getElementById('events-container');
                    
                    if (newContainer) {
                        container.innerHTML = newContainer.innerHTML;
                    }
                    
                    if (categoryId) {
                        window.history.pushState({}, '', `?category=${categoryId}`);
                    } else {
                        window.history.pushState({}, '', `{{ route('home') }}`);
                    }
                } catch (error) {
                    console.error('Error fetching events:', error);
                    alert('Gagal memuat events');
                } finally {
                    container.style.opacity = '1';
                    container.style.pointerEvents = 'auto';
                }
            });
        });
    </script>
</x-layouts.app>