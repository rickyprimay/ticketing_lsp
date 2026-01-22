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
                <a href="{{ route('home') }}">
                    <x-user.category-pill :label="'All'" :active="!request('category')" />
                </a>
                @foreach($categories as $category)
                <a href="{{ route('home', ['category' => $category->id]) }}">
                    <x-user.category-pill :label="$category->name" :active="request('category') == $category->id" />
                </a>
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
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
                <p class="text-xl text-gray-500">No events available at the moment.</p>
            </div>
            @endforelse
        </div>
    </section>
</x-layouts.app>