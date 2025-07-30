<div class="modal-header">
    <h5 class="modal-title" id="staticBackdropLabel">
        {{ $title }}
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span>&times;</span>
    </button>
</div>
<div class="modal-body">
    {{ $slot }}
</div>
