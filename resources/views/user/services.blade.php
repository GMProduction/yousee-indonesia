@extends('user.base')

@section('content')
    <div class="g-hero">
        <div class="hero-text">
            <img src="{{ asset('images/local/youseeservices.png') }}" />
        </div>
    </div>


    <div class="g-services ">

        <div class="g-menu " role="tablist">
            @foreach ($services as $service)
                @php $idService = preg_replace('/\s+/', '', $service->name) @endphp
                <a class="menu @if ($loop->first) active @endif" data-bs-toggle="pill"
                    href="#{{ $idService }}">
                    {{ $service->name }}
                </a>
            @endforeach
        </div>


        <div class="tab-content">
            @foreach ($services as $service)
                @php $idService = preg_replace('/\s+/', '', $service->name) @endphp
                <div id="{{ $idService }}" class="tab-pane @if ($loop->first) active @endif">
                    <div class="g-content ">
                        <img src="{{ asset($service->image) }}">
                        <div class="text">
                            <p class="title">
                                {{ $service->name }}
                            </p>
                            <hr>
                            <p class="definition">
                                {!! $service->description !!}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <div class="space-between-menus"></div>
    {{-- PORTFOLIO --}}
    <div class="g-portfolio">
        <p class="title mb-0">Portfolio Kami</p>
    </div>
    <div role="main">
        <ul class="tiles-wrap animated" id="wookmark1">
            <!-- These are our grid blocks -->
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
                outerOffset: 10, // Optional, the distance to the containers border
                itemWidth: itemWidth, // Optional, the width of a grid item
            });
        };

        // Opsional: Mendengarkan perubahan ukuran jendela untuk mengatur ulang lebar item
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

            // Tambahkan lebih banyak elemen sesuai kebutuhan
        });
    </script>
@endsection
