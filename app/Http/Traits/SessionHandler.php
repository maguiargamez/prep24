<?php

namespace App\Http\Traits;

use App\Models\EcoUser;
use App\Models\EcoUserClient;
use App\Models\EcoUserCompany;
use App\Models\EcoUserExceptional;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

trait SessionHandler
{

    public function setFilters($routeName, $filters)
    {       
        $this->clearFilters($routeName);
        $arrayFilters= [];
        foreach ($filters as $value) {
            $arrayFilters[$value]= $this->{$value};
            
        } 
        
        $array= session($routeName);        
        $array= Arr::add($array, 'filters', $arrayFilters);

        session([
            $routeName=>$array
        ]);
        //dd(session($routeName));
        
    }

    public function getFilters($routeName, $filters)
    {        
        if(session($routeName.'.filters')){
            
            foreach ($filters as $value) {
                $this->$value= session($routeName.'.filters.'.$value);
                //dd(session($this->currentRouteName)['filters'][$value]);
            }
            
        } 
        //dd(session($routeName));
    }

    public function clearFilters($routeName)
    {    
        session()->forget($routeName.'.filters'); 
    }



}