@extends('user.base')

@section('morecss')
@endsection

@section('content')
    <div class="g-hero">
        <div class="hero-text">
            <img src="{{ asset('images/local/portfolio.png') }}" />
        </div>
    </div>

    {{-- PORTFOLIO --}}
    <div role="main">
        <ul class="tiles-wrap animated" id="wookmark1">
            <!-- These are our grid blocks -->
            @foreach ($portfolios as $portfolio)
                <li>
                    <div class="g-portfolio-card">
                        <img src="{{ asset($portfolio->image) }}" />
                        <p class="title">
                            {{ app()->getLocale() === 'id' ? $portfolio->name_id : $portfolio->name_en }}
                        </p>
                        <p class="description">
                            {{ app()->getLocale() === 'id' ? $portfolio->description_id : $portfolio->description_en }}
                        </p>
                    </div>
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
@endsection
