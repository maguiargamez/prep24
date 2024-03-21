
    @if($tree->id!=null)
    <div class="row">
        <div class="row mb-6 col-lg-6">
            <label class="col-lg-4 col-form-label required fw-semibold fs-6">ID árbol</label>
            <div class="col-lg-8">
                <span class="fw-bold fs-6 text-gray-800">
                    {{ $treeKey }}
                </span>
            </div>
        </div>
    </div>
    @else
        <div class="row">
            <div class="row mb-6 col-lg-6">
                <label class="col-lg-4 col-form-label fw-semibold fs-6">Cantidad de árboles</label>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="input-group mb-5">
                            <span class="input-group-text" id="basic-addon2"><i class="fa-solid fa-hashtag"></i></span>
                            <input wire:model="cantidadArboles" type="text" class="form-control @error('cantidadArboles') is-invalid @enderror">  
                            @error('cantidadArboles')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror                         
                        </div>
                    </div>
                </div>
            </div> 
        </div> 
    @endif

    <div class="row">

        <div class="row mb-6 col-lg-6">
            <label class="col-lg-4 col-form-label fw-semibold fs-6">Estatus del árbol</label>
            <div class="col-lg-8">
                <div class="row">
                    <div class="input-group mb-5">
                        <span class="input-group-text" id="basic-addon2"><i class="fa-solid fa-arrows-spin"></i></span>
                        <x-select wire:model="tree.tree_status_id" :options="$treeStatuses" placeholder="Seleccionar" id="tree_status_id"></x-select>
                        @error('tree.tree_status_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror 
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-6 col-lg-6">
            <label class="col-lg-4 col-form-label fw-semibold fs-6">Ciclo de vida</label>
            <div class="col-lg-8">
                <div class="row">
                    <div class="input-group mb-5">
                        <span class="input-group-text" id="basic-addon2"><i class="fa-solid fa-arrows-spin"></i></span>
                        <x-select wire:model="tree.tree_life_cycle_id" :options="$treeLifeCycles" placeholder="Seleccionar" id="tree_life_cycle_id"></x-select>
                        @error('tree.tree_life_cycle_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror 
                    </div>
                </div>
            </div>
        </div>

        
    </div>



    <div class="row">

        <div class="row mb-6 col-lg-6">
            <label class="col-lg-4 col-form-label fw-semibold fs-6">Fecha de registro</label>
            <div class="col-lg-8">
                <div class="row">
                    <div class="input-group" id="kt_td_picker_date_only" data-td-target-input="nearest" data-td-target-toggle="nearest">
                        <span class="input-group-text">
                            <i class="fas fa-calendar"></i>
                        </span>
                        <input wire:model.lazy="tree.acquisition_date" name="tree.acquisition_date" id="tree.acquisition_date" type="text" class="form-control datepicker @error('tree.acquisition_date') is-invalid @enderror" />
                        @error('tree.acquisition_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror  
                    </div>
                </div>
            </div>
        </div>
            
        <div class="row mb-6 col-lg-6">
            <label class="col-lg-4 col-form-label fw-semibold fs-6">Año de mantenimiento</label>
            <div class="col-lg-8">
                <div class="row">
                    <div class="input-group mb-5">
                        <span class="input-group-text" id="basic-addon2"><i class="fa-solid fa-hashtag"></i></span>
                        <input wire:model="tree.maintenance_year" type="text" class="form-control @error('tree.maintenance_year') is-invalid @enderror">  
                        @error('tree.maintenance_year')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror                         
                    </div>
                </div>
            </div>
        </div>

    </div> 
    
    <div class="row" >
        <div class="row mb-6 col-lg-6">
            <label class="col-lg-4 col-form-label fw-semibold fs-6">Fecha de siembra</label>
            <div class="col-lg-8">
                <div class="row">
                    <div wire:ignore class="input-group" id="kt_td_picker_date_only" data-td-target-input="nearest" data-td-target-toggle="nearest">
                        <span class="input-group-text">
                            <i class="fas fa-calendar"></i>
                        </span>
                        <input wire:model.lazy="tree.seedtime" name="tree.seedtime" id="tree.seedtime" type="text" class="form-control datepicker @error('tree.seedtime') is-invalid @enderror" />
                        @error('tree.seedtime')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror  
                    </div>
                </div>
            </div>
        </div>
            
        <div class="row mb-6 col-lg-6">
            <label class="col-lg-4 col-form-label fw-semibold fs-6">Edad del árbol</label>
            <div class="col-lg-8">
                <div class="row">
                    <div class="input-group mb-5">
                        <span class="input-group-text" id="basic-addon2"><i class="fa-solid fa-list-ol"></i></span>
                        <input wire:model="tree.tree_age" type="text" class="form-control @error('tree.tree_age')  is-invalid @enderror">
                        
                        @error('tree.tree_age')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>


    </div>  

        

        
    <div class="row">

        <div class="row mb-6 col-lg-6">
            <label class="col-lg-4 col-form-label fw-semibold fs-6">Tipo de árbol</label>
            <div class="col-lg-8">
                <div class="row">
                    <div class="input-group mb-5">
                        <span class="input-group-text" id="basic-addon2"><i class="fa-solid fa-tree"></i></span>
                        <x-select  wire:model="tree.tree_type_id" :options="$treeTypes" placeholder="Seleccionar" id="tree_type_id"></x-select> 
                        @error('tree.tree_type_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror                       
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-6 col-lg-6">
            <label class="col-lg-4 col-form-label fw-semibold fs-6">Nombre científico</label>
            <div class="col-lg-8">
                <div class="row">
                    <div class="input-group mb-5">
                        <span class="input-group-text" id="basic-addon2"><i class="fa-solid fa-tree"></i></span>
                        <x-select wire:model="tree.tree_scientific_name_id" :options="$treeScientificNames" placeholder="Seleccionar" id="tree_scientific_name_id"></x-select> 
                        @error('tree.tree_scientific_name_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror                       
                    </div>
                </div>
            </div>
        </div>

    </div>
        
    <div class="row">
        <div class="row mb-6 col-lg-6">
            <label class="col-lg-4 col-form-label fw-semibold fs-6">Zona*</label>
            <div class="col-lg-8">
                <div class="row">
                    <div class="input-group mb-5">
                        <span class="input-group-text" id="basic-addon2"><i class="fa-solid fa-tree"></i></span>
                        <x-select wire:model="tree.zone_id" :options="$zones" placeholder="Seleccionar" id="zone_id"></x-select> 
                        @error('tree.zone_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror                       
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-6 col-lg-6">
            <label class="col-lg-4 col-form-label fw-semibold fs-6">Predio</label>
            <div class="col-lg-8">
                <div class="row">
                    <div class="input-group mb-5">
                        <span class="input-group-text" id="tree.property"><i class="fa-solid fa-location-dot"></i></span>
                        <input wire:model="tree.property" type="text" class="form-control @error('tree.property') is-invalid @enderror"> 
                        @error('tree.property')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror                          
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    <div class="row">
        <div class="row mb-6 col-lg-6">
            <label class="col-lg-4 col-form-label fw-semibold fs-6">Latitud</label>
            <div class="col-lg-8">
                <div class="row">
                    <div class="input-group mb-5">
                        <span class="input-group-text" id="latitude"><i class="fa-solid fa-location-dot"></i></span>
                        <input wire:model="latitude" type="text" class="form-control @error('latitude') is-invalid @enderror"> 
                        @error('latitude')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror                          
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mb-6 col-lg-6">
            <label class="col-lg-4 col-form-label fw-semibold fs-6">Longitud</label>
            <div class="col-lg-8">
                <div class="row">
                    <div class="input-group mb-5">
                        <span class="input-group-text" id="longitude"><i class="fa-solid fa-location-dot"></i></span>
                        <input wire:model="longitude" type="text" class="form-control @error('longitude') is-invalid @enderror">
                        @error('longitude')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror                           
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    <div class="row mb-6">
        <label class="col-lg-2 col-form-label fw-semibold fs-6">Observaciones</label>
        <div class="col-lg-10">
            <div class="row">
                <div class="input-group mb-5">
                    <span class="input-group-text" id="observations"><i class="fa-solid fa-marker"></i></span>
                    <textarea wire:model="tree.observations" class="form-control @error('tree.latitude') is-invalid @enderror"></textarea> 
                    @error('tree.observations')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror                         
                </div>
            </div>
        </div>
    </div>                                

</div>

