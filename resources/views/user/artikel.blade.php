@extends('user.base')

@section('morecss')
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
@endsection
@section('content')
    <div class="g-hero">
        <div class="hero-text">
            <img src="{{ asset('images/local/youseeartikel.png') }}" />
        </div>
        <div class="article-headline">
            <div class="article-content">
                <div class="article-wrapper">
                    <p class="title">Judul Artikel</p>
                    <p class="time">12 Feb 2024 16:13</p>
                    <hr>
                    <p class="isi">Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem autem
                        reiciendis
                        sunt repudiandae
                        eum
                        inventore nesciunt, dignissimos, enim vitae eveniet rerum obcaecati commodi recusandae voluptas
                        minima!
                        Eos
                        blanditiis repellat ducimus?


                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem autem
                        reiciendis
                        sunt repudiandae
                        eum
                        inventore nesciunt, dignissimos, enim vitae eveniet rerum obcaecati commodi recusandae voluptas
                        minima!
                        Eos
                        blanditiis repellat ducimus?

                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem autem
                        reiciendis
                        sunt repudiandae
                        eum
                        inventore nesciunt, dignissimos, enim vitae eveniet rerum obcaecati commodi recusandae voluptas
                        minima!
                        Eos
                        blanditiis repellat ducimus?

                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem autem
                        reiciendis
                        sunt repudiandae
                        eum
                        inventore nesciunt, dignissimos, enim vitae eveniet rerum obcaecati commodi recusandae voluptas
                        minima!
                        Eos
                        blanditiis repellat ducimus?
                    </p>
                </div>
                <div class="btn-wrapper">
                    <a href="/detailartikel/slug-artikel">Baca Selengkapnya</a>
                </div>
            </div>
            <img src="{{ asset('images/local/login.jpg') }}" />
        </div>


        <p class="title-content ">Semua Artikel yang Kami Sajikan</p>

        <div class="search-wrapper">
            <div class="search-field">
                <span class="material-symbols-outlined text-grey">
                    search
                </span>
                <input type="text" placeholder="Pencarian Artikel" />

            </div>
        </div>

        <div class="list-article">

            @for ($i = 0; $i < 20; $i++)
                <div class="card-article">
                    <img src="{{ asset('images/local/login.jpg') }}" />

                    <div class="article-content">
                        <div class="article-wrapper">
                            <p class="title">Judul Artikel, Judul Artikel, Judul Artikel, </p>
                            <p class="time">12 Feb 2024 16:13</p>
                            <hr>

                            <div class="btn-wrapper">
                                <a href="/detailartikel/slug-artikel"><span>Baca Selengkapnya</span><span
                                        class="material-symbols-outlined">
                                        arrow_right_alt
                                    </span></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    @endsection
