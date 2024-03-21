<table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="kt_table_users">
    <thead>
        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
            <th class="w-10px">#</th>
            <th class="w-10px pe-2 sorting_disabled" rowspan="1" colspan="1" aria-label="" style="width: 29.8906px;">
                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                    <input class="form-check-input" type="checkbox" data-kt-check="true" wire:model="selectAllItems">
                </div>
            </th>
            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 278.234px;">Usuario</th>

            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="Role: activate to sort column ascending" style="width: 162.906px;">Rol</th>

            <th class="min-w-10px sorting" tabindex="0" rowspan="1" colspan="1" style="width: 100px;">Estatus</th>

            <th class="text-end min-w-100px sorting_disabled" rowspan="1" colspan="1" aria-label="Actions" style="width: 130.891px;">Acciones</th>
        </tr>        
    </thead>
    <tbody class="text-gray-600 fw-semibold">

        @forelse ( $items as $index => $item )
            <tr class="odd">
                <td class="ps-1">{{ $items->firstItem() + $index }}</td>                                          
                <td align="center">
                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                        <input type="checkbox" class="form-check-input" wire:model="selectedItems" value="{{ $item->id }}">
                    </div>
                </td>
                <td class="d-flex align-items-center">
                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <a href="#">
                            <div class="symbol-label">
                                <img src="{{ asset('metronic/media/avatars/'.$item->photo) }}" class="w-100">
                            </div>
                        </a>
                    </div>
                    <div class="d-flex flex-column">
                        @if ($item->eco_user_type_id==4)
                            <a href="#" class="text-gray-800 text-hover-primary mb-1">{{ $item->company }}</a>
                        @else
                            <a href="#" class="text-gray-800 text-hover-primary mb-1">{{ $item->firstname." ".$item->lastname }}</a>
                        @endif
                        <span>{{ $item->email }}</span>
                    </div>
                    <td>
                        <div class="badge badge-light fw-bold">{{ $item->ecoUserType->name }}</div>
                    </td>
                    <td>
                        <div class="badge badge-light fw-bold">{{ $item->ecoUserStatus->name }}</div>
                    </td>

                </td>

            </tr>
        @empty
        @endforelse      
 

    </tbody>
</table>