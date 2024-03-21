@extends('layouts.login')

@section('content')
<div class="d-flex flex-column flex-lg-row flex-column-fluid">

    <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
        <div class="d-flex flex-center flex-column flex-lg-row-fluid">
            <div class="w-lg-500px p-10">
                <form id="kt_sign_up_form" class="form w-100" method="POST" action="{{ route('login') }}">
                @csrf

                    
                    <div class="text-center mb-11">
                        <img class="text-center mb-30" src="{{ asset("img/logos/logo.png") }}">
                        <h1 class="text-dark fw-bolder mb-3">Iniciar sesión</h1>
                        <div class="text-gray-500 fw-semibold fs-6">Bienvenid@, porfavor ingrese sus datos de acceso:</div>
                    </div>

                    <div class="fv-row mb-8 fv-plugins-icon-container">
                        <input id="email" name="email" type="email" placeholder="Email" value="{{ old('email') }}" autocomplete="off" class="form-control bg-transparent @error('email') is-invalid @enderror" autofocus/>
                        @error('email')
                            <span class="fv-plugins-message-container invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="fv-row mb-3 fv-plugins-icon-container">
                        <input id="password" name="password" type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent @error('password') is-invalid @enderror" />

                        @error('password')
                            <span class="fv-plugins-message-container invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="d-grid mb-10">
                        <button type="submit" id="kt_sign_up_submit" class="btn btn-primary">
                            <span class="indicator-label">Ingresar</span>
                            <span class="indicator-progress">Por favor espere...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{--         
        <div class="d-flex flex-center flex-wrap px-5">
            <div class="d-flex fw-semibold text-primary fs-base">
                <a href="../../demo1/dist/pages/team.html" class="px-5" target="_blank">Terms</a>
                <a href="../../demo1/dist/pages/pricing/column.html" class="px-5" target="_blank">Plans</a>
                <a href="../../demo1/dist/pages/contact.html" class="px-5" target="_blank">Contact Us</a>
        </div> 
        --}}
    </div>
    <!--end::Body-->

</div>
@endsection