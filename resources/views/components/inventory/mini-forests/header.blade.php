@php
    //$routeName= \Route::currentRouteName();
    //dd($routeName);
@endphp
<div class="card mb-6 mb-xl-9">
    <div class="card-body pt-9 pb-0">
        <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
            <div class="d-flex flex-center flex-shrink-0 bg-light rounded w-100px h-100px w-lg-150px h-lg-150px me-7 mb-4">
                <img class="mw-150px mw-lg-150px" src="{{ asset('img/logos/bosquenagal-arbol.jpg') }}" alt="image">
            </div>
            <div class="flex-grow-1">

                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                    <div class="d-flex flex-column">
                        <div class="d-flex align-items-center mb-1">
                            <a href="#" class="text-gray-800 text-hover-primary fs-2 fw-bold me-3">Inventario de Mini Bosques</a>
                        </div>
                        <!--<div class="d-flex flex-wrap fw-semibold mb-4 fs-5 text-gray-400">Registro de todos los árboles existentes, libre y adoptados.</div>-->
                    </div>
                    <div class="d-flex mb-4">

                        <!--<a href="{{ route('trees.create') }}" type="button" class="btn btn-sm btn-primary me-3">
                            <i class="fa-solid fa-tree"></i>    
                            Agregar árbol(es)
                        </a>-->

                        <div class="me-0">
                            <!--
                            <button class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <i class="bi bi-three-dots fs-3"></i>
                            </button>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3" data-kt-menu="true">
                                <div class="menu-item px-3">
                                    <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Reportes</div>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3">General</a>
                                </div>
                            </div>
                            -->
                        </div>
                    </div>
                </div>


                <div class="d-flex flex-wrap justify-content-start">
                    <div class="d-flex flex-wrap">
                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="fs-4 fw-bold">{{ $options["total"] }}</div>
                            </div>
                            <div class="fw-semibold fs-6 text-gray-400">Total de Mini Bosques</div>
                        </div>

                        @foreach ($options["data"] as $datos)
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <span class="svg-icon svg-icon-3 svg-icon-danger me-2">
                                       
                                    </span>
                                    <div class="fs-4 fw-bold counted" data-kt-countup="true" data-kt-countup-value="75" data-kt-initialized="1">{{ $datos->total }}</div>
                                </div>
                                <div class="fw-semibold fs-6 text-gray-400">Mini Bosque {{ $datos->status }}</div>
                            </div>
                        @endforeach

 
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>