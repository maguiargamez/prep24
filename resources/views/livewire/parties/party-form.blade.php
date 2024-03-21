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
                    <x-backButton route="parties.index"></x-backButton>
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
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">Elección*</label>
                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="input-group mb-5">
                                            <span class="input-group-text" id="basic-addon2"><i class="fa-solid fa-arrows-spin"></i></span>
                                            <x-select wire:model="partyCoalition.election_id" :options="$elections" placeholder="Seleccionar" id="election_id"></x-select>
                                            @error('partyCoalition.election_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror 
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">Logo de la empresa*</label>
                                <div class="col-lg-10">
                                    
                                    <div wire:ignore class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url( {{ ($partyCoalition->logo!=null ) ? asset($partyCoalition->logo) : asset('img/logos/default.png'); }}) }})">
    
                                        <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ ($partyCoalition->logo!=null ) ? asset($partyCoalition->logo) : asset('img/logos/default.png'); }})"></div>
                                        <!--end::Preview existing avatar-->
    
                                        <!--begin::Label-->
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" aria-label="Cambiar logo" data-bs-original-title="Cambiar logo" data-kt-initialized="1">
                                            <i class="fa-solid fa-pen"></i>
                                            <input wire:model="logo" name="logo"  type="file" accept=".png, .jpg, .jpeg">
    
                                            <input type="hidden" name="photo_remove">
                                        </label>
                                        <!--end::Label-->
    
                                        <!--begin::Cancel-->
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" aria-label="Cancelar logo" data-bs-original-title="Cancelar logo" data-kt-initialized="1">
                                            <i class="fa-solid fa-xmark"></i>                          
                                        </span>
                                        <!--end::Cancel-->
    
                                        <!--begin::Remove-->
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" aria-label="Quitar logo" data-bs-original-title="Quitar logo" data-kt-initialized="1">
                                            <i class="fa-solid fa-xmark"></i>                           
                                        </span>
                                        <!--end::Remove-->
                                    </div>
                                    <div class="form-text">Tipos de archivos permitidos: png</div>
                                    @error('logo')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
    
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">Nombre*</label>
                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="input-group mb-5">
                                            <span class="input-group-text" id="partyCoalition.name"><i class="fa-solid fa-list-ol"></i></span>
                                            <input wire:model="partyCoalition.name" type="text" class="form-control @error('partyCoalition.name')  is-invalid @enderror">
                                            
                                            @error('partyCoalition.name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>  

                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">Es coalición</label>
                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="input-group mb-5">
                                            <span class="input-group-text" id="basic-addon2"><i class="fa-solid fa-arrows-spin"></i></span>

                                            <select name="partyCoalition.is_coalition" wire:model="partyCoalition.is_coalition" class="form-select p-2 @error('partyCoalition.is_coalition') is-invalid @enderror">
                                                <option value="">Seleccionar</option>
                                                <option value=1>Si</option>
                                                <option value=0>No</option>                                                
                                            </select>

                                            @error('partyCoalition.is_coalition')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror 
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">Es candidato independiente</label>
                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="input-group mb-5">
                                            <span class="input-group-text" id="basic-addon2"><i class="fa-solid fa-arrows-spin"></i></span>

                                            <select name="partyCoalition.is_independent" wire:model="partyCoalition.is_independent" class="form-select p-2 @error('partyCoalition.is_independent') is-invalid @enderror">
                                                <option value="">Seleccionar</option>
                                                <option value=1>Si</option>
                                                <option value=0>No</option>                                                
                                            </select>

                                            @error('partyCoalition.is_independent')
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