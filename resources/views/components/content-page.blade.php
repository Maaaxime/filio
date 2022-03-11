<div class="columns">
    <div class="column is-narrow navigation">
        @include('layouts.navigation')
    </div>
    <div class="column">
        @include('layouts.navbar')

        <div class="page-content">
            @if ($header->isNotEmpty())
                <section class="hero is-primary">
                    <div class="hero-body">
                        <p class="title">{{ $header }}</p>
                        @if ($headerSubtitle->isNotEmpty())
                            <p class="subtitle">{{ $headerSubtitle }}</p>
                        @endif
                    </div>
                </section>
            @endif
            <div class="">
                <div class="">
                    {{ $slot }}
                </div>
            </div>
            <div>
                @include('layouts.footer')
            </div>
        </div>
    </div>
</div>
