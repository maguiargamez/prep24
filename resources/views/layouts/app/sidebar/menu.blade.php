
@php
    $currentRouteName= Route::currentRouteName();
    //dd($currentRouteName);
@endphp
<div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
 
    <div class="menu-item pt-5">
        <div class="menu-content">
            <span class="menu-heading fw-bold text-uppercase fs-7">Dahsboard</span>
        </div>
    </div>

    <div class="menu-item">
        <a class="menu-link @if(Str::is('dashboard.home*', $currentRouteName)) active @endif" href="{{ route('dashboard.home') }}">
            <span class="menu-icon">
                <span class="svg-icon svg-icon-2">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor" />
                        <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor" />
                        <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor" />
                        <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor" />
                    </svg>
                </span>
            </span>
            <span class="menu-title">Entidad</span>
        </a>
    </div>

    <div class="menu-item">
        <a class="menu-link @if(Str::is('dashboard.district*', $currentRouteName)) active @endif" href="{{ route('dashboard.district') }}">
            <span class="menu-icon">
                <span class="svg-icon svg-icon-2">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor" />
                        <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor" />
                        <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor" />
                        <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor" />
                    </svg>
                </span>
            </span>
            <span class="menu-title">Distrito</span>
        </a>
    </div>

    <div class="menu-item">
        <a class="menu-link @if(Str::is('dashboard.section*', $currentRouteName)) active @endif" href="{{ route('dashboard.section') }}">
            <span class="menu-icon">
                <span class="svg-icon svg-icon-2">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor" />
                        <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor" />
                        <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor" />
                        <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor" />
                    </svg>
                </span>
            </span>
            <span class="menu-title">Sección</span>
        </a>
    </div>

    <div class="menu-item pt-5">
        <div class="menu-content">
            <span class="menu-heading fw-bold text-uppercase fs-7">Captura de información</span>
        </div>
    </div>


    <div class="menu-item">
        <a class="menu-link @if(Str::is('captura*', $currentRouteName)) active @endif" href="{{ route('capture.polling-places.index') }}">
            <span class="menu-icon">
                <span class="svg-icon svg-icon-2">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.3" d="M7 20.5L2 17.6V11.8L7 8.90002L12 11.8V17.6L7 20.5ZM21 20.8V18.5L19 17.3L17 18.5V20.8L19 22L21 20.8Z" fill="currentColor"></path>
                        <path d="M22 14.1V6L15 2L8 6V14.1L15 18.2L22 14.1Z" fill="currentColor"></path>
                    </svg>
                </span>
            </span>
            <span class="menu-title">Casillas</span>
        </a>
    </div>

    <div class="menu-item pt-5">
        <div class="menu-content">
            <span class="menu-heading fw-bold text-uppercase fs-7">Catalogos</span>
        </div>
    </div>




    <div class="menu-item">
        <a class="menu-link @if(Str::is('elections*', $currentRouteName)) active @endif" href="{{ route('elections.index') }}">
            <span class="menu-icon">
                <span class="svg-icon svg-icon-2">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.3" d="M7 20.5L2 17.6V11.8L7 8.90002L12 11.8V17.6L7 20.5ZM21 20.8V18.5L19 17.3L17 18.5V20.8L19 22L21 20.8Z" fill="currentColor"></path>
                        <path d="M22 14.1V6L15 2L8 6V14.1L15 18.2L22 14.1Z" fill="currentColor"></path>
                    </svg>
                </span>
            </span>
            <span class="menu-title">Elecciones</span>
        </a>
    </div>

    <div class="menu-item">
        <a class="menu-link @if(Str::is('parties*', $currentRouteName)) active @endif" href="{{ route('parties.index') }}">
            <span class="menu-icon">
                <span class="svg-icon svg-icon-2">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.3" d="M7 20.5L2 17.6V11.8L7 8.90002L12 11.8V17.6L7 20.5ZM21 20.8V18.5L19 17.3L17 18.5V20.8L19 22L21 20.8Z" fill="currentColor"></path>
                        <path d="M22 14.1V6L15 2L8 6V14.1L15 18.2L22 14.1Z" fill="currentColor"></path>
                    </svg>
                </span>
            </span>
            <span class="menu-title">Partidos/Coaliciones</span>
        </a>
    </div>

    <div class="menu-item">
        <a class="menu-link @if(Str::is('candidates*', $currentRouteName)) active @endif" href="{{ route('candidates.index') }}">
            <span class="menu-icon">
                <span class="svg-icon svg-icon-2">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.3" d="M7 20.5L2 17.6V11.8L7 8.90002L12 11.8V17.6L7 20.5ZM21 20.8V18.5L19 17.3L17 18.5V20.8L19 22L21 20.8Z" fill="currentColor"></path>
                        <path d="M22 14.1V6L15 2L8 6V14.1L15 18.2L22 14.1Z" fill="currentColor"></path>
                    </svg>
                </span>
            </span>
            <span class="menu-title">Candidatos</span>
        </a>
    </div>

    <div class="menu-item">
        <a class="menu-link @if(Str::is('polling-places*', $currentRouteName)) active @endif" href="{{ route('polling-places.index') }}">
            <span class="menu-icon">
                <span class="svg-icon svg-icon-2">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.3" d="M7 20.5L2 17.6V11.8L7 8.90002L12 11.8V17.6L7 20.5ZM21 20.8V18.5L19 17.3L17 18.5V20.8L19 22L21 20.8Z" fill="currentColor"></path>
                        <path d="M22 14.1V6L15 2L8 6V14.1L15 18.2L22 14.1Z" fill="currentColor"></path>
                    </svg>
                </span>
            </span>
            <span class="menu-title">Casillas</span>
        </a>
    </div>



 


    
 

</div>
<!--end::Menu-->