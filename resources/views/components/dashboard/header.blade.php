
@props([
    'capturedRecords'=> 0,    
    'totalRecords'=> 0,    
    'color'=> "",
    'advance'=> 0,
    'title'=> "",
    'titleAdvance'=> "",
    'candidates'=> [],
    'votosCandidatos'=> [],
    ])

@php
//dd($currentRouteName);
@endphp
<div class="mb-10">
    <h1 class="fs-2x text-dark mb-2">
        <span class="text-danger">
            @if($titleAdvance!="")
                {{ $titleAdvance }} -
            @endif            
        </span>
        Avance
    </h1>    
</div>

<div class="row g-10">
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
</div>

<div class="d-flex align-items-center mb-2 mt-10">
    <span class="badge badge-light-danger fs-2x"> 
        Gubernatura
    </span>
    <span class="fs-2x text-gray-800 me-2 lh-1 ls-n2">
        - {{ $title }} 
    </span>
</div>

<div class="fs-5 text-gray-900 fw-semibold mb-20">
    El total de votos calculado y porcentaje que se muestran, se refieren a los votos asentados en las Actas PREP hasta el momento.
    <br>Por presentación, los decimales de los porcentajes muestran sólo cuatro dígitos. No obstante, al considerar todos los decimales, suman 100%.
    <br>El total de votos mostrado a nivel Entidad representa la suma del voto emitido en territorio estatal y desde el extranjero.
</div>

<div class="row row-cols-lg-3 row-cols-md-3 mt-20">
    @foreach ($candidates as $candidate) 
        @if(!$candidate->is_special)                       
        <div class="mb-12">
            <div class="d-flex me-5 me-xl-13">
                <div class="symbol symbol-100px symbol-circle me-3">
                    <img src="{{ asset($candidate->photo) }}" class="">
                </div>
                <div class="mt-0">
                    <p class="h2 fw-bold @if($candidate->name_replaced=="Oscar_Eduardo_Ramírez_Aguilar") text-danger @else text-gray-800 @endif ">{{ $candidate->name }}</p>
                    <img src="{{ asset($candidate->partyLogo) }}"  height="30px">
                    <span class="fw-bold d-block h1 mt-5 @if($candidate->name_replaced=="Oscar_Eduardo_Ramírez_Aguilar") text-danger @else text-gray-800 @endif">                                                
                        @if($votosCandidatos["total"]>0)
                            {{ number_format((($votosCandidatos[$candidate->name_replaced]*100)/$votosCandidatos["total"]),2) }}%  
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

<div class="table-responsive mt-20">
    <table class="table table-row-bordered table-row-gray-600">
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
                        <span class="@if($candidate->name_replaced=="Oscar_Eduardo_Ramírez_Aguilar") text-danger h2 @else text-gray-800 @endif">
                        {{ number_format($votosCandidatos[$candidate->name_replaced]) }}   
                        
                        </span>
                    </td>
                    @php
                        $total+=$votosCandidatos[$candidate->name_replaced];
                    @endphp
                @endforeach
                <td class="min-w-200px text-center">{{ number_format($total) }}</td>
            </tr>
            <tr>
                <td class="fw-bold text-gray-800">Porcentaje</td>
                @foreach ($candidates as $candidate)
                    <td class="min-w-200px text-center">
                        <span class="@if($candidate->name_replaced=="Oscar_Eduardo_Ramírez_Aguilar") text-danger h2 @else text-gray-800 @endif">
                        @if($votosCandidatos["total"]>0)
                            {{ number_format((($votosCandidatos[$candidate->name_replaced]*100)/$votosCandidatos["total"]),2) }}%  
                        @else
                            0%
                        @endif 
                    </span>
                    </td>
                @endforeach
                <td class="min-w-200px text-center">
                    @if($votosCandidatos["total"]>0)
                        {{ number_format((($total*100)/$votosCandidatos["total"]),2) }}% 
                    @else
                        0%
                    @endif                                            
                </td>
            </tr>
        </tbody>
    </table>
</div>