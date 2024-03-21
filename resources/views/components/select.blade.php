@props([
    'disabled'=> false,
    'placeholder'=> 'Select',
    'options' => [],
    'class' => "form-select p-2 "
    ])

@error($attributes["wire:model"]) 
    @php
        $class= "form-select p-2 is-invalid";
    @endphp    
@enderror

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class'=>$class]) !!}>
    <option value="" selected>{{ $placeholder }}</option>
    @foreach ($options as $id => $label)
        <option value="{{ $id }}">{{ $label }}</option>
    @endforeach
</select>