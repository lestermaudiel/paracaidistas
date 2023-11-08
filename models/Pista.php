<?php

namespace Model;

class Pista extends ActiveRecord
{
    public static $tabla = 'par_pista'; 
    public static $columnasDB = ['pista_detalle', 'pista_salto_latitud', 'pista_salto_longitud', 'pista_salto_direc_latitud', 'pista_salto_direc_longitud', 'pista_situacion'];
    public static $idTabla = 'pista_id'; 

    public $pista_id;
    public $pista_detalle;
    public $pista_salto_latitud;
    public $pista_salto_longitud;
    public $pista_salto_direc_latitud;
    public $pista_salto_direc_longitud;
    public $pista_situacion;

    public function __construct($args = [])
    {
        $this->pista_id = $args['pista_id'] ?? null;
        $this->pista_detalle = $args['pista_detalle'] ?? '';
        $this->pista_salto_latitud = $args['pista_salto_latitud'] ?? null;
        $this->pista_salto_longitud = $args['pista_salto_longitud'] ?? null;
        $this->pista_salto_direc_latitud = $args['pista_salto_direc_latitud'] ?? '';
        $this->pista_salto_direc_longitud = $args['pista_salto_direc_longitud'] ?? '';
        $this->pista_situacion = $args['pista_situacion'] ?? '1';
    }
}
