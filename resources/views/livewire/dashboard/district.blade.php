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
                title="Distrito"
                :capturedRecords="$capturedRecords"
                :totalRecords="$totalRecords"
                :color="$color"
                :advance="$advance"
                :candidates="$candidates"
                :votosCandidatos="$votosCandidatos"
                ></x-dashboard.header>


                <div class="d-flex align-items-center mb-2 mt-10">
                    <span class="fs-2x text-gray-800 me-2 lh-1 ls-n2">
                        Detalle de votos por Municipio
                    </span>
                </div>

                <div class="d-flex align-items-center position-relative my-1 mt-10">                        
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                        </svg>
                    </span>
                    <input type="text" wire:model='search' name="search" class="form-control form-control-solid w-450px ps-15" placeholder="Buscar distrito...">
                </div>

                <div class="table-responsive">
                    <table class="table table-row-bordered table-row-gray-400 table-hover  gs-4 gy-4 gx-4">
                        <thead>
                            <tr class="fw-bold fs-6 border-bottom-2 border-gray-800">
                                <th class="min-w-250px">Distrito</th>
                                @php
                                    $total= 0;
                                    $totales= [];
                                @endphp
                                @foreach ($candidates as $candidate) 
                                <th class="min-w-100px text-center">                                    
                                    @if($candidate->partyLogo)
                                    <img src="{{ asset($candidate->partyLogo) }}"  height="30px">
                                    @endif
                                    <p class="font-size-h3 fw-bold text-gray-800">{{ $candidate->name }}</p>                                        
                                </th>
                                @php
                                    $totales[$candidate->name_replaced]= 0;
                                @endphp
                                @endforeach
                                <th class="min-w-100px text-center fw-bold text-gray-800">Total</th>
                            </tr>
                        </thead>


                        <tbody>

                            @forelse ( $votosCandidatosMunicipios as $key=> $value )                                
                            
                                <tr class="text-gray-700 border-bottom-1 border-gray-200 ">                                    
                                    <td>
                                        <a href="{{ route('dashboard.district.section', (int)$value->distrito) }}">
                                            <span class="text-gray-800 h5"><u>Distrito {{ $value->distrito }}</u></span>
                                        </a>
                                    </td>

                                    @foreach ($candidates as $candidate)
                                    <td class="min-w-100px text-center">
                                        <span class="@if($candidate->name_replaced=="Oscar_Eduardo_Ramírez_Aguilar") text-danger h5 @else text-gray-800 @endif">
                                            {{ number_format($value->{$candidate->name_replaced}, 0) }} 
                                    </span>
                                    </td>
                                        @php
                                        $totales[$candidate->name_replaced]+= $value->{$candidate->name_replaced};
                                        $total+=$value->{$candidate->name_replaced}
                                        @endphp
                                    @endforeach


                                    <td class="min-w-200px text-center">
                                        <span class="text-gray-800">{{ number_format($value->total,0) }} </span>                                    
                                    </td>
                                    

                                </tr>
                                
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr class="text-gray-700 border-top-1 border-gray-200 ">
                                    
                                <td>
                                    <span class="text-gray-800 h5">Total de Votos</span>
                                </td>
                                @foreach ($candidates as $candidate)
                                <td class="min-w-100px text-center">
                                    <span class="@if($candidate->name_replaced=="Oscar_Eduardo_Ramírez_Aguilar") text-danger h5 @else text-gray-800 h5 @endif">
                                        {{ number_format($totales[$candidate->name_replaced], 0) }} 
                                </span>
                                </td>
                                @endforeach
                                <td class="min-w-200px text-center">
                                    <span class="text-gray-800 h5">{{ number_format($total,0) }} </span>                                    
                                </td>

                        </tfoot>
                    </table>
                </div>


            </div>
        </div>
    </div>
</div>

@push('scripts')



@endpush
