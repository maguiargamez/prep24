@props([
    'route' => Route::currentRouteName(),  
    ])


<a href="{{ route($route) }}" type="button" class="btn btn-sm btn-secondary"> 
    <i class="fa-solid fa-circle-left"></i> Regresar
</a>