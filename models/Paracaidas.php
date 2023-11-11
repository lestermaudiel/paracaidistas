<?php

namespace Model;

class Paracaidas extends ActiveRecord
{
    public static $tabla = 'par_paracaidas';
    public static $columnasDB = ['paraca_tipo', 'paraca_cupula', 'paraca_arnes', 'paraca_fecha_fabricacion', 'paraca_fecha_caducidad', 'paraca_saltos_total', 'paraca_saltos_uso', 'paraca_situacion'];
    public static $idTabla = 'paraca_id';

    public $paraca_id;
    public $paraca_tipo;
    public $paraca_cupula;
    public $paraca_arnes;
    public $paraca_fecha_fabricacion;
    public $paraca_fecha_caducidad;
    public $paraca_saltos_total;
    public $paraca_saltos_uso;
    public $paraca_situacion;

    public function __construct($args = [])
    {
        $this->paraca_id = $args['paraca_id'] ?? null;
        $this->paraca_tipo = $args['paraca_tipo'] ?? null;
        $this->paraca_cupula = $args['paraca_cupula'] ?? '';
        $this->paraca_arnes = $args['paraca_arnes'] ?? '';
        $this->paraca_fecha_fabricacion = $args['paraca_fecha_fabricacion'] ?? null;
        $this->paraca_fecha_caducidad = $args['paraca_fecha_caducidad'] ?? null;
        $this->paraca_saltos_total = $args['paraca_saltos_total'] ?? null;
        $this->paraca_saltos_uso = $args['paraca_saltos_uso'] ?? null;
        $this->paraca_situacion = $args['paraca_situacion'] ?? '1';
    }
}
