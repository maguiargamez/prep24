<div>
   
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">

            <x-breadcrumb 
            :breadcrumb="$breadcrumb"
            :title="$title"
            :currentRouteName="$currentRouteName"
            ></x-breadcrumb>
        

            <div class="d-flex align-items-center gap-2 gap-lg-3">
                
            </div>

        </div>
    </div>

    <div id="kt_app_content_container" class="app-container container-xxl"> 


        <div class="card mb-5">
            <div class="card-body">


                <x-dashboard.header 
                title="Casillas"
                :capturedRecords="$capturedRecords"
                :totalRecords="$totalRecords"
                :color="$color"
                :advance="$advance"
                :candidates="$candidates"
                :votosCandidatos="$votosCandidatos"
                ></x-dashboard.header>




            </div>
        </div>


        <div class="d-flex flex-column flex-lg-row">
            <div class="d-lg-flex flex-column  w-400 w-lg-475px">                
                <div class="card shadow-sm">
                    <div class="card-header border-0 pt-6" >
                        <h3 class="card-title">Filtros de busqueda</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-5">
                            <label class="form-label fw-bold fs-6 text-gray-700">Municipio</label>
                            <x-select wire:model="filterMunicipality" :options="$municipalities" placeholder="Seleccionar" id="filterMunicipality" class="form-select form-select-solid fw-bold"></x-select>
                        </div>
                        <div class="mb-5">
                            <label class="form-label fw-bold fs-6 text-gray-700">Distrito</label>
                            <x-select wire:model="filterDistrict" :options="$districts" placeholder="Seleccionar" id="filterDistrict" class="form-select form-select-solid fw-bold"></x-select>
                        </div>
                        <div class="mb-5">
                            <label class="form-label fw-bold fs-6 text-gray-700">Sección</label>
                            <x-select wire:model="filterSection" :options="$sections" placeholder="Seleccionar" id="filterSection" class="form-select form-select-solid fw-bold"></x-select>
                        </div>
                    </div>
                    <div class="card-footer border-0 pt-6 d-flex flex-column flex-column-aut">
                        <button wire:click="resetFilters" type="reset" class="btn btn-sm btn-primary fw-semibold me-2 px-6"><i class="fa-solid fa-broom"></i> Limpiar filtros</button>
                    </div>
                </div>

            </div>

            <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
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
                                <input type="text" wire:model='search' name="search" data-kt-customer-table-filter="search" class="form-control form-control-solid w-450px ps-15" placeholder="Buscar...">
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                                @if ($items)
                                <div class="dataTables_info">
                                    <div class="row">
                                        <span class="badge badge-primary badge-lg">
                                        Total de registros:                                        
                                            {{ number_format($items->total()) }}
                                        </span>                                        
                                    </div>
                                </div>
                            @endif
                            </div>
                        </div>
        
                    </div>
        
                    <div class="card-body">       
        
        
        
                        <div class="table-responsive">
                            <table class="table table-row-bordered table-row-gray-400 table-hover  gs-4 gy-4 gx-4">
                                <thead>
                                    <tr class="fw-bold fs-6 border-bottom-2 border-gray-800">
                                        <th class="min-w-20px"></th>
                                        <th class="min-w-200px">Municipio</th>
                                        <th class="min-w-100px">Distrito</th>
                                        <th class="min-w-80px">Sección</th>
                                        <th class="min-w-80px">Casilla</th>
                                        <th class="min-w-80px"></th>
                                        @foreach ($candidates as $candidate) 
                                            <th class="min-w-100px text-center">                                    
                                                @if($candidate->partyLogo)
                                                <img src="{{ asset($candidate->partyLogo) }}"  height="30px">
                                                @endif
                                                <p class="font-size-h3 fw-bold text-gray-800">{{ $candidate->name }}</p>                                        
                                            </th>
                                        @endforeach
                                        <th class="min-w-80px">Total de votos</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ( $items as $index => $item )
                                        <tr class="text-gray-700 border-bottom-1 border-gray-200 ">
                                            <td>
                                                @if($item->is_captured)
                                                    <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                            <path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="currentColor"></path>
                                                            <path d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="white"></path>
                                                        </svg>
                                                    </span>
                                                @else
                                                    <span class="svg-icon svg-icon-1 svg-icon-secondary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                            <path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="currentColor"></path>
                                                            <path d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="white"></path>
                                                        </svg>
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="fw-bold fs-6 text-gray-800">{{ $item->municipality }}</td>
                                            <td>
                                                <span class="badge badge-secondary badge-lg">{{$item->district }}</span>                                                
                                            </td>
                                            <td class="text-center fw-bold fs-6 text-gray-800">
                                                <span class="badge badge-success badge-lg">{{$item->section }}</span>
                                                                                                
                                            </td>
                                            <td><span class="badge badge-info badge-lg">{{$item->type_key }}</span></td>
                                            <td class="text-center">

                                                @if($item->is_captured)
                                                    @if($item->capture_source==2)                                                        
                                                        <i class="fa-solid fa-mobile-screen-button fs-4"></i>
                                                    @else
                                                        <i class="fa-solid fa-computer fs-4"></i>
                                                    @endif 
                                                @else
                                                    <i class="fa-solid fa-clock fs-4"></i>
                                                @endif

                                                @if($item->digitized_record)
                                                    <a wire:click.prevent="downloadFile('{{ $item->digitized_record }}')" class="text-primary fw-bold" href="#">
                                                        <i class="fa-solid fa-file text-primary fs-4"></i>                                                        
                                                    </a>
                                                @endif

                                            </td>

                                            @foreach ($candidates as $candidate)
                                                <td class="min-w-100px text-center">
                                                    <span class="@if($candidate->name_replaced=="Oscar_Eduardo_Ramírez_Aguilar") text-danger h5 @else text-gray-800 @endif">
                                                        @if($votesByCantidatePollingPlace[$item->id][$candidate->name_replaced])
                                                            {{                                                         
                                                                number_format(
                                                                $votesByCantidatePollingPlace[$item->id][$candidate->name_replaced]
                                                                , 0
                                                                ) 
                                                            }}
                                                        @else
                                                            -
                                                        @endif
                                                    </span>
                                                </td>
                                            @endforeach

                                            <td class="min-w-100px text-center">
                                                <span class="text-gray-800">
                                                    {{ number_format(
                                                        $votesByCantidatePollingPlace[$item->id]["total"]
                                                        , 0
                                                        ) 
                                                    }} 
                                                </span>
                                            </td>


                                        </tr>
                                        
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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


</div>

@push('scripts')



@endpush
