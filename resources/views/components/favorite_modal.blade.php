@if (!Auth::check() && !Cookie::get('favorite_agree'))
    <div class="modal modal-favorite _active">
        <div class="modal__inner">
            <div class="modal__title">Warning</div>
            <div class="modal__description">Without registration, the list of favorite tracks can be reset
                to zero</div>
            <button class="button-gradient modal-favorite__button">Agree</button>
        </div>
    </div>
@endif
