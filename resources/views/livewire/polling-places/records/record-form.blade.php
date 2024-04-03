<div>
    <form wire:submit.prevent="save" enctype="multipart/form-data">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <x-breadcrumb 
                :breadcrumb="$breadcrumb"
                :title="$title"
                :currentRouteName="$currentRouteName"
                ></x-breadcrumb>        

                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <x-backButton route="records.polling-places.index"></x-backButton>
                    <x-buttons.submit-button></x-buttons.submit-button>
                </div>
            </div>
        </div>

        <div id="kt_app_content_container" class="app-container container-xxl">

            <div class="col-lg-12" wire:loading wire:target="save">
                <x-loaders.loading-form></x-loaders.loading-form>
            </div>

            <div wire:loading.remove wire:target="save" class="card">
                <div class="card-body p-lg-12">
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
                    <div class="flex-lg-row-fluid me-xl-18">
                        <div class="mt-n1">
                            <div class="m-0">
                                
                                <div class="fw-bold fs-3 text-gray-800 mb-8">
                                    <span class="badge badge-light-danger fs-2x"> 
                                        Distrito {{ $cCasilla->dtto_loc.'. ' }}
                                    </span>
                                    <span class="fs-2x text-gray-800 me-2 lh-1 ls-n2"> 
                                        Sección {{ $cCasilla->seccion }}
                                    </span>
                                </div>

                                <label for="prepPollingPlaceRecord.leftover_ballots" class="form-label fw-bold">
                                    <span class="badge badge-circle badge-danger">1</span>
                                    Datos de la casilla
                                </label>

                                <div class="d-flex flex-wrap py-5">
                                    <div class="flex-equal me-5">
                                        <table class="table fs-6 fw-semibold gs-0 gy-2 gx-2 m-0">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gray-600 min-w-175px w-175px fs-3">Casilla:</td>
                                                    <td class="text-gray-800 min-w-200px fs-4">
                                                        {{ $cCasilla->seccion.' '.$cCasilla->tipo_casilla }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-gray-600 fs-3">Municipio:</td>
                                                    <td class="text-gray-800 fs-4">Catazaja</td>
                                                </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="flex-equal">
                                        <table class="table fs-6 fw-semibold gs-0 gy-2 gx-2 m-0">
                                            <tbody>
                                                <tr>
                                                    <td class="text-gray-600 min-w-175px w-175px fs-3">Padrón electoral:</td>
                                                    <td class="text-gray-800 min-w-200px fs-4">
                                                        {{ $cCasilla->padron_electoral }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-gray-600 fs-3">Lista nominal:</td>
                                                    <td class="text-gray-800 fs-4">{{ $cCasilla->lista_nominal }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="separator separator-dashed mb-7"></div>


                                <div class="row">

                                    <div class="col-lg-6">

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-10">
                                                    <label for="prepPollingPlaceRecord.leftover_ballots" class="form-label fw-bold">
                                                        <span class="badge badge-circle badge-danger">2</span>
                                                        Boletas sobrantes de la elección
                                                    </label>
                                                    <input wire:model="prepPollingPlaceRecord.leftover_ballots" type="text" class="form-control @error('prepPollingPlaceRecord.leftover_ballots')  is-invalid @enderror">                     
                                                    @error('prepPollingPlaceRecord.leftover_ballots')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-10">
                                                    <label for="prepPollingPlaceRecord.voters" class="form-label fw-bold">
                                                        <span class="badge badge-circle badge-danger">3</span>
                                                        Personas que votaron
                                                    </label>
                                                    <input wire:model="prepPollingPlaceRecord.voters" type="text" class="form-control @error('prepPollingPlaceRecord.voters')  is-invalid @enderror">                     
                                                    @error('prepPollingPlaceRecord.voters')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-10">
                                                    <label for="prepPollingPlaceRecord.party_representative_voters" class="form-label fw-bold">
                                                        <span class="badge badge-circle badge-danger">4</span>
                                                        Rep. de partidos políticos que votaron
                                                    </label>
                                                    <input wire:model="prepPollingPlaceRecord.party_representative_voters" type="text" class="form-control @error('prepPollingPlaceRecord.party_representative_voters')  is-invalid @enderror">                     
                                                    @error('prepPollingPlaceRecord.party_representative_voters')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-10">
                                                    <label for="prepPollingPlaceRecord.voters_sum" class="form-label fw-bold">
                                                        <span class="badge badge-circle badge-danger">5</span>
                                                        Sume las cantidades del apartado <span class="badge badge-circle badge-danger">3</span> y <span class="badge badge-circle badge-danger">4</span>
                                                    </label>
                                                    <input disabled="disabled" wire:model="prepPollingPlaceRecord.voters_sum" type="text" class="form-control @error('prepPollingPlaceRecord.voters_sum')  is-invalid @enderror">                     
                                                    @error('prepPollingPlaceRecord.voters_sum')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-10">
                                                    <label for="prepPollingPlaceRecord.votes_taken_urn" class="form-label fw-bold">
                                                        <span class="badge badge-circle badge-danger">6</span>
                                                        Votos de la elección sacados de la urna
                                                    </label>
                                                    <input wire:model="prepPollingPlaceRecord.votes_taken_urn" type="text" class="form-control @error('prepPollingPlaceRecord.votes_taken_urn')  is-invalid @enderror">                     
                                                    @error('prepPollingPlaceRecord.votes_taken_urn')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="prepPollingPlaceRecord.votes_taken_urn" class="form-label fw-bold">
                                                    Digitalizar acta
                                                </label>

                                                <div class="input-group mb-10">
                                                    <input wire:model="digitizedRecord" type="file" class="form-control @error('digitizedRecord') is-invalid @enderror">  
                    
                                                    @error('digitizedRecord')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                
                                                @if($prepPollingPlaceRecord->digitized_record)
                                                    <div class="overflow-auto pb-5">
                                                        <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-700px p-5">
                                                            <div class="d-flex flex-aligns-center pe-10 pe-lg-20">
                                                                <img alt="" class="w-30px me-3" src="{{ asset('metronic/media/svg/files/pdf.svg') }}">
                                                                <div class="ms-1 fw-semibold">
                                                                    <a wire:click.prevent="downloadFile('{{ $prepPollingPlaceRecord->digitized_record }}')" class="fs-6 text-hover-primary fw-bold" href="#" >
                                                                        Acta digitalizada
                                                                    </a>
                                                                    <div class="text-gray-400">{{ $digitizedRecordSize }} Kb</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>                                       
                                                @endif

                                            </div>
                                        
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="mb-10">
                                                    <label for="prepPollingPlaceRecord.votes_matched_urn" class="form-label fw-bold">
                                                        <span class="badge badge-circle badge-danger">7</span>
                                                        Es igual el número total del apartado <span class="badge badge-circle badge-danger">5</span> con el total de votos de la elección sacados de la urna del apartado <span class="badge badge-circle badge-danger">6</span>
                                                    </label>
                                                    
                                                    <select name="prepPollingPlaceRecord.votes_matched_urn" wire:model="prepPollingPlaceRecord.votes_matched_urn" class="form-select p-2 @error('prepPollingPlaceRecord.votes_matched_urn') is-invalid @enderror">
                                                        <option value="" selected>Seleccionar</option>
                                                        <option value=1>Si</option>
                                                        <option value=0>No</option>                                                
                                                    </select>

                                                    @error('prepPollingPlaceRecord.votes_matched_urn')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>



                                    </div>

                                    <div class="col-lg-6">
                                        <label for="prepPollingPlaceRecord.leftover_ballots" class="form-label fw-bold">
                                            <span class="badge badge-circle badge-danger">8</span>
                                            Resultados de la elección para la gubernatura
                                        </label>

                                        <div class="table-responsive">
                                            <table class="table table-hover table-rounded table-striped border gy-3 gs-7">
                                                <thead>
                                                    <tr class="fw-semibold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                                                        <th>Partido</th>
                                                        <th>Votos</th>
                                                        <th>Partido</th>
                                                        <th>Votos</th>
                                                    </tr>
                                                </thead>
        
                                                <tbody>
                                                    @php
                                                        $i= 1;
                                                    @endphp
                                                    @foreach ($partiesCoalitions as $item)

                                                        @if($i%2==1)
                                                            <tr class="">
                                                        @endif
                                                        <td class="d-flex align-items-center">
                                                            @if($item['logo']!=null)
                                                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                                    <a href="#">
                                                                        <div class="symbol-label">
                                                                            @php
                                                                                $logoRoute= 'img/logos/';
                                                                            @endphp
                                                                            <img src="{{ asset($item['logo']) }}" class="w-100">
                                                                        </div>
                                                                    </a>
                                                                </div> 
                                                            @else
                                                                <a href="#" class="text-gray-800 text-hover-primary mb-1">{{ $item['name'] }}</a> 
                                                            @endif
        
                                                        </td>
                                                        <td>
                                                            <input wire:model="partiesCoalitionsValues.{{ $item['id'] }}" type="text"  class="form-control @error('partiesCoalitionsValues.'.$item['id'])  is-invalid @enderror">
                                                            @error('partiesCoalitionsValues.'.$item['id'])
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </td>

                                                        @if($i%2==0)
                                                            </tr>
                                                        @endif
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
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
