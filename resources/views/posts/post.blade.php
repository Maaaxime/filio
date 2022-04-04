<x-app-layout>
    <x-content-page>
        <x-slot name="header">
            {{ $post->title }}
            @if ($post->active == 0)
                <span class="tag is-primary is-light">{{ __('message.postDraft') }}</span>
            @endif
        </x-slot>
        <x-slot name="headerSubtitle">
            <p>
                {{ __('message.postInfo', ['name' => $post->author->name,'datetime' => $post->created_at->format('d/m/Y H:i')]) }}
            </p>
            <a href="{{ url()->previous() }}">
                <i class="fa-solid fa-circle-chevron-left"></i> {{ __('message.back') }}
            </a>
        </x-slot>
        <x-slot name="headerAction">
            @can('post.update')
                <a href="{{ route('admin.posts.edit', $post->slug) }}" class="button is-primary is-light">
                    <span class="icon"><i class="fa-solid fa-pen-to-square"></i></span> {{ __('message.edit') }}
                </a>
            @endcan
        </x-slot>
        <div class="box-no-shadow">
            {!! $post->body !!}
        </div>
    </x-content-page>
</x-app-layout>
