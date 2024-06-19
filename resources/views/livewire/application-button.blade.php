<div>
    @if($applied)
        <button wire:click="delete" class="btn btn-danger">Törlés</button>
    @else
        <button wire:click="apply" class="btn btn-success">Jelentkezés</button>
    @endif
</div>
