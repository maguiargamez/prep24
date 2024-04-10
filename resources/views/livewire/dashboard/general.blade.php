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
                title="Entidad"
                :capturedRecords="$capturedRecords"
                :totalRecords="$totalRecords"
                :color="$color"
                :advance="$advance"
                :candidates="$candidates"
                :votosCandidatos="$votosCandidatos"
                ></x-dashboard.header>

            </div>
        </div>






    </div>


</div>

@push('scripts')



@endpush
