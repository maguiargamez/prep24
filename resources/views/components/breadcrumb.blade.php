@props([
    'breadcrumb'=> [],    
    'title'=> 'Inicio',
    'currentRouteName' => Route::currentRouteName(),  
    ])


@php

    //dd($currentRouteName);
@endphp
<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        {{ $title }}
    </h1>
    <ul class="breadcrumb breadcrumb-right  fw-semibold fs-base my-1 pt-1">

        <li class="breadcrumb-item text-muted">                        
            <a href="{{ route("dashboard.home") }}" class="text-muted text-hover-success">                
                <i class="fa-solid fa-house text-muted"></i>&nbsp;                
                Inicio
            </a>
        </li>

        @php
            $i=0;
        @endphp
        @foreach ($breadcrumb as $key=>$route)

                @if($route and !is_array($route))
                    @if($route==$currentRouteName)
                        <li class="breadcrumb-item text-gray-900">                       
                            <i class="fa-solid fa-thumbtack text-gray-900"></i>&nbsp;
                            {{ $key }}                            
                        </li>
                    @else
                        <li class="breadcrumb-item text-muted">                        
                            <a href="{{ route($route) }}" class="text-muted text-hover-success">
                                {{ $key }}
                            </a>
                        </li>
                    @endif

                @else
                    @if(is_array($route))

                        @if($route[0]==$currentRouteName)
                            <li class="breadcrumb-item text-gray-900">                       
                                <i class="fa-solid fa-thumbtack text-gray-900"></i>&nbsp;
                                {{ $key }}                       
                            </li>
                        @else
                            <li class="breadcrumb-item text-muted">                        
                                <a href="{{ route($route[0], $route[1]) }}" class="text-muted text-hover-success">
                                    {{ $key }}
                                </a>
                            </li>
                        @endif
                    @else
                        <li class="breadcrumb-item text-muted">                                                
                            {{ $key }}
                        </li>
                    @endif
                @endif
            
            @if(!$loop->last)

            @endif
            @php
                $i++;
            @endphp

        @endforeach
    </ul>
</div>