<div>
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

        <div class="card">
            <div class="card-body p-lg-12">
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

                            <x-header-form number='2' title='Boletas sobrantes de la elección'></x-header-form>
                            <div class="input-group mb-8">
                                <input wire:model="prepPollingPlaceRecord.c_casilla_id" type="text" class="form-control @error('prepPollingPlaceRecord.c_casilla_id')  is-invalid @enderror">                     
                                @error('prepPollingPlaceRecord.c_casilla_id')
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
