<button wire:loading.attr="disabled" wire:target="save" type="submit" class="btn btn-sm btn-primary me-3"> 
    
        <i class="fa-solid fa-save"></i> 
        <span wire:loading.remove wire:target="save">
            Guardar
        </span>
        <span wire:loading wire:target="save">
            Guardando...
        </span>
</button>