<div>
    <div>
   
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
    
                <x-breadcrumb 
                :breadcrumb="$breadcrumb"
                :title="$title"
                :currentRouteName="$currentRouteName"
                ></x-breadcrumb>            
    
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <x-select wire:model="electionId" :options="$elections" placeholder="Seleccionar" id="electionId"></x-select>

                </div>
    
            </div>
        </div>
    
        <div id="kt_app_content_container" class="app-container container-xxl">               
    

            <div class="card-body d-flex flex-column justify-content-between bgi-no-repeat bgi-size-cover bgi-position-x-center pb-0" style="background-position: 100% 50%; background-image:url('assets/media/stock/900x600/42.png')">
                <div class="mb-10">
                    <div class="fs-2hx fw-bold text-gray-800 text-center mb-5">
                    <!--<span class="me-2">Elección {{ $election->electionType->description }}-->
                    <span class="position-relative d-inline-block text-danger">
                        <a href="#" class="text-danger opacity-75-hover">{{ $election->description }}</a>
                        <span class="position-absolute opacity-15 bottom-0 start-0 border-4 border-danger border-bottom w-100"></span>
                    </span></span></div>
                </div>
            </div>


            <div class="card">
                <div class="card-header border-0 cursor-pointer">
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Avance de captura:</h3>&nbsp;
                        <span class="lh-sm fw-semibold">                                
                            <span class="text-muted">{{ number_format($capturedRecords) }} </span>/
                            <span class="text-info">{{ number_format($totalRecords) }} </span>                                 
                        </span> 
                    </div>
                    
                </div>

                @php
                    $color="success";
                    if($totalRecords>0){
                        $avance= number_format((($capturedRecords*100)/$totalRecords),2);
                    }else{
                        $avance= 0;                        
                    }                    
                    //$avance= 70;
                    if($avance<=25){ $color="danger"; }
                    if($avance>25 && $avance<=75){ $color="warning"; }
                    
                @endphp

                <div class="card-body">
                    <div class="mb-15">
                        <div class="d-flex align-items-center flex-column mt-3">
                            <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                <span class="fw-semibold fs-6 text-gray-400">Avance</span>
                                
                                <span class="fw-bold fs-6 lh-sm fw-semibold">                                
                                    <span class="text-muted">{{ number_format($capturedRecords) }} </span>/
                                    <span class="text-primary">{{ number_format($totalRecords) }} </span>                                 
                                </span>
                            </div>

                            <div class="d-flex w-100 progress h-40px">
                                <div class="progress-bar bg-{{ $color }} rounded" role="progressbar" style="width: {{ $avance  }}%;" aria-valuenow="{{ $avance }}" aria-valuemin="0" aria-valuemax="100" role="progressbar">
                                    <span class="text-white">
                                        <span class="lh-sm fw-semibold">                                
                                            <span class="fw-semibold">{{ $avance  }}%</span>                                
                                        </span>
                                    </span>                                              
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                    <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                                </svg>
                            </span>
                            <input type="text" wire:model='search' name="search" class="form-control form-control-solid w-450px ps-15" placeholder="Buscar por sección...">
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start my-5">
                        @if ($items)
                            <div class="dataTables_info">
                                <div class="row">
                                    <span class="text-muted">Total de registros:
                                    <b class="text-gray-800">{{ $items->total() }}</b></span>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="dataTables_wrapper dt-bootstrap4 no-footer">                
                            <div class="table-responsive">
                            @php
                                $i=0;
                            @endphp

                        
                                <table class="table table-rounded table-striped border gy-7 gs-7">
                                    <thead>
                                        <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                                            <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">DISTRITO</th>
                                            <th style="width: 200px;">ACTAS DIGITALIZADAS</th>
                                            <th style="width: 400px;">AVANCE</th>
                                            <th class="text-end min-w-150px sorting_disabled" rowspan="1" colspan="1" style="width: 150px;">META</th>
                                            
                                        </tr>
                                    </thead>
                            
                                    <tbody class="fw-bold text-gray-700">

                                        @foreach($items as $item)
                            
                                            <tr>
                            
                                            
                                                <td style="padding-left: 10px">
                                                    <a href="{{ route('records.district.index', $item) }}"
                                                    class="text-gray-700 text-hover-primary">{{ $item->district }}</a>                                                    
                                                </td>

                                                <td class="text-center">
                                                    <span class="@if($item->captured > $item->total) text-success @else text-muted @endif text-hover-primary">
                                                        {{ $item->total_actas }}
                                                    </span> / 
                                                    <span class="text-info text-hover-primary">
                                                        {{ $item->total }}
                                                    </span>
                                                </td>
                                                <td>

                                                    @php
                                                        $color2="success";
                                                        $avance2= number_format((($item->captured*100)/$item->total),2);
                                                        //$avance= 70;
                                                        if($avance<=25){ $color2="danger"; }
                                                        if($avance>25 && $avance<=75){ $color2="warning"; }
                                                    
                                                    @endphp

                                                    
                                                    <div class="progress-bar bg-{{ $color2 }} rounded h-20px" role="progressbar" style="width: {{ $avance2  }}%;" aria-valuenow="{{ $avance2  }}" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="text-white">
                                                            {{ $avance2  }}%
                                                        </span>                                              
                                                    </div>

                                                </td>
                                                <td align="right">
                            
                                                    <span class="@if($item->captured > $item->total) text-success @else text-muted @endif text-hover-primary">
                                                        {{ $item->captured }}
                                                    </span> / 
                                                    <span class="text-info text-hover-primary">
                                                        {{ $item->total }}
                                                    </span>
                            
                                                </td>
                            
                                            </tr>

                                            @php
                                                $i++;
                                            @endphp
                            
                                        @endforeach
                                    </tbody>
                            
                                </table>

                            </div>
                        
                        </div>
                        
                        
                        </div>



    
                        <div class="row">
                            <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
        
                            </div>
                            <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                                <div class="dataTables_paginate paging_simple_numbers" id="kt_file_manager_list_paginate">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
    
            </div>
            
                
        </div>
    </div>
</div>