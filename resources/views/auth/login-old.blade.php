@extends('layouts.login')

@section('content')

<div class="d-flex flex-lg-row-fluid">
    <!--begin::Content-->
    <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
        <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="{{ asset('img/login/empresas-c-223x223x5x0x217x223x1654497720.png') }}" alt="" />
 

        <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">Salvemos juntos los bosques secos tropicales</h1>
        <div class="text-gray-600 fs-base text-center fw-semibold">
            Ayúdanos a mitigar el impacto ambiental que generamos en el planeta a través de la siembra de árboles
        </div>
    </div>
</div>

<div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
    <!--begin::Wrapper-->
    <div class="bg-body d-flex flex-center rounded-4 w-md-600px p-10">
        <div class="w-md-400px">
            <form id="kt_sign_up_form" class="form w-100" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="text-center mb-11">
                    <h1 class="text-dark fw-bolder mb-3">CRM Bosquenagal</h1>
                    <div class="text-gray-500 fw-semibold fs-6">Bienvenid@, Por favor inicia sesión</div>
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

                <div class="fv-row mb-8">


                    <input id="email" name="email" type="email" placeholder="Email" value="{{ old('email') }}" autocomplete="off" class="form-control bg-transparent @error('email') is-invalid @enderror" autofocus/>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="fv-row mb-8" data-kt-password-meter="true">
                    <div class="mb-1">
                        <div class="position-relative mb-3">

                            <input id="password" name="password" type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent @error('password') is-invalid @enderror" />

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror  


                            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                <i class="bi bi-eye-slash fs-2"></i>
                                <i class="bi bi-eye fs-2 d-none"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="d-grid mb-10">
                    <button type="submit" id="kt_sign_up_submit" class="btn btn-success">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        <span class="indicator-label">Ingresar</span>
                        <span class="indicator-progress">Por favor espera...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
                
            </form>
        </div>
    </div>
</div>




@endsection
