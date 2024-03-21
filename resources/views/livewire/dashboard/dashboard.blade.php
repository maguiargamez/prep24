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
        
        

        <div class="card">
            <div class="card-body p-5 px-lg-19 py-lg-16">
                <div class="mb-10">
                    <h1 class="fs-2x text-dark mb-2">Avance</h1>
                    
                </div>

                <div class="row g-10 mb-15">
                    <div class="col-sm-3">
                        <div class="mb-5">
                            <span class="text-gray-500 pt-1 fw-semibold fs-6">Actas capturadas:</span>
                            <div class="d-flex align-items-center mb-2">
                                <span class="fs-2x  text-gray-800 me-2 lh-1 ls-n2">
                                    {{ number_format($capturedRecords)." de " }}
                                    <span class="fw-bold">{{ number_format($totalRecords) }}</span>
                                </span>
                                <span class="badge badge-light-{{ $color }} fs-2x "> 
                                    {{ $advance }}%
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="d-flex w-100 progress h-40px">
                            <div class="progress-bar bg-{{ $color }} rounded" role="progressbar" style="width: {{ $advance  }}%;" aria-valuenow="{{ $advance }}" aria-valuemin="0" aria-valuemax="100" role="progressbar">
                                <span class="text-white">
                                    <span class="lh-sm fw-semibold">                                
                                        <span class="fw-semibold">{{ $advance  }}%</span>                                
                                    </span>
                                </span>                                              
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-sm-4">
                        3
                    </div> --}}

                    <div class="fs-5 text-gray-900 fw-semibold mb-20">
                        El total de votos calculado y porcentaje que se muestran, se refieren a los votos asentados en las Actas PREP hasta el momento.
                        <br>Por presentación, los decimales de los porcentajes muestran sólo cuatro dígitos. No obstante, al considerar todos los decimales, suman 100%.
                        <br>El total de votos mostrado a nivel Entidad representa la suma del voto emitido en territorio estatal y desde el extranjero.
                    </div>

                    <div class="row row-cols-lg-3 row-cols-md-3">
                        @foreach ($candidates as $candidate) 
                            @if(!$candidate->is_special)                       
                            <div class="mb-12">
                                <div class="d-flex me-5 me-xl-13">
                                    <div class="symbol symbol-100px symbol-circle me-3">
                                        <img src="{{ asset($candidate->photo) }}" class="">
                                    </div>
                                    <div class="mt-0">
                                        <p class="font-size-h3 fw-bold text-gray-800 ">{{ $candidate->name }}</p>
                                        <img src="{{ asset($candidate->partyLogo) }}"  height="30px">
                                        <span class="fw-bold d-block text-gray-800 fs-12 mt-5">
                                            
                                            @if($totalVotes>0)
                                                {{ number_format((($candidate->votes*100)/$totalVotes),2) }}%  
                                            @else
                                                0%
                                            @endif 
                                        </span>
                                        
                                    </div>
                                </div>
                            </div>   
                            @endif
                        @endforeach
                    </div>

                    <div class="table-responsive">
                        <table class="table table-row-bordered table-row-gray-600">
                            <thead>
                                <th class="min-w-100px text-center "></th>
                                @foreach ($candidates as $candidate) 
                                    <th class="min-w-200px text-center">
                                        <img src="{{ asset($candidate->partyLogo) }}"  height="30px">
                                        <p class="font-size-h3 fw-bold text-gray-800">{{ $candidate->name }}</p>                                        
                                    </th>
                                @endforeach
                                <th class="min-w-100px text-center fw-bold text-gray-800">Total</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="fw-bold text-gray-800">Total de votos</td>
                                    @php
                                        $total=0;
                                    @endphp
                                    @foreach ($candidates as $candidate)
                                        <td class="min-w-200px text-center">
                                            {{ number_format($candidate->votes) }}                                       
                                        </td>
                                        @php
                                            $total+=$candidate->votes;
                                        @endphp
                                    @endforeach
                                    <td class="min-w-200px text-center">{{ number_format($total) }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-gray-800">Porcentaje</td>
                                    @foreach ($candidates as $candidate)
                                        <td class="min-w-200px text-center">
                                            @if($totalVotes>0)
                                                {{ number_format((($candidate->votes*100)/$totalVotes),2) }}%  
                                            @else
                                                0%
                                            @endif                                     
                                        </td>
                                    @endforeach
                                    <td class="min-w-200px text-center">
                                        @if($totalVotes>0)
                                            {{ number_format((($total*100)/$totalVotes),2) }}% 
                                        @else
                                            0%
                                        @endif                                            
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                </div>  

            </div>
        </div>



    </div>
</div>
