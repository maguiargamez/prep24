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
                    

                    <h1 class="fs-2x text-danger mb-2">{{ $election->description }}</h1>
                    
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

                    <h2 class="fs-2x text-info mb-2">Distrito</h2>


                    <h3 class="text-darko mb-2">Resumen de la votación</h3>

                    <div class="table-responsive">
                        <table class="table table-row-bordered table-hover table-row-gray-600">
                            <thead>
                                <th class="min-w-100px text-center "></th>
                                @foreach ($candidates as $candidate) 
                                    <th class="min-w-200px text-center">
                                        @if($candidate->partyLogo)
                                            <img src="{{ asset($candidate->partyLogo) }}"  height="30px">
                                        @endif
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

                    <h2 class="text-darko mb-2">Detalle de votos por Distrito</h2>

                    <div class="table-responsive">
                        <table class="table table-row-bordered table-row-gray-600">
                            <thead>
                                <th class="min-w-200px text-center "></th>
                                @foreach ($candidates as $candidate) 
                                    <th class="min-w-200px text-center">
                                        @if($candidate->partyLogo)
                                            <img src="{{ asset($candidate->partyLogo) }}"  height="30px">
                                        @endif
                                        <p class="font-size-h3 fw-bold text-gray-800">{{ $candidate->name }}</p>                                        
                                    </th>
                                @endforeach
                                <th class="min-w-100px text-center fw-bold text-gray-800">Total</th>
                            </thead>
                            <tbody>
                                @foreach ($districts as $district)
                                    <tr>
                                        <td class="fw-bold text-gray-800">{{ $district->district }}</td>

                                        @foreach ($candidates as $candidate)
                                            <td class="min-w-200px text-center">
                                                {{ number_format($district->results[$candidate->id]) }}
                                            </td>
                                        @endforeach

                                        <td class="min-w-200px text-center">
                                            {{ number_format($district->results['total']) }}
                                        </td>   
                                    </tr>     
                                @endforeach
                            </tbody>
                            <tfoot>
                                <th class="fw-bold text-gray-800">TOTAL</th>
                                @php
                                    $total=0;
                                @endphp
                                @foreach ($candidates as $candidate) 
                                    <th class="min-w-200px text-center">                                        
                                        <p class="font-size-h3 fw-bold text-gray-800">{{ number_format($candidate->votes) }}</p>                                        
                                    </th>
                                    @php
                                        $total+=$candidate->votes;
                                    @endphp
                                @endforeach
                                <th class="min-w-100px text-center fw-bold text-gray-800">{{ number_format($total) }}</th>
                            </tfoot>
                        </table>
                    </div>


                </div>  

            </div>
        </div>



    </div>
</div>
