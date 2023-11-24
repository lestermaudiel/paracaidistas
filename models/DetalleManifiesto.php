<?php

namespace Model;

class DetalleManifiesto extends ActiveRecord
{
    public static $tabla = 'par_detalle_manifiesto';
    public static $columnasDB = [
   
    'detalle_mani_id' ,
    'detalle_paracaidista' ,
    'detalle_paracaidas' ,
    'detalle_altimetro' 
    ];
    public static $idTabla = 'detalle_id';

    public $detalle_id;
    public $detalle_mani_id;
    public $detalle_paracaidista;
    public $detalle_paracaidas;
    public $detalle_altimetro;

    public function __construct($args = [])
    {
        $this->detalle_id = $args['detalle_id'] ?? null;
        $this->detalle_mani_id = $args['detalle_mani_id'] ?? '';
        $this->detalle_paracaidista = $args['detalle_paracaidista'] ?? null;
        $this->detalle_paracaidas = $args['detalle_paracaidas'] ?? null;
        $this->detalle_altimetro = $args['detalle_altimetro'] ?? null;
    }
}
