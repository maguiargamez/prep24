<?php

namespace App\Http\Controllers\API\Prep\PollingPlaces;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Ranger\LoginRequest;
use Illuminate\Http\Request;

use App\Http\Traits\ApiResponser;
use App\Models\CCasilla;
use App\Models\PrepPollingPlaceRecord;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRanger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RecordsController extends Controller
{
    use ApiResponser;

    private function validateUser(User $user, $roles){
        if(!$user->hasRole($roles)){
            return false;
        }  
        return true;    
    }

    private function existsUserIdField($request){
        if(!$request->exists('id_usuario')){
            return false;
        }
        return true;
    }

    private function existsPollinPlaceIdField($request){
        if(!$request->exists('id_casilla')){
            return false;
        }
        return true;
    }

    public function getDistricts(Request $request){  
        $roles= ['admin', 'coordinador_general', 'prep'];      
        if(!$this->existsUserIdField($request)){
            return $this->error("Se necesita especificar el usuario(id_usuario)", 401);
        }       
        
        try {
            $user= User::find($request->input('id_usuario'));
            if(!$this->validateUser($user, $roles)){
                return $this->error("Acceso denegado: el usuario no cuenta con el rol requerido", 401);
            } 

            $districts= CCasilla::getDistricts();
            return $this->success([
                "Total"=> count($districts),
                "Distritos"=>$districts
            ], 'Lista de distritos');
        } catch (\Exception  $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function getMunicipalities(Request $request){  
        $roles= ['admin', 'coordinador_general', 'prep', 'coordinador_distrital'];      
        if(!$this->existsUserIdField($request)){
            return $this->error("Se necesita especificar el usuario(id_usuario)", 401);
        }       
        
        try {
            $user= User::find($request->input('id_usuario'));
            if(!$this->validateUser($user, $roles)){
                return $this->error("Acceso denegado: el usuario no cuenta con el rol requerido", 401);
            } 

            $municipalities= CCasilla::getMunicipalities($user);
            return $this->success([
                "Total"=> count($municipalities),
                "Municipios"=>$municipalities
            ], 'Lista de municipios');
        } catch (\Exception  $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function getSections(Request $request){  
        $roles= ['admin', 'coordinador_general', 'prep', 'coordinador_distrital', 'coordinador_municipal'];      
        if(!$this->existsUserIdField($request)){
            return $this->error("Se necesita especificar el usuario(id_usuario)", 401);
        }       
        
        try {
            $user= User::find($request->input('id_usuario'));
            if(!$this->validateUser($user, $roles)){
                return $this->error("Acceso denegado: el usuario no cuenta con el rol requerido", 401);
            } 

            $sections= CCasilla::getSections($user, $request);
            return $this->success([
                "Total"=> count($sections),
                "Secciones"=>$sections
            ], 'Lista de secciones');
        } catch (\Exception  $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function withOutRecords(Request $request){
        $roles= ['admin', 'coordinador_general', 'prep', 'coordinador_distrital', 'coordinador_municipal', 'coordinador_seccional'];      
        if(!$this->existsUserIdField($request)){
            return $this->error("Se necesita especificar el usuario(id_usuario)", 401);
        } 

        try {
            $user= User::find($request->input('id_usuario'));
            if(!$this->validateUser($user, $roles)){
                return $this->error("Acceso denegado: el usuario no cuenta con el rol requerido", 401);
            } 

            $polingPlaces= CCasilla::withOutRecords($user, $request);
            return $this->success([
                "Total"=> count($polingPlaces),
                "Casillas"=>$polingPlaces
            ], 'Lista de casillas pendientes de capturar/digitalizar');
        } catch (\Exception  $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function digitizedRecords(Request $request){
        $roles= ['admin', 'coordinador_general', 'prep', 'coordinador_distrital', 'coordinador_municipal', 'coordinador_seccional'];      
        if(!$this->existsUserIdField($request)){
            return $this->error("Se necesita especificar el usuario(id_usuario)", 401);
        } 
        try {

            $user= User::find($request->input('id_usuario'));
            if(!$this->validateUser($user, $roles)){
                return $this->error("Acceso denegado: el usuario no cuenta con el rol requerido", 401);
            } 
            $polingPlaces= CCasilla::digitizedRecords($user, $request);
            return $this->success([
                "Total"=> count($polingPlaces),
                "Casillas"=>$polingPlaces
            ], 'Lista de casillas pendientes de capturar/digitalizar');
        } catch (\Exception  $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function pollingPlaceDetail(Request $request){
        $roles= ['admin', 'coordinador_general', 'prep', 'coordinador_distrital', 'coordinador_municipal', 'coordinador_seccional'];      
        if(!$this->existsUserIdField($request)){
            return $this->error("Se necesita especificar el usuario(id_usuario)", 401);
        } 
        try {
            $user= User::find($request->input('id_usuario'));
            if(!$this->validateUser($user, $roles)){
                return $this->error("Acceso denegado: el usuario no cuenta con el rol requerido", 401);
            } 
            if(!$this->existsPollinPlaceIdField($request)){
                return $this->error("Se necesita especificar la casilla(id_casilla)", 401);
            } 
            $polingPlace= CCasilla::detail($request->input('id_casilla'));
            return $this->success([
                "Casilla"=>$polingPlace
            ], 'Detalle de la casilla ');
        } catch (\Exception  $e) {
            return $this->error($e->getMessage(), 500);
        }

    }

    public function saveDigitizedRecord(Request $request){
        $roles= ['admin', 'coordinador_general', 'prep', 'coordinador_distrital', 'coordinador_municipal', 'coordinador_seccional'];      
        if(!$this->existsUserIdField($request)){
            return $this->error("Se necesita especificar el usuario(id_usuario)", 401);
        }
        try {

            $user= User::find($request->input('id_usuario'));
            if(!$this->validateUser($user, $roles)){
                return $this->error("Acceso denegado: el usuario no cuenta con el rol requerido", 401);
            } 

            DB::beginTransaction();

            $pollingPlaceId= $request->input('id_casilla');            
            $digitizedRecord= $request->input('acta_base64');
            $path= "actas/casilla".$pollingPlaceId.".jpeg";
            
            if($this->reverBase64($digitizedRecord, $path))
            {
                $prepPollingPlaceRecord= new PrepPollingPlaceRecord();
                $prepPollingPlaceRecord->prep_election_id= 1;
                $prepPollingPlaceRecord->c_casilla_id= $pollingPlaceId;
                $prepPollingPlaceRecord->digitized_record= $path;
                $prepPollingPlaceRecord->votes_matched_urn= false;
                $prepPollingPlaceRecord->votes_matched= false;
                $prepPollingPlaceRecord->is_captured= false;
                $prepPollingPlaceRecord->is_validated= false;
                $prepPollingPlaceRecord->capture_source= 2;
                $prepPollingPlaceRecord->save();

            }else{
                return $this->error('El acta no ha podido ser digitalizada', 500);
            }
            DB::commit();

            $polingPlaceDetail= CCasilla::detail($pollingPlaceId);
            return $this->success([
                "Casilla"=>$polingPlaceDetail
            ], 'Acta digitalizada correctamente');
        } catch (\Exception  $e) {
            DB::rollback();
            return $this->error($e->getMessage(), 500);
        }
    }

    private function reverBase64($base64, $path){
        try{
            $base64Image= "data:image/jpeg;base64,".$base64;
            if(preg_match('/^data:image\/(\w+);base64,/', $base64Image)) {
                $substrBase64Image = substr($base64Image, strpos($base64Image, ',') + 1);
                Storage::disk('local')->put($path, base64_decode($substrBase64Image));  
                return true;
            }            
        }catch (\Exception  $e) {
            return false;
        }
        return false;

    }
}
