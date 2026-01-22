<x-layouts.app>
  <section class="max-w-4xl mx-auto py-12 px-6">
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-bold">Detail Pemesanan</h1>
      <div class="text-sm text-gray-500">Order #{{ $order->id }} •
        {{ $order->order_date->translatedFormat('d F Y, H:i') }}
      </div>
    </div>

    <div class="card bg-base-100 shadow-md">
      <div class="lg:flex">
        <div class="lg:w-1/3 p-4">
          <img
            src="{{ $order->event?->image ? asset('images/events/' . $order->event->image) : 'https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp' }}"
            alt="{{ $order->event?->title ?? 'Event' }}" class="w-full object-cover mb-2 rounded" />
          <h2 class="font-semibold text-lg">{{ $order->event?->title ?? 'Event' }}</h2>
          <p class="text-sm text-gray-500 mt-1">📍 {{ $order->event?->location ?? '-' }}</p>
        </div>

        <div class="card-body lg:w-2/3">
          <h3 class="font-bold text-lg mb-4">Detail Tiket</h3>

          <div class="space-y-3">
            @foreach($order->detail_orders as $d)
              <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                <div>
                  <div class="font-bold">{{ $d->tickets?->type ?? 'Tiket' }}</div>
                  <div class="text-sm text-gray-500">Jumlah: {{ $d->quantity }}</div>
                </div>
                <div class="text-right">
                  <div class="text-sm text-gray-500">Rp {{ number_format($d->tickets?->price ?? 0, 0, ',', '.') }} x {{ $d->quantity }}</div>
                  <div class="font-bold">Rp {{ number_format($d->subtotal_price, 0, ',', '.') }}</div>
                </div>
              </div>
            @endforeach
          </div>

          <div class="divider"></div>

          <div class="flex justify-between items-center">
            <span class="font-bold text-lg">Total Pembayaran</span>
            <span class="font-bold text-2xl text-blue-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
          </div>
        </div>
      </div>
    </div>

    <div class="mt-6">
      <a href="{{ route('orders.index') }}" class="btn btn-primary text-white">Kembali ke Riwayat Pembelian</a>
    </div>
  </section>
</x-layouts.app>
