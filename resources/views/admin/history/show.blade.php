<x-layouts.admin title="Detail Pemesanan">
    <div class="min-h-screen bg-white">
        <div class="border-b border-gray-200">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-900">Detail Pemesanan</h1>
                        <p class="text-sm text-gray-500 mt-1">Order #{{ $order->id }} • {{ $order->order_date->format('d M Y H:i') }}</p>
                    </div>
                    <a href="{{ route('admin.histories.index') }}" class="inline-flex items-center gap-2 px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50 font-medium text-sm transition">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>
        </div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                        @if($order->event?->image)
                            <img src="{{ asset('images/events/' . $order->event->image) }}" alt="{{ $order->event?->title ?? 'Event' }}" class="w-full h-48 object-cover" />
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                        <div class="p-4">
                            <h2 class="font-semibold text-lg text-gray-900">{{ $order->event?->title ?? 'Event' }}</h2>
                            <p class="text-sm text-gray-500 mt-1">{{ $order->event?->location ?? '-' }}</p>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Detail Pemesanan</h3>
                        <div class="space-y-4 mb-6">
                            @foreach($order->detailOrders as $d)
                                <div class="flex items-start justify-between pb-4 border-b border-gray-200 last:border-b-0">
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $d->tickets->type }}</p>
                                        <p class="text-sm text-gray-500 mt-1">Jumlah: <span class="font-medium text-gray-700">{{ $d->amount }} tiket</span></p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-semibold text-gray-900">Rp {{ number_format($d->price_amount, 0, ',', '.') }}</p>
                                        <p class="text-xs text-gray-500 mt-1">Rp {{ number_format($d->price_amount / $d->amount, 0, ',', '.') }} x {{ $d->amount }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="border-t-2 border-gray-200 pt-6">
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-semibold text-gray-900">Total Pembayaran</span>
                                <span class="text-2xl font-bold text-blue-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <p class="text-sm text-gray-600 mb-2">Status Pemesanan</p>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <span class="w-2 h-2 bg-green-600 rounded-full mr-2"></span>
                                Selesai
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
