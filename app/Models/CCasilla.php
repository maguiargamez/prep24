<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CCasilla extends Model
{
    use HasFactory;


    public static function getCaptureRecords($electionId=null){
        $query= PrepPollingPlaceRecord::where('is_captured', true)->whereNotNull('digitized_record')->count();
        return $query;
    }

    public static function getTotalRecords($electionId=null){
        $query= CCasilla::count();
        return $query;
    }    

    public static function getDistrictsComboRoman($municipalityKey=null, $electionId=null){
        $districts= CCasilla::select(
            DB::raw("CAST(c_casillas.dtto_loc AS UNSIGNED) as dtto_loc"),
            'dtto_loc as district'
            );

        if($municipalityKey){
            $districts= $districts->where('c_casillas.id_municipio', $municipalityKey);
        }

        $districts= $districts    
            ->groupBy('dtto_loc')
            ->orderBy('dtto_loc', 'asc')
            ->pluck('district', 'dtto_loc');

        foreach($districts as $key=>$dist){            
            //$districts[$key]= "Distrito ".Convertion::toRoman((int)$dist);
            $districts[$key]= "Distrito ".(int)$dist;
        }

        return $districts;
    }

    public static function getMunicipalitiesCombo($electionId=null){
        $municipalities= CCasilla::select(
            'id_municipio',
            'c_municipio.municipio',            
            )
            ->leftJoin('c_municipio', 'c_municipio.id', '=', 'c_casillas.id_municipio')
            ->groupBy('id_municipio')
            ->orderBy('id_municipio', 'asc')
            ->pluck('municipio', 'id_municipio');

        return $municipalities;
    }

    public static function getSectionsCombo($municipalityKey=null, $district=null, $electionId=null){
        $sections= CCasilla::select(
            DB::raw("CAST(c_casillas.seccion AS UNSIGNED) as seccion"),
            DB::raw('concat( "Sección ", c_casillas.seccion) as section_desc')
            
            );

        if($municipalityKey){
            $sections= $sections->where('c_casillas.id_municipio', $municipalityKey);
        }

        if($district){
            //$sections= $sections->where('c_casillas.dtto_loc', '', $district);
            $sections= $sections->where(DB::raw('CONVERT(c_casillas.dtto_loc,UNSIGNED INTEGER)'), $district);
        }

        $sections= $sections    
            ->groupBy('seccion')
            ->orderBy('seccion', 'asc')
            ->pluck('section_desc', 'seccion');

        return $sections;
    }

    //################### API ###################  
    
    public static function withOutRecords(User $user, $request=null){
        $pollingPlaces= CCasilla::select(
            'c_casillas.id as id_casilla',
            'c_casillas.dtto_loc as distrito_local',
            'c_casillas.id_municipio',
            'c_municipio.municipio',   
            'c_casillas.seccion',
            'c_casillas.tipo_casilla',
            'c_casillas.casilla',
            'c_casillas.ubicacion'
        )
        ->leftJoin('prep_polling_place_records as records', 'records.c_casilla_id', '=', 'c_casillas.id')
        ->leftJoin('c_municipio', 'c_municipio.id', '=', 'c_casillas.id_municipio')
        ->where(function($query){
            $query->whereNull('records.id')->orWhereNull('records.digitized_record');
        });

        $user2= User::getUserData($user->id);
        if($user->hasRole('coordinador_distrital')){            
            $pollingPlaces= $pollingPlaces->where('c_casillas.dtto_loc', $user2->distrito_local);
        }

        if($user->hasRole('coordinador_municipal')){
            $pollingPlaces= $pollingPlaces
            ->where('c_casillas.dtto_loc', $user2->distrito_local)
            ->where('c_casillas.id_municipio', $user2->id_municipio)
            ;
        }

        if($user->hasRole('coordinador_seccional')){
            $pollingPlaces= $pollingPlaces
            ->where('c_casillas.dtto_loc', $user2->distrito_local)
            ->where('c_casillas.id_municipio', $user2->id_municipio)
            ->where('c_casillas.seccion', $user2->seccion)
            ;
        }

        if($request->exists('distrito_local')){
            $pollingPlaces= $pollingPlaces->where('c_casillas.dtto_loc', $request->input('distrito_local'));
        }

        if($request->exists('id_municipio')){
            $pollingPlaces= $pollingPlaces->where('c_casillas.id_municipio', $request->input('id_municipio'));
        }

        if($request->exists('seccion')){
            $pollingPlaces= $pollingPlaces->where('c_casillas.seccion', $request->input('seccion'));
        }


        $pollingPlaces= $pollingPlaces->get();
        return $pollingPlaces;
    }

    public static function digitizedRecords(User $user, $request=null){
        $pollingPlaces= CCasilla::select(
            'c_casillas.id as id_casilla',
            'c_casillas.dtto_loc as distrito_local',
            'c_casillas.id_municipio',
            'c_municipio.municipio',   
            'c_casillas.seccion',
            'c_casillas.tipo_casilla',
            'c_casillas.casilla',
            'c_casillas.ubicacion',
            'records.digitized_record as acta',
        )
        ->leftJoin('prep_polling_place_records as records', 'records.c_casilla_id', '=', 'c_casillas.id')
        ->leftJoin('c_municipio', 'c_municipio.id', '=', 'c_casillas.id_municipio')
        ->where(function($query){
            $query->whereNotNull('records.id')->whereNotNull('records.digitized_record');
        });

        $user2= User::getUserData($user->id);
        if($user->hasRole('coordinador_distrital')){            
            $pollingPlaces= $pollingPlaces->where('c_casillas.dtto_loc', $user2->distrito_local);
        }

        if($user->hasRole('coordinador_municipal')){
            $pollingPlaces= $pollingPlaces
            ->where('c_casillas.dtto_loc', $user2->distrito_local)
            ->where('c_casillas.id_municipio', $user2->id_municipio)
            ;
        }

        if($user->hasRole('coordinador_seccional')){
            $pollingPlaces= $pollingPlaces
            ->where('c_casillas.dtto_loc', $user2->distrito_local)
            ->where('c_casillas.id_municipio', $user2->id_municipio)
            ->where('c_casillas.seccion', $user2->seccion)
            ;
        }

        if($request->exists('distrito_local')){
            $pollingPlaces= $pollingPlaces->where('c_casillas.dtto_loc', $request->input('distrito_local'));
        }

        if($request->exists('id_municipio')){
            $pollingPlaces= $pollingPlaces->where('c_casillas.id_municipio', $request->input('id_municipio'));
        }

        if($request->exists('seccion')){
            $pollingPlaces= $pollingPlaces->where('c_casillas.seccion', $request->input('seccion'));
        }

        $pollingPlaces= $pollingPlaces->get();
        return $pollingPlaces;
    }

    public static function getDistricts(){
        $districts= CCasilla::select(
            'dtto_loc as distrito_local'
        )
        ->groupBy('dtto_loc')
        ->orderBy('dtto_loc', 'asc')
        ->pluck('distrito_local')
        ;

        return $districts;
    }

    public static function getMunicipalities(User $user, $request=null){
        $municipalities= CCasilla::select(
            'c_casillas.dtto_loc as distrito_local',
            'c_casillas.id_municipio',
            'c_municipio.municipio',
        )
        ->leftJoin('c_municipio', 'c_municipio.id', '=', 'c_casillas.id_municipio')
        ;

        if($user->hasRole('coordinador_distrital')){
            $user2= User::getUserData($user->id);
            $municipalities= $municipalities->where('c_casillas.dtto_loc', $user2->distrito_local);
        }

        if($request->exists('distrito_local')){
            $municipalities= $municipalities->where('c_casillas.dtto_loc', $request->input('distrito_local'));
        }
        
        $municipalities= $municipalities->groupBy('c_casillas.id_municipio')
        ->orderBy('c_casillas.id_municipio', 'asc')
        ->get()
        ;
        return $municipalities;
    }

    public static function getSections(User $user, $request=null){
        $user2= User::getUserData($user->id);

        $sections= CCasilla::select(
            'c_casillas.dtto_loc as distrito_local',
            'c_casillas.id_municipio',
            'c_municipio.municipio',
            'c_casillas.seccion',
        )
        ->leftJoin('c_municipio', 'c_municipio.id', '=', 'c_casillas.id_municipio')
        ;        

        if($user->hasRole('coordinador_distrital')){            
            $sections= $sections->where('c_casillas.dtto_loc', $user2->distrito_local);
        }

        if($user->hasRole('coordinador_municipal')){
            $sections= $sections
            ->where('c_casillas.dtto_loc', $user2->distrito_local)
            ->where('c_casillas.id_municipio', $user2->id_municipio)
            ;
        }

        if($request->exists('id_municipio')){
            $sections= $sections->where('c_casillas.id_municipio', $request->input('id_municipio'));
        }
        
        $sections= $sections->groupBy('c_casillas.seccion')
        ->orderBy('c_casillas.seccion', 'asc')
        ->get()
        ;
        return $sections;
    }

    public static function detail($id){
        $pollingPlaces= CCasilla::select(
            'c_casillas.id as id_casilla',
            'c_casillas.dtto_loc as distrito_local',
            'c_casillas.id_municipio',
            'c_municipio.municipio',   
            'c_casillas.seccion',
            'c_casillas.tipo_casilla',
            'c_casillas.casilla',
            'c_casillas.domicilio',
            'c_casillas.localidad_mz',
            'c_casillas.ubicacion',
            'c_casillas.referencia',
            'c_casillas.tipo_domicilio',
            'c_casillas.padron_electoral',
            'c_casillas.lista_nominal',
            'records.digitized_record as acta',
        )
        ->leftJoin('prep_polling_place_records as records', 'records.c_casilla_id', '=', 'c_casillas.id')
        ->leftJoin('c_municipio', 'c_municipio.id', '=', 'c_casillas.id_municipio')
        ->where('c_casillas.id', $id);  

        $pollingPlaces= $pollingPlaces->first();
        return $pollingPlaces;
    }

    //################# API END ################
}
