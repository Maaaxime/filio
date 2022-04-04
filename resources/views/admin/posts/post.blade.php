<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ __('message.postsManagement') . ($post->title ? ' : ' . $post->title : '') }}
        </x-slot>

        <x-slot name="headerSubtitle">
            <a href="{{ url()->previous() }}">
                <i class="fa-solid fa-circle-chevron-left"></i> {{ __('message.back') }}
            </a>
        </x-slot>

        {!! Form::model($post, ['method' => $methodName, 'route' => [$actionRoute, $post->slug], 'class' => 'box-no-shadow']) !!}
        {{ Form::hidden('url', URL::previous()) }}
        {{ Form::hidden('post_id', $post->id) }}

        <div class="field">
            <label class="label">{{ __('message.title') }}</label>
            <div class="control">
                {!! Form::text('title', $post->title, ['placeholder' => __('message.title'), 'class' => 'input', 'disabled' => $readonly]) !!}
            </div>
        </div>
        <div class="field">
            <label class="label">{{ __('message.body') }}</label>
            <div class="control">
                {!! Form::textarea('body', $post->body, ['id' => 'body', 'rows' => 6, 'class' => 'textarea', 'disabled' => $readonly]) !!}
            </div>
        </div>
        <div class="field">
            <label class="label">{{ __('message.color') }}</label>
            <div class="control select">
                {!! Form::select('color', collect($post->colors)->pluck('name'), old($post->color), ['class' => '', 'disabled' => $readonly]) !!}
            </div>
        </div>
        <div class="field">
            <label class="checkbox">
                {{ Form::checkbox('promoted', null, $post->promoted, ['class' => 'checkbox icon', 'disabled' => $readonly]) }}
                {{ __('message.promoted') }}
            </label>
        </div>
        @if (!$readonly)
            @canany(['post.create', 'post.update', 'post.delete'])
                <div class="columns is-flex-direction-row-reverse pt-4">
                    @canany(['post.create', 'post.update'])
                        <div class="column">
                            <div class=" field is-pulled-right is-grouped">
                                <div class="control is-pulled-right">
                                    {!! Form::button('<span class="icon is-small"><i class="fa-solid fa-paperclip"></i></span><span>' . __('message.postSaveDraft') . '</span>', ['class' => 'button is-primary  is-light', 'type' => 'submit', 'name' => 'draft', 'disabled' => $readonly]) !!}
                                </div>
                                <div class="control is-pulled-right">
                                    {!! Form::button('<span class="icon is-small"><i class="fa-solid fa-paper-plane"></i></span><span>' . __('message.publish') . '</span>', ['class' => 'button is-primary', 'type' => 'submit', 'name' => 'publish', 'disabled' => $readonly]) !!}
                                </div>
                            </div>
                        </div>
                    @endcanany
                    @can('post.delete')
                        @if ($post->id)
                            <div class="column field is-pulled-left">
                                <div class="control">
                                    {!! Form::button('<span class="icon is-small"><i class="fa-solid fa-circle-minus"></i></span><span>' . __('message.remove') . '</span>', ['class' => 'button is-danger is-outlined confirmDelete', 'type' => 'submit', 'name' => 'delete', 'disabled' => $readonly]) !!}
                                </div>
                            </div>
                        @endif
                    @endcan
                    <div class="is-clearfix"></div>
                </div>
            @endcanany
        @endif

        {!! Form::close() !!}
    </x-content-page>

    @section('stylesheets')
        <link rel="stylesheet" href="{{ asset('css/trumbowyg.min.css') }}">
    @endsection

    @section('scripts')
        <script src="{{ asset('js/trumbowyg.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/trumbowyg/lang/fr.js') }}"></script>

        <script>
            $(document).ready(function() {
                $('#body').trumbowyg({
                    btns: [
                        ['viewHTML'],
                        ['undo', 'redo'], // Only supported in Blink browsers
                        ['formatting'],
                        ['strong', 'em', 'del'],
                        ['superscript', 'subscript'],
                        ['link'],
                        ['insertImage'],
                        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                        ['unorderedList', 'orderedList'],
                        ['horizontalRule'],
                        ['removeformat'],
                        ['fullscreen']

                    ],
                    lang: "{{ App::currentLocale() }}",
                    autogrow: true,
                });
            });
        </script>
    @endsection

</x-app-layout>
