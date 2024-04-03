<div>
   
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">

            <x-breadcrumb 
            :breadcrumb="$breadcrumb"
            :title="$title"
            ></x-breadcrumb>
        

            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="{{ route('elections.create') }}" type="button" class="btn btn-sm btn-primary me-3">
                    <i class="fa-solid fa-plus"></i>    
                    Agregar elección
                </a>
            </div>

        </div>
    </div>

    <div id="kt_app_content_container" class="app-container container-xxl"> 

        <div class="card">

            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                            </svg>
                        </span>
                        <input type="text" wire:model='search' name="search" data-kt-customer-table-filter="search" class="form-control form-control-solid w-350px ps-15" placeholder="Buscar por nombre del beneficio...">
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                        <button type="button" class="btn btn-sm btn-danger @if(count($selectedItems)>0) visible @else invisible @endif" wire:click="$emit('deleteRecords')">
                            <i class="fa-solid fa-trash"></i>
                            Eliminar seleccionados
                        </button> &nbsp;
                    </div>
                </div>

            </div>

            <div class="card-body">
                <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
                    @if ($items)
                        <div class="dataTables_info">
                            <div class="row">
                                <span class="text-muted">Total de registros:
                                <b class="text-gray-800">{{ $items->total() }}</b></span>
                            </div>
                        </div>
                    @endif
                </div>
                <div id="kt_customers_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

                    @include('livewire.elections.table')

                    <div class="row">
                        <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
    
                        </div>
                        <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                            <div class="dataTables_paginate paging_simple_numbers" id="kt_file_manager_list_paginate">
                                {{ $items->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>


</div>

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
                Livewire.emitTo('elections.elections','destroy', itemId);
                Swal.fire(
                    'Eliminado',
                    'El registro ha sido eliminado!',
                    'success'
                )
            }
        })
    });

    Livewire.on('deleteRecords', ()=> {
        Swal.fire({
            html: `Estas seguro de querer <strong class="text-danger">eliminar</strong> estos registros?<br><br>
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
                Livewire.emitTo('elections.elections','destroySelected');
                Swal.fire(
                    'Eliminado',
                    'Los registros han sido eliminado!',
                    'success'
                )
            }
        })
    });


@endpush