@extends('user.base')

@section('content')
    <div class="g-hero">
        <div class="hero-text">
            <img src="{{ asset('images/local/youseeservices.png') }}" />
        </div>
    </div>

    @php $locale = app()->getLocale(); @endphp

    <div class="g-services ">
        <div class="g-menu " role="tablist">
            @foreach ($services as $service)
                @php
                    $name = $locale === 'en' ? $service->name_en : $service->name_id;
                    $idService = preg_replace('/\s+/', '', $name);
                @endphp
                <a class="menu @if ($loop->first) active @endif" data-bs-toggle="pill"
                    href="#{{ $idService }}">
                    {{ $name }}
                </a>
            @endforeach
        </div>

        <div class="tab-content">
            @foreach ($services as $service)
                @php
                    $name = $locale === 'en' ? $service->name_en : $service->name_id;
                    $description = $locale === 'en' ? $service->description_en : $service->description_id;
                    $idService = preg_replace('/\s+/', '', $name);
                @endphp
                <div id="{{ $idService }}" class="tab-pane @if ($loop->first) active @endif">
                    <div class="g-content ">
                        <img src="{{ asset($service->image) }}">
                        <div class="text">
                            <p class="title">{{ $name }}</p>
                            <hr>
                            <p class="definition">{!! $description !!}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="space-between-menus"></div>
    <div class="g-portfolio">
        <p class="title mb-0">{{ trans('messages.portfolio_kami') }}</p>
    </div>
    <div role="main">
        <ul class="tiles-wrap animated" id="wookmark1">
            @foreach ($portfolios as $portfolio)
                <li>
                    <img src="{{ asset($portfolio->image) }}" />
                </li>
            @endforeach
        </ul>
    </div>
@endsection

@section('morejs')
    <script type="text/javascript">
        window.onload = function() {
            var itemWidth = window.innerWidth < 820 ? 110 : 210;
            var wookmark1 = new Wookmark("#wookmark1", {
                outerOffset: 10,
                itemWidth: itemWidth,
            });
        };

        window.addEventListener('resize', function() {
            var newWidth = window.innerWidth < 820 ? 110 : 210;
            if (newWidth !== itemWidth) {
                itemWidth = newWidth;
                wookmark1.updateOptions({
                    itemWidth: itemWidth
                });
            }
        });
    </script>

    <script>
        var slideUp = {
            distance: '50%',
            origin: 'bottom',
            delay: 300,
        };
        document.addEventListener('DOMContentLoaded', function() {
            ScrollReveal().reveal('.g-hero', slideUp);
            ScrollReveal().reveal('.g-services', slideUp);
            ScrollReveal().reveal('.g-portfolio', slideUp);
        });
    </script>
@endsection
