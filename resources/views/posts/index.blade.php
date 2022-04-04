<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ __('message.posts') }}</x-slot>
        <x-slot name="headerSubtitle"></x-slot>
        <x-slot name="headerAction">
            @can('post.create')
                <a href="{{ route('admin.posts.create') }}" class="button is-primary is-light">
                    <span class="icon"><i class="fa-solid fa-circle-plus"></i></span> {{ __('message.add') }}
                </a>
            @endcan
        </x-slot>
        <div class="box-no-shadow">
            <div class="list has-hoverable-list-items">
                @foreach ($posts as $key => $post)
                    <a href="{{ route('user.posts.show', $post->slug) }}">
                        <div class="list-item">
                            <div class="list-item-content">
                                <div class="list-item-title">
                                    {{ $post->title }}
                                </div>
                                <div class="list-item-description">
                                    {{ __('message.postInfo', ['name' => $post->author->name,'datetime' => $post->created_at->format('d/m/Y H:i')]) }}
                                    @if ($post->promoted)
                                        <span class="tag is-primary"><i class="fa-solid fa-star"></i></span>
                                    @endif
                                    @if ($post->color_name)
                                        <span class="tag {{ $post->color_name }}"
                                            style="text-align: center; line-height: 2em;">&#9632;</span>
                                    @endif
                                    @if ($post->active == 0)
                                        <span class="tag is-primary is-light">{{ __('message.postDraft') }}</span>
                                    @endif
                                </div>
                            </div>
                            @can('post.update')
                                <div class="list-item-controls">
                                    <div class="buttons is-right">
                                        <a href="{{ route('admin.posts.edit', $post->slug) }}" class="button is-primary">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                    </div>
                                </div>
                            @endcan
                        </div>
                    </a>
                @endforeach
            </div>

            {{ $posts->links('vendor.pagination.custom') }}
        </div>
    </x-content-page>


</x-app-layout>
