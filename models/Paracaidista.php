<?php

namespace Model;

class Paracaidista extends ActiveRecord
{
    public static $tabla = 'par_paracaidista';
    public static $columnasDB = ['paraca_codigo', 'paraca_civil_dpi', 'paraca_saltos'];
    public static $idTabla = 'paraca_id';

    public $paraca_id;
    public $paraca_codigo;
    public $paraca_civil_dpi;
    public $paraca_saltos;

    public function __construct($args = [])
    {
        $this->paraca_id = $args['paraca_id'] ?? null;
        $this->paraca_codigo = $args['paraca_codigo'] ?? null;
        $this->paraca_civil_dpi = $args['paraca_civil_dpi'] ?? '';
        $this->paraca_saltos = $args['paraca_saltos'] ?? 0;
    }
}
