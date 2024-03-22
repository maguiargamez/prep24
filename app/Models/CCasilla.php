<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CCasilla extends Model
{
    use HasFactory;

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
}
