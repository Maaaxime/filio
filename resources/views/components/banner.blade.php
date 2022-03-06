<script src="{{ asset('js/modal.js') }}" type="text/javascript"></script>

@if (count($errors) > 0)
    <dialog open id="modal-message">
        <article>
            <a href="#close" aria-label="{{ __('message.close') }}" class="close" data-target="modal-message"
                onClick="toggleModal(event)">
            </a>
            <header>
                <hgroup>
                    <h2>{{ __('message.whoops') }}</h2>
                    <h3>{{ __('message.whoopsDetails') }}</h3>
                </hgroup>
            </header>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <footer>
                <a href="#confirm" class="btn-success" role="button" data-target="modal-message"
                    onClick="toggleModal(event)">
                    {{ __('message.confirm') }}
                </a>
            </footer>
        </article>
    </dialog>
@endif

@if ($message = Session::get('success'))
    <dialog open id="modal-message">
        <article>
            <a href="#close" aria-label="{{ __('message.close') }}" class="close" data-target="modal-message"
                onClick="toggleModal(event)">
            </a>
            <p>{{ $message }}</p>
            <footer>
                <a href="#confirm" class="btn-success" role="button" data-target="modal-message"
                    onClick="toggleModal(event)">
                    {{ __('message.confirm') }}
                </a>
            </footer>
        </article>
    </dialog>
@endif
