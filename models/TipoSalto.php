<?php


namespace Model;

class TipoSalto extends ActiveRecord
{
    public static $tabla = 'par_tipo_salto';
    public static $columnasDB = ['tipo_salto_detalle', 'tipo_salto_situacion'];
    public static $idTabla = 'tipo_salto_id';

    public $tipo_salto_id;
    public $tipo_salto_detalle;
    public $tipo_salto_situacion;

    public function __construct($args = [])
    {
        $this->tipo_salto_id = $args['tipo_salto_id'] ?? null;
        $this->tipo_salto_detalle = $args['tipo_salto_detalle'] ?? '';
        $this->tipo_salto_situacion = $args['tipo_salto_situacion'] ?? '1';
    }
}
public function getPeTipoSalto(){
    $sql = "SELECT * from par_tipo_salto where tipo_salto_situacion = 1";
    return $this->fetchArray($sql);
}