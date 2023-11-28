<?php

namespace Model;

class Plantrabajo extends ActiveRecord
{
    public static $tabla = 'par_plantrabajo';
    public static $columnasDB = ['plan_codigo', 'plan_situacion'];
    public static $idTabla = 'plan_id';

    public $plan_id;
    public $plan_codigo;
    public $plan_situacion;

    public function __construct($args = [])
    {
        $this->plan_id = $args['plan_id'] ?? null;
        $this->plan_codigo = $args['plan_codigo'] ?? '';
        $this->plan_situacion = $args['plan_situacion'] ?? '1';
    }


    public function getPlantrabajo(){
        $sql = "SELECT * FROM par_plantrabajo WHERE plan_situacion = 1";
        return $this->fetchArray($sql);
    }
}
