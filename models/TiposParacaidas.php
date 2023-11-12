<?php

namespace Model;

class TiposParacaidas extends ActiveRecord {
    public static $tabla = 'par_tipo_paracaidas';
    public static $columnasDB = ['tipo_par_lote', 'tipo_par_descripcion', 'tipo_par_situacion'];
    public static $idTabla = 'tipo_par_id';

    public $tipo_par_id;
    public $tipo_par_lote;
    public $tipo_par_descripcion;
    public $tipo_par_situacion;

    public function __construct($args = []) {
        $this->tipo_par_id = $args['tipo_par_id'] ?? null;
        $this->tipo_par_lote = $args['tipo_par_lote'] ?? '';
        $this->tipo_par_descripcion = $args['tipo_par_descripcion'] ?? '';
        $this->tipo_par_situacion = $args['tipo_par_situacion'] ?? '1';
    }
    public function getTipoParacaidas(){
        $sql = "SELECT * from par_tipo_paracaidas where tipo_par_situacion = 1";
        return $this->fetchArray($sql);
    }
}
