@props(['title', 'date', 'location', 'price', 'image', 'href' => null])

@php
    $formattedPrice = $price ? 'Rp ' . number_format($price, 0, ',', '.') : 'Harga tidak tersedia';

    $formattedDate = $date
        ? \Carbon\Carbon::parse($date)->locale('id')->translatedFormat('d F Y, H:i')
        : 'Tanggal tidak tersedia';

    $imageUrl = $image
        ? (filter_var($image, FILTER_VALIDATE_URL)
            ? $image
            : asset('images/events/' . $image))
        : asset('images/default-event.jpeg');

@endphp

<a href="{{ $href ?? '#' }}" class="block">
    <div class="card bg-base-100 h-96 shadow-sm hover:shadow-md transition-shadow duration-300">
        <div class="card-body p-0 rounded-lg overflow-hidden">
            <div class="h-48 bg-gray-100">
                @if($image)
                    <img 
                        src="{{ $imageUrl }}" 
                        alt="{{ $title }}" 
                        class="w-full h-full object-cover"
                    >
                @else
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-200 to-blue-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                @endif
            </div>

            <div class="p-4">
                <h2 class="card-title text-lg line-clamp-2">
                    {{ $title }}
                </h2>

                <p class="text-sm text-gray-500 mt-2">
                    🕐 {{ $formattedDate }}
                </p>

                <p class="text-sm mt-2">
                    📍 {{ $location }}
                </p>

                <p class="font-bold text-lg mt-3 text-blue-900">
                    {{ $formattedPrice }}
                </p>
            </div>
        </div>
    </div>
</a>

