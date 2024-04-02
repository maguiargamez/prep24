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
                    <x-backButton route="capture.polling-places.index"></x-backButton>
                    <x-buttons.submit-button></x-buttons.submit-button>
                </div>
    
            </div>
        </div>

        <div id="kt_app_content_container" class="app-container container-xxl">

            <div class="col-lg-12" wire:loading wire:target="save">
                <x-loaders.loading-form></x-loaders.loading-form>
            </div>

            <div class="card mb-5 mb-xxl-8">
                <div class="card-body pt-9 pb-0">
                    <div class="d-flex flex-wrap flex-sm-nowrap">
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center mb-2">
                                        <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">
                                            {{ 'Distrito '. $this->pollingPlanceInformation->district }}
                                        </a>
                                    </div>
                                    <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                        
                                        <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                            <span class="badge badge-success badge-lg">
                                                <span class="svg-icon svg-icon-4 me-1 text-white">
                                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.3" d="M16.5 9C16.5 13.125 13.125 16.5 9 16.5C4.875 16.5 1.5 13.125 1.5 9C1.5 4.875 4.875 1.5 9 1.5C13.125 1.5 16.5 4.875 16.5 9Z" fill="currentColor"></path>
                                                        <path d="M9 16.5C10.95 16.5 12.75 15.75 14.025 14.55C13.425 12.675 11.4 11.25 9 11.25C6.6 11.25 4.57499 12.675 3.97499 14.55C5.24999 15.75 7.05 16.5 9 16.5Z" fill="currentColor"></path>
                                                        <rect x="7" y="6" width="4" height="4" rx="2" fill="currentColor"></rect>
                                                    </svg>
                                                </span>

                                            
                                                {{ $this->pollingPlanceInformation->section2 }}
                                            </span>
                                        </a>

                                        <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                            <span class="badge badge-info badge-lg">
                                                <span class="svg-icon svg-icon-4 me-1 text-white">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.3" d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z" fill="currentColor"></path>
                                                        <path d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z" fill="currentColor"></path>
                                                    </svg>
                                                </span>
                                                {{ 'Casilla '.$this->pollingPlanceInformation->type_key }}
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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

                    <div class="row">
                        <div class="col-lg-6">
                            <x-header-form number='1' title='Datos de la casilla'></x-header-form>

                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">
                                    Entidad
                                </label>
                                <div class="col-lg-10 col-form-label fw-semibold fs-6">
                                    <div class="text-gray-400">
                                        CHIAPAS
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">
                                    Municipio
                                </label>
                                <div class="col-lg-10 col-form-label fw-semibold fs-6">
                                    <div class="text-gray-400">
                                        Tuxtla Gutierrez
                                    </div>
                                </div>
                            </div>
    
                            <x-header-form number='2' title='Boletas sobrantes de la elección'></x-header-form>
                            <div class="input-group mb-8">
                                <input wire:model="pollingPlace.leftover_ballots" type="text" class="form-control @error('pollingPlace.leftover_ballots')  is-invalid @enderror">                     
                                @error('pollingPlace.leftover_ballots')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div> 
    
    
                            <x-header-form number='3' title='Personas que votaron'></x-header-form> 
                            <div class="input-group mb-8">
                                <input wire:model="pollingPlace.received_ballots" type="text" class="form-control @error('pollingPlace.received_ballots')  is-invalid @enderror">                     
                                @error('pollingPlace.received_ballots')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div> 
    
                            <x-header-form number='4' title='Representantes de partidos políticos'></x-header-form> 
                            <div class="input-group mb-8">
                                <input wire:model="pollingPlace.special_ballots" type="text" class="form-control @error('pollingPlace.special_ballots')  is-invalid @enderror">                     
                                @error('pollingPlace.special_ballots')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div> 
    
                            <x-header-form number='5' title='Sume las cantidades del apartado 3 y 4'></x-header-form>
                            <div class="input-group mb-8">
                                <input disabled="disabled" value="{{ $pollingPlace->received_ballots+$pollingPlace->special_ballots }}" type="text" class="form-control">             

                            </div>   
    
                            <x-header-form number='6' title='Votos de la elección sacados de la urna'></x-header-form> 
                            <div class="input-group mb-8">
                                <input wire:model="pollingPlace.taken_ballots" type="text" class="form-control @error('pollingPlace.taken_ballots')  is-invalid @enderror">                     
                                @error('pollingPlace.taken_ballots')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
    
                    
    
                            <x-header-form number='7' title='Es igual el número total del apartado 5 con el total de votos de la elección sacados de la urna del apartado 6'></x-header-form> 
   
                            <input disabled="disabled" value="{{ ($pollingPlace->received_ballots+$pollingPlace->special_ballots==$pollingPlace->taken_ballots) ? "SI" : "NO"; }}" type="text" class="form-control mb-8" placeholder="name@example.com"/>

                            <x-header-form number='8' title='Acta digitalizada'></x-header-form>


                            <div class="input-group mb-8">
                                <input wire:model="digitizedRecord" type="file" class="form-control @error('digitizedRecord')  is-invalid @enderror">  

                                @error('digitizedRecord')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                            @enderror
                            </div>
                            
                            @if($pollingPlace->digitized_record)
                                <div class="overflow-auto pb-5">
                                    <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-700px p-5">
                                        <div class="d-flex flex-aligns-center pe-10 pe-lg-20">
                                            <img alt="" class="w-30px me-3" src="{{ asset('metronic/media/svg/files/pdf.svg') }}">
                                            <div class="ms-1 fw-semibold">
                                                <a wire:click.prevent="downloadFile('{{ $pollingPlace->digitized_record }}')" class="fs-6 text-hover-primary fw-bold" href="#" >
                                                    Acta digitalizada
                                                </a>
                                                <div class="text-gray-400">{{ $digitizedRecordSize }} Kb</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                       
                            @endif
                            

                        </div>

                        <div class="col-lg-6">

                                <div class="table-responsive">
                                    <table class="table table-hover table-rounded table-striped border gy-3 gs-7">
                                        <thead>
                                            <tr class="fw-semibold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                                                <th>Partido</th>
                                                <th>Votos</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($partiesCoalitions as $item)
                                            <tr class="">
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
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>


                            
                        </div>
                    </div>


                </div>
            </div>
            
        </div>

    </form>
</div>
