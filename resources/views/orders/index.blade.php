<x-layouts.app>
  <section class="max-w-6xl mx-auto py-12 px-6">
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-bold">Riwayat Pembelian</h1>
    </div>

    @if (session('success'))
      <div class="alert alert-success mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{ session('success') }}</span>
      </div>
    @endif

    <div class="space-y-4">
      @forelse($orders as $order)
        <article class="card lg:card-side bg-base-100 shadow-md overflow-hidden">
          <figure class="lg:w-48 bg-gray-100">
            <img
              src="{{ $order->event?->image ? asset('images/events/' . $order->event->image) : 'https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp' }}"
              alt="{{ $order->event?->title ?? 'Event' }}" class="w-full h-full object-cover" />
          </figure>

          <div class="card-body flex justify-between">
            <div>
              <div class="font-bold">Order #{{ $order->id }}</div>
              <div class="text-sm text-gray-500 mt-1">{{ $order->order_date->translatedFormat('d F Y, H:i') }}</div>
              <div class="text-sm mt-2">{{ $order->event?->title ?? 'Event' }}</div>
            </div>

            <div class="text-right">
              <div class="font-bold text-lg">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
              <a href="{{ route('orders.show', $order) }}" class="btn btn-primary mt-3 text-white">Lihat Detail</a>
            </div>
          </div>
        </article>
      @empty
        <div class="alert alert-info">Anda belum memiliki pesanan.</div>
      @endforelse
    </div>
  </section>
</x-layouts.app>
