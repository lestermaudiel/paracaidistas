<?php

namespace Model;

class ZonaSalto extends ActiveRecord
{
    public static $tabla = 'par_zona_salto';
    public static $columnasDB = ['zona_salto_nombre', 'zona_salto_latitud', 'zona_salto_longitud', 'zona_salto_direc_latitud', 'zona_salto_direc_longitud', 'zona_salto_situacion'];
    public static $idTabla = 'zona_salto_id';

    public $zona_salto_id;
    public $zona_salto_nombre;
    public $zona_salto_latitud;
    public $zona_salto_longitud;
    public $zona_salto_direc_latitud;
    public $zona_salto_direc_longitud;
    public $zona_salto_situacion;

    public function __construct($args = [])
    {
        $this->zona_salto_id = $args['zona_salto_id'] ?? null;
        $this->zona_salto_nombre = $args['zona_salto_nombre'] ?? '';
        $this->zona_salto_latitud = $args['zona_salto_latitud'] ?? null;
        $this->zona_salto_longitud = $args['zona_salto_longitud'] ?? null;
        $this->zona_salto_direc_latitud = $args['zona_salto_direc_latitud'] ?? '';
        $this->zona_salto_direc_longitud = $args['zona_salto_direc_longitud'] ?? '';
        $this->zona_salto_situacion = $args['zona_salto_situacion'] ?? '1';
    }
}
