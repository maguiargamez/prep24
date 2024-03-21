<div class="table-responsive">
    <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer">

        <thead>
        
            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">

                <th class="w-10px">#</th>
                
                <th class="w-10px pe-2 sorting_disabled" rowspan="1" colspan="1" style="width: 29.8906px;">

                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                        <input class="form-check-input" type="checkbox" data-kt-check="true" wire:model="selectAllItems">
                    </div>

                </th>

                <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1" >
                    Tipo
                </th>
                
                <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1" >
                    Descripción
                </th>

                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 200px;">
                    Estado
                </th>

                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 200px;">
                    Municipio
                </th>

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

                    <td class="align-items-center">     
                        {{ $item->electionType->description }}
                    </td>

                    <td class="align-items-center">     
                        {{ $item->description }}
                    </td>

                    <td class="align-items-center">     
                        {{ $item->state->name }}
                    </td>

                    <td class="align-items-center">     
                        {{ $item->municipality->name }}
                    </td>
                    
                   

                    <td class="text-end" data-kt-filemanager-table="action_dropdown">

                        <a class="btn btn-icon btn-bg-warning btn-active-color-default btn-sm" href="{{ route('elections.edit', $item) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar">
                            <span class="svg-icon svg-icon-3">
                               <i class="fa-solid fa-edit text-white"></i>
                            </span>
                        </a>
   
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
    <div class="d-flex justify-content-end py-0">
    
    </div>

</div>