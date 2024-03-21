<?php

namespace App\Imports;

use App\Models\PollingPlace;
use App\Models\PollingPlaceTmp;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PollingPlacesImport implements ToModel, WithHeadingRow
{
    use Importable;
    public $currentDate;
    public $electionId;

    public function __construct($electionId, $date)
    {
        $this->currentDate = $date;
        $this->electionId = $electionId;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $federalDistrictKey= $federalDistrict= $localDistrictKey= $localDistrict= $municipalityKey= $municipality= $section= $sectionType= $electoralRegister= $nominalElectoralRegister= $type= $typeKey= $address= $locality= $location= $reference= $addressType= null;

        
        //dd($row['dtto_federal']);

        if (!isset($row['dtto_federal'])) {
            return null;
        }
        if (blank($row['dtto_federal'])) {
            return;
        }

        if (!isset($row['dtto_local'])) {
            return null;
        }
        if (blank($row['dtto_local'])) {
            return;
        }
        if (!isset($row['cve_municipio'])) {
            return null;
        }
        if (blank($row['cve_municipio'])) {
            return;
        }
        if (!isset($row['municipio'])) {
            return null;
        }
        if (blank($row['municipio'])) {
            return;
        }
        if (!isset($row['seccion'])) {
            return null;
        }
        if (blank($row['seccion'])) {
            return;
        }

        //dd("entre");

        $federalDistrictKey= trim($row['dtto_federal']);
        $federalDistrict= trim($row['distrito_federal']);
        $localDistrictKey= trim($row['dtto_local']);
        $localDistrict= trim($row['distrito_local']);
        $municipalityKey= trim($row['cve_municipio']);
        $municipality= trim($row['municipio']);
        $section= trim($row['seccion']);
        $sectionType= trim($row['tipo_seccion']);
        $electoralRegister= trim($row['padron_electoral']);
        $nominalElectoralRegister= trim($row['lista_nominal']);
        $type= trim($row['casilla']);
        $typeKey= trim($row['tipo_casilla']);
        $address= trim($row['domicilio']);
        $locality= trim($row['localidad']);
        $location= trim($row['ubicacion']);
        $reference= trim($row['referencias']);
        $addressType= trim($row['tipo_domicilio']); 
        
        return new PollingPlaceTmp([
            'election_id'=> $this->electionId,            
            'federal_district_key'=> $federalDistrictKey,
            'federal_district'=> $federalDistrict,
            'local_district_key'=> $localDistrictKey,
            'local_district'=> $localDistrict,
            'municipality_key'=> $municipalityKey,
            'municipality'=> $municipality,
            'section'=> $section,
            'section_type'=> $sectionType,
            'electoral_register'=> $electoralRegister,
            'nominal_electoral_register'=> $nominalElectoralRegister,
            'type'=> $type,
            'type_key'=> $typeKey,
            'address'=> $address,
            'locality'=> $locality,
            'location'=> $location,
            'reference'=> $reference,
            'address_type'=> $addressType,            
            'created_at' => $this->currentDate
        ]);               

    }
}
