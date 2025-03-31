@extends('user.base')


@section('content')
    <div class="g-hero">
        <div class="hero-text">
            <img src="{{ asset('images/local/youseeartikel.png') }}" />
        </div>
        <div class="article-headline">
            <div class="article-content">
                <div class="article-wrapper">
                    <p class="title">{{ $newArtikel->title ?? 'Belum ada artikel' }}</p>
                    <p class="time">
                        {{ $newArtikel != null ? date_format($newArtikel->created_at, 'd M Y H:m') : 'Tidak ada tanggal' }}
                    </p>
                    <hr>
                    <div class="isi">{!! $newArtikel->content ?? 'Belum ada isi artikel' !!}
                    </div>
                </div>
                <div class="btn-wrapper">
                    @if ($newArtikel != null)
                        <a
                            href="{{ route('article.detail', ['locale' => app()->getLocale(), 'slug' => $newArtikel->slug]) }}">Baca
                            Selengkapnya</a>
                    @endif
                </div>
            </div>
            <img src="{{ asset($newArtikel->image) }}"
                onerror="this.onerror=null;this.src='{{ asset('images/local/noimage.jpg') }}';" />

        </div>

        <p class="title-content ">Semua Artikel dengan Tag ({{ request('tag') }})</p>

        {{--        <div class="search-wrapper"> --}}
        {{--            <div class="search-field"> --}}
        {{--                <span class="material-symbols-outlined text-grey"> --}}
        {{--                    search --}}
        {{--                </span> --}}
        {{--                <input type="text" placeholder="Pencarian Artikel" /> --}}

        {{--            </div> --}}
        {{--        </div> --}}

        <div class="list-article">
            @foreach ($article as $d)
                <a class="card-article" href="{{ route('article.detail', ['slug' => $d->slug]) }}">
                    <img src="{{ asset($d->image) }}"
                        onerror="this.onerror=null;this.src='{{ asset('images/local/noimage.jpg') }}';" />
                    <div class="article-content">
                        <div class="article-wrapper">
                            <p class="title">{{ $d->title }}</p>
                            <p class="time">{{ date_format($d->created_at, 'd M Y H:m') }}</p>
                            <hr>


                        </div>
                    </div>
                </a>
            @endforeach

        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $article->links() }}
        </div>
    </div>
@endsection

@section('morejs')
    <script>
        var slideUp = {
            distance: '50%',
            origin: 'bottom',
            delay: 300,
        };
        document.addEventListener('DOMContentLoaded', function() {
            ScrollReveal().reveal('.list-article', slideUp);
            ScrollReveal().reveal('.g-hero', slideUp);
            // Tambahkan lebih banyak elemen sesuai kebutuhan
        });
    </script>
@endsection
