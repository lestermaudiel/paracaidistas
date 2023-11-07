<?php

namespace Model;

class Altimetro extends ActiveRecord
{
    public static $tabla = 'par_altimetro';
    public static $columnasDB = ['altimetro_serie', 'altimetro_situacion'];
    public static $idTabla = 'altimetro_id';

    public $altimetro_id;
    public $altimetro_serie;
    public $altimetro_situacion;

    public function __construct($args = [])
    {
        $this->altimetro_id = $args['altimetro_id'] ?? null;
        $this->altimetro_serie = $args['altimetro_serie'] ?? '';
        $this->altimetro_situacion = $args['altimetro_situacion'] ?? '1';
    }
}
