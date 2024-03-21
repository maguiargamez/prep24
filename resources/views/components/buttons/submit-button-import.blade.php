<button wire:loading.attr="disabled" wire:target="save" type="submit" class="btn btn-sm btn-primary me-3"> 
    
        <i class="fa-solid fa-upload"></i> 
        <span wire:loading.remove wire:target="save">
            Importar para revisión
        </span>
        <span wire:loading wire:target="save">
            Guardando...
        </span>
</button>