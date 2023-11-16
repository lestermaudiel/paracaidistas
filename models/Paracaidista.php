<?php

namespace Model;

class Paracaidista extends ActiveRecord
{
    public static $tabla = 'par_paracaidista';
    public static $columnasDB = ['paraca_codigo', 'paraca_civil_dpi',  'paraca_situacion'];
    public static $idTabla = 'paraca_id';

    public $paraca_id;
    public $paraca_codigo;
    public $paraca_civil_dpi;
   
    public $paraca_situacion;

    public function __construct($args = [])
    {
        $this->paraca_id = $args['paraca_id'] ?? null;
        $this->paraca_codigo = $args['paraca_codigo'] ?? null;
        $this->paraca_civil_dpi = $args['paraca_civil_dpi'] ?? null;
        $this->paraca_situacion = $args['paraca_situacion'] ?? 1;
    }
}
