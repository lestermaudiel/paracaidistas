<?php

namespace Model;

class Civil extends ActiveRecord
{
    public static $tabla = 'par_paraca_civil';
    public static $columnasDB = [
        'paraca_civil_dpi',
        'paraca_civil_nom1',
        'paraca_civil_nom2',
        'paraca_civil_ape1',
        'paraca_civil_ape2',
        'paraca_civil_direc',
        'paraca_civil_tel',
        'paraca_civil_email',
        'paraca_civil_situacion'
    ];
    public static $idTabla = 'paraca_civil_dpi';

    public $paraca_civil_dpi;
    public $paraca_civil_nom1;
    public $paraca_civil_nom2;
    public $paraca_civil_ape1;
    public $paraca_civil_ape2;
    public $paraca_civil_direc;
    public $paraca_civil_tel;
    public $paraca_civil_email;
    public $paraca_civil_situacion;

    public function __construct($args = [])
    {
        $this->paraca_civil_dpi = $args['paraca_civil_dpi'] ?? '';
        $this->paraca_civil_nom1 = $args['paraca_civil_nom1'] ?? '';
        $this->paraca_civil_nom2 = $args['paraca_civil_nom2'] ?? '';
        $this->paraca_civil_ape1 = $args['paraca_civil_ape1'] ?? '';
        $this->paraca_civil_ape2 = $args['paraca_civil_ape2'] ?? '';
        $this->paraca_civil_direc = $args['paraca_civil_direc'] ?? '';
        $this->paraca_civil_tel = $args['paraca_civil_tel'] ?? '';
        $this->paraca_civil_email = $args['paraca_civil_email'] ?? '';
        $this->paraca_civil_situacion = $args['paraca_civil_situacion'] ?? '1';
    }
}
