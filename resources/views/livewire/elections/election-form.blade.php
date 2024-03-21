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
                    <x-backButton route="elections.index"></x-backButton>
                    <x-buttons.submit-button></x-buttons.submit-button>
                </div>

            </div>
        </div>

        <div id="kt_app_content_container" class="app-container container-xxl">

            <div class="col-lg-12" wire:loading wire:target="save">
                <x-loaders.loading-form></x-loaders.loading-form>
            </div>
            
            <div wire:loading.remove wire:target="save" class="card mb-5 mb-xl-10">

                <div class="card-header border-0 cursor-pointer">
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Información</h3>
                    </div>
                </div>



                <div id="kt_account_settings_profile_details" class="collapse show">
                        <div class="card-body border-top p-9">

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

                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">Tipo de elección*</label>
                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="input-group mb-5">
                                            <span class="input-group-text" id="basic-addon2"><i class="fa-solid fa-arrows-spin"></i></span>
                                            <x-select wire:model="election.election_type_id" :options="$electionTypes" placeholder="Seleccionar" id="election_type_id"></x-select>
                                            @error('election.election_type_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror 
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">Descripción*</label>
                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="input-group mb-5">
                                            <span class="input-group-text" id="election.description"><i class="fa-solid fa-list-ol"></i></span>
                                            <input wire:model="election.description" type="text" class="form-control @error('election.description')  is-invalid @enderror">
                                            
                                            @error('election.description')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>  
                            
                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">Estado*</label>
                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="input-group mb-5">
                                            <span class="input-group-text" id="basic-addon2"><i class="fa-solid fa-arrows-spin"></i></span>
                                            <x-select wire:model="election.state_id" :options="$states" placeholder="Seleccionar" id="state_id"></x-select>
                                            @error('election.state_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror 
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">Municipio</label>
                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="input-group mb-5">
                                            <span class="input-group-text" id="basic-addon2"><i class="fa-solid fa-arrows-spin"></i></span>
                                            <x-select wire:model="election.municipality_id" :options="$municipalities" placeholder="Seleccionar" id="municipality_id"></x-select>
                                            @error('election.municipality_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror 
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