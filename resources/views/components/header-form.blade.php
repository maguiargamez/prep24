@props([
    'number'=> 0,
    'title'=> 0,
    ])
<h3>
    <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" data-bs-original-title="Perry Matthew" data-kt-initialized="1">
        <span class="symbol-label bg-danger text-inverse-danger fw-bold">{{ $number }}</span>
    </div>
   {{ $title }}
</h3>