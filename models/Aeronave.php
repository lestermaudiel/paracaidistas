<?php

namespace Model;

class Aeronave extends ActiveRecord
{
    public static $tabla = 'fag_tip_aeronave';
    public static $columnasDB = ['aer_desc_aeronave', 'aer_tip_ala', 'aer_tip_situacion'];
    public static $idTabla = 'aer_tip_registro';

    public $aer_tip_registro;
    public $aer_desc_aeronave;
    public $aer_tip_ala;
    public $aer_tip_situacion;

    public function __construct($args = [])
    {
        $this->aer_tip_registro = $args['aer_tip_registro'] ?? null;
        $this->aer_desc_aeronave = $args['aer_desc_aeronave'] ?? '';
        $this->aer_tip_ala = $args['aer_tip_ala'] ?? '';
        $this->aer_tip_situacion = $args['aer_tip_situacion'] ?? '1';
    }
}
