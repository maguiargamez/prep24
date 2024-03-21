<div>
    <form wire:submit.prevent="save">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">

                <x-breadcrumb 
                :breadcrumb="$breadcrumb"
                :title="$title"
                :currentRouteName="$currentRouteName"
                ></x-breadcrumb>            

                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <x-backButton route="elections.index"></x-backButton>                    
                </div>

            </div>
        </div>

        <div id="kt_app_content_container" class="app-container container-xxl">

            <div class="col-lg-12" wire:loading wire:target="save">
                <x-loaders.loading-form></x-loaders.loading-form>
            </div>
            
            <div wire:loading.remove wire:target="save" class="card mb-5 mb-xl-10">

                <div class="card-header border-0 cursor-pointer">
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Plantilla para migrar</h3>
                    </div>
                </div>
               
                <div class="card-body border-top p-9">

                    @if(session('flashStatus'))
                    <div class="alert alert-success d-flex align-items-center p-5 mb-10">          
                        <div class="d-flex flex-column">
                            <h4 class="mb-1 text-success">Exito!</h4>
                            <span>{{ session('flashStatus') }}</span>
                        </div>
                        <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    @endif

                    @if(session('flashError'))
                        <div class="alert alert-danger d-flex align-items-center p-5 mb-10">          
                            <div class="d-flex flex-column">
                                <h4 class="mb-1 text-danger">Error!</h4>
                                <span>{{ session('flashError') }}</span>
                            </div>
                            <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                    @endif

                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">Elección*</label>
                        <div class="col-lg-10">
                            <div class="row">
                                <div class="input-group mb-5">
                                    <span class="input-group-text" id="basic-addon2"><i class="fa-solid fa-arrows-spin"></i></span>
                                    <x-select wire:model="electionId" :options="$elections" placeholder="Seleccionar" id="electionId"></x-select>
                                    @error('election.electionId')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">Descripción*</label>
                        <div class="col-lg-10">
                            <div class="row">
                                <div class="input-group mb-5">
                                    <span class="input-group-text" id="file"><i class="fa-solid fa-list-ol"></i></span>

                            
                                    <input class="form-control @error('file')  is-invalid @enderror" type="file" name="file" accept=".xls,.xlsx" id="file" wire:model='file' onchange="@this.set('file', this.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1]);">
                                    
                                    @error('file')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <x-buttons.submit-button-import></x-buttons.submit-button-import>
                </div>
            </div>





   
            <div wire:loading.remove wire:target="save" class="card mb-5 mb-xl-10">
                <div class="card">

                    <div class="card-header border-0 cursor-pointer">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Información a migrar</h3>
                        </div>
                    </div>
        
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            
                            <div class="d-flex align-items-center position-relative my-1">
                                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                                <input type="text" wire:model='search' name="search" data-kt-customer-table-filter="search" class="form-control form-control-solid w-450px ps-15" placeholder="Buscar por sección...">
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                                <button type="button" class="btn btn-sm btn-danger @if(count($selectedItems)>0) visible @else invisible @endif" wire:click="$emit('deleteRecords')">
                                    <i class="fa-solid fa-trash"></i>
                                    Eliminar seleccionados
                                </button> &nbsp;
                                <button wire:loading.attr="disabled" wire:click="import" wire:target="import" type="button" class="btn btn-sm btn-primary me-3">     
                                    <i class="fa-solid fa-upload"></i> 
                                    <span wire:loading.remove wire:target="import">
                                        Importar información
                                    </span>
                                    <span wire:loading wire:target="import">
                                        Guardando...
                                    </span>
                            </button>
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
        
        
        
                            <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer">
        
                                <thead>
                                
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        
                                        <th class="w-10px">#</th>
                                        
                                        <th class="w-10px pe-2 sorting_disabled" rowspan="1" colspan="1" style="width: 29.8906px;">
                        
                                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                <input class="form-check-input" type="checkbox" data-kt-check="true" wire:model="selectAllItems">
                                            </div>
                        
                                        </th>
                        
                                        <th class="min-w-125px sorting" style="width: 350px;" >Elección</th>
                                        <th class="min-w-125px sorting" style="width: 350px;" >Municipio</th>    
                                        <th class="min-w-125px sorting" style="width: 350px;" >Dtto. local</th>    
                                        <th class="min-w-125px sorting" style="width: 350px;" >Dtto. federal</th>    
                                        <th class="min-w-125px sorting" style="width: 350px;" >Sección</th>    
                                        <th class="min-w-125px sorting" style="width: 350px;" >Tipo de sección</th> 
                                                        
                                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 200px;">Acciones</th>
                        
                        
                                    </tr>
                                    
                                </thead>
                        
                                <tbody class="fw-semibold text-gray-600">          
                                                        
                                    @forelse ( $items as $index => $item )                
                                        <tr class="odd">
                        
                                            <td class="ps-1">{{ $items->firstItem() + $index }}</td>
                                                                  
                                            <td align="center">
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input type="checkbox" class="form-check-input" wire:model="selectedItems" value="{{ $item->id }}">
                                                </div>
                                            </td>
                        
                       
                                            <td>
                                                <span>{{ $item->election->description }}</span>
                                            </td>
                                            <td>{{ $item->municipality }}</td>
                                            <td>{{ $item->local_district }}</td>
                                            <td>{{ $item->federal_district }}</td>
                                            <td>{{ $item->section }}</td>
                                            <td>{{ $item->section_type }}</td>
        
                        
                                            <td class="text-end" data-kt-filemanager-table="action_dropdown">
                           
                                                <a class="btn btn-icon btn-bg-danger btn-active-color-default btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar" wire:click="$emit('deleteRecord', {{ $item->id }})">
                                                    <span class="svg-icon svg-icon-3">
                                                       <i class="fa-solid fa-trash text-white"></i>
                                                    </span>
                                                </a> 
                        
                                            </td>
                        
                                        </tr>
                                    @empty
                                    @endforelse                                
                                </tbody>
                        
                        
                            </table>
                            <div class="d-flex justify-content-end py-0"></div>                   
        
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
    </form>
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
                Livewire.emitTo('polling-places.polling-place-import','destroy', itemId);
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
                Livewire.emitTo('polling-places.polling-place-import','destroySelected');
                Swal.fire(
                    'Eliminado',
                    'Los registros han sido eliminado!',
                    'success'
                )
            }
        })
    });


@endpush