@props(['media', 'galleryKey', 'max' => 4])
@php
    $media = collect($media)->values();
    $count = $media->count();
    $visible = $media->take($max);
    $hidden = $media->slice($max);
    $remaining = $count - $visible->count();
    $countClass = match (true) {
        $count <= 1 => 'count-1',
        $count === 2 => 'count-2',
        $count === 3 => 'count-3',
        default => 'count-4',
    };
@endphp
@if($count)
    <div class="media-grid {{ $countClass }} mb-3">
        @foreach($visible as $item)
            <a href="{{ $item['url'] }}"
               class="media-item glightbox"
               data-gallery="{{ $galleryKey }}"
               data-type="{{ $item['type'] === 'video' ? 'video' : 'image' }}">
                @if($item['type'] === 'video')
                    <video muted playsinline preload="metadata"><source src="{{ $item['url'] }}"></video>
                    <span class="media-play-icon"><i class="bi bi-play-circle-fill"></i></span>
                @else
                    <img src="{{ $item['url'] }}" alt="" loading="lazy">
                @endif
                @if($loop->last && $remaining > 0)
                    <span class="media-more-overlay">+{{ $remaining }}</span>
                @endif
            </a>
        @endforeach
        {{-- medias au-dela du visuel affiche, gardes dans la meme galerie pour naviguer 1 par 1 --}}
        @foreach($hidden as $item)
            <a href="{{ $item['url'] }}" class="glightbox d-none" data-gallery="{{ $galleryKey }}" data-type="{{ $item['type'] === 'video' ? 'video' : 'image' }}"></a>
        @endforeach
    </div>
@endif
