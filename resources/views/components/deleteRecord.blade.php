@props([
    'item'=> 0,
    ])
@push('scripts')
Livewire.on('deleteRecord', itemId => {
    Swal.fire({
        html: `Estas seguro de querer <strong class="text-danger">eliminar</strong> este registro?<br><br>
        <strong class="text-warning">Advertencia:</strong> Los registros eliminados, no podrán ser recuperados posteriormente!`,
        icon: "info",
        buttonsStyling: false,
        showCancelButton: true,
        confirmButtonText: "Si, estoy seguro!",
        cancelButtonText: 'No, cancelar',
        customClass: {
            confirmButton: "btn btn-primary",
            cancelButton: 'btn btn-danger'
        }
    }).then((result) => {
        if (result.isConfirmed) {            
            Livewire.emitTo('inventory.trees.trees','destroy', itemId);
            Swal.fire(
                'Eliminado',
                'El registro ha sido eliminado!',
                'success'
            )
        }
    })
});
@endpush