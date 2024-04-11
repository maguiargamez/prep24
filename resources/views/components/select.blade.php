@props([
    'disabled'=> false,
    'placeholder'=> 'Select',
    'options' => [],
    'class' => "form-select p-2 ",
    'default' => true
    ])

@error($attributes["wire:model"]) 
    @php
        $class= "form-select p-2 is-invalid";
    @endphp    
@enderror

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class'=>$class]) !!}>
    @if($default)
        <option value="" selected>{{ $placeholder }}</option>
    @endif

    @foreach ($options as $id => $label)
        <option value="{{ $id }}">{{ $label }}</option>
    @endforeach
</select>