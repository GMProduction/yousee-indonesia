@extends('user.base')

@section('header')
    <meta name="description" content="{{ $article ? $article->title : '' }}">
    <meta name="keyword" content="baliho, billboard, videtron">
    <meta name="og:image" content="">
    <meta name="og:site_name" content="">
    <meta name="og:description" content="{{ $article ? $article->title : '' }}">
    <meta name="og:title" content="{{ $article ? $article->title : '' }}">
@endsection

@section('content')
    @php
        $locale = app()->getLocale();
    @endphp

    <div class="g-hero">
        <div class="hero-text">
            <img src="{{ asset('images/local/youseeartikel.png') }}" />
        </div>
    </div>
    <div class="article-full">
        <div class="article-content">
            <div class="article-wrapper">
                <img src="{{ $article->image }}" />

                <h3 class="title">{{ $locale == 'id' ? $article->title_id : $article->title_en }}</h3>
                <p class="time">{{ date_format($article->created_at, 'd M Y H:m') }}</p>
                <hr>
                <p class="isi">{!! $locale == 'id' ? $article->content_id : $article->content_en !!}
                </p>

                <p class="text-start mt-5 fw-bold">Tags: </p>
                <div class="tag-wrapper">
                    @foreach ($article->text_tag as $d)
                        <a class="tag-artikel"
                            href="{{ route('article.tag', ['locale' => app()->getLocale(), 'tag' => $d]) }}">{{ $d }}</a>
                    @endforeach
                </div>
            </div>

        </div>
    </div>


    <p class="title-content ">{{ trans('messages.baca_artikel_lain') }}</p>


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
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $data->links() }}
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
            ScrollReveal().reveal('.g-hero', slideUp);
            ScrollReveal().reveal('.article-full', slideUp);
        });
    </script>
@endsection
