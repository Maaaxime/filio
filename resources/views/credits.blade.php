<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ __('message.credits') }}</x-slot>
        <x-slot name="headerSubtitle">Thank's</x-slot>
        <div class="tile">
            <div class="tile is-parent">
                <article class="tile is-child notification content">
                    <p class="title">laravel</p>
                    <p class="subtitle">View <a href="https://laravel.com/" target="_blank">Website</a></p>
                    <div class="content">
                        Laravel is a web application framework with expressive, elegant syntax. We’ve already laid
                        the foundation — freeing you to create without sweating the small things.
                    </div>
                </article>
            </div>
            <div class="tile is-parent">
                <article class="tile is-child notification content">
                    <p class="title">bulma</p>
                    <p class="subtitle">View <a href="https://bulma.io/" target="_blank">Website</a></p>
                    <div class="content">
                        The modern CSS framework that just works. Bulma is a free, open source framework that
                        provides ready-to-use frontend components that you can easily combine to build responsive
                        web interfaces.
                    </div>
                </article>
            </div>
            <div class="tile is-parent">
                <article class="tile is-child notification content">
                    <p class="title">css.gg</p>
                    <p class="subtitle">View <a href="https://css.gg/" target="_blank">Website</a></p>
                    <div class="content">
                        Open-source CSS, SVG and Figma UI Icons. Available in SVG Sprite, styled-components, NPM &
                        API.
                    </div>
                </article>
            </div>
            <div class="tile is-parent">
                <article class="tile is-child notification content">
                    <p class="title">sweetalert2</p>
                    <p class="subtitle">View <a href="https://sweetalert2.github.io/" target="_blank">Website</a>
                    </p>
                    <div class="content">
                        A beautiful, responsive, customizable, accessible (wai-aria) replacement for javascript's
                        popup boxes with zero dependencies.
                    </div>
                </article>
            </div>
            <div class="tile is-parent">
                <article class="tile is-child notification content">
                    <p class="title">font awesome</p>
                    <p class="subtitle">View <a href="https://fontawesome.com/" target="_blank">Website</a></p>
                    <div class="content">
                        Font Awesome is the Internet's icon library and toolkit, used by millions of designers,
                        developers, and content creators.
                    </div>
                </article>
            </div>
        </div>
    </x-content-page>
</x-app-layout>
