@extends('user.base')


@section('content')
    <div class="g-hero">
        <div class="hero-text">
            <img src="{{ asset('images/local/youseeartikel' . (app()->getLocale() === 'en' ? '_engver' : '') . '.png') }}"
                class="img-titikseluruhindonesia" />
        </div>
        <div class="article-headline">
            @php
                $locale = app()->getLocale();
            @endphp
            <div class="article-content">
                <div class="article-wrapper">
                    <p class="title">
                        {{ $newArtikel != null ? ($locale == 'id' ? $newArtikel->title_id : $newArtikel->title_en) : 'Belum ada artikel' }}
                    </p>
                    <p class="time">
                        {{ $newArtikel != null ? date_format($newArtikel->created_at, 'd M Y H:i') : 'Tidak ada tanggal' }}
                    </p>
                    <hr>
                    <div class="isi">
                        {!! $newArtikel != null
                            ? ($locale == 'id'
                                ? $newArtikel->content_id
                                : $newArtikel->content_en)
                            : 'Belum ada isi artikel' !!}
                    </div>
                </div>
                <div class="btn-wrapper">
                    @if ($newArtikel != null)
                        <a
                            href="{{ route('article.detail', ['locale' => app()->getLocale(), 'slug' => $newArtikel->slug]) }}">
                            {{ $locale == 'id' ? 'Baca Selengkapnya' : 'Read More' }}
                        </a>
                    @endif
                </div>
            </div>
            <img src="{{ asset($newArtikel->image ?? 'images/local/noimage.jpg') }}"
                onerror="this.onerror=null;this.src='{{ asset('images/local/noimage.jpg') }}';" />
        </div>


        <p class="title-content ">{{ trans('messages.semua_artikel_yang_kami_sajikan') }}</p>

        <div class="search-wrapper">
            <div class="search-field d-flex align-items-center border rounded-full px-2 py-1">
                <span class="material-symbols-outlined text-grey">
                    search
                </span>
                <input type="text" class="form-control border-0 shadow-none"
                    placeholder={{ $locale == 'id' ? 'Pencarian Artikel' : 'Search' }} />
            </div>
        </div>

        <div class="list-article">

            @foreach ($data as $key => $d)
                <a class="card-article"
                    href="{{ route('article.detail', ['locale' => app()->getLocale(), 'slug' => $d->slug]) }}">
                    <img src="{{ asset($d->image) }}"
                        onerror="this.onerror=null;this.src='{{ asset('images/local/noimage.jpg') }}';" />
                    <div class="article-content">
                        <div class="article-wrapper">
                            <p class="title">{{ $locale == 'id' ? $d->title_id : $d->title_en }}</p>
                            <p class="time">{{ date_format($d->created_at, 'd M Y H:m') }}</p>
                            <hr>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <div id="pagination">
            {{ $data->links() }}
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
