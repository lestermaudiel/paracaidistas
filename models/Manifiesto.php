<?php

namespace Model;

class Manifiesto extends ActiveRecord
{
    public static $tabla = 'par_manifiesto';
    public static $columnasDB = [
        'mani_plan_trabajo',
        'mani_paraca_cod',
        'mani_no_avion',
        'mani_no_vuelo',
        'mani_tipo_salto',
        'mani_tipo_aeronave',
        'mani_zona_salto',
        'mani_fecha',
        'mani_despegue',
        'mani_aterrizaje',
        'mani_altura',
        'mani_jefe',
        'mani_unidad',
        'mani_grado',
        'mani_paracaidas',
        'mani_altimetro',
        'mani_situacion',
    ];
    public static $idTabla = 'mani_id';

    public $mani_id;
    public $mani_plan_trabajo;
    public $mani_paraca_cod;
    public $mani_no_avion;
    public $mani_no_vuelo;
    public $mani_tipo_salto;
    public $mani_tipo_aeronave;
    public $mani_zona_salto;
    public $mani_fecha;
    public $mani_despegue;
    public $mani_aterrizaje;
    public $mani_altura;
    public $mani_jefe;
    public $mani_unidad;
    public $mani_grado;
    public $mani_paracaidas;
    public $mani_altimetro;
    public $mani_situacion;

    public function __construct($args = [])
    {
        $this->mani_id = $args['mani_id'] ?? null;
        $this->mani_plan_trabajo = $args['mani_plan_trabajo'] ?? '';
        $this->mani_paraca_cod = $args['mani_paraca_cod'] ?? null;
        $this->mani_no_avion = $args['mani_no_avion'] ?? null;
        $this->mani_no_vuelo = $args['mani_no_vuelo'] ?? null;
        $this->mani_tipo_salto = $args['mani_tipo_salto'] ?? null;
        $this->mani_tipo_aeronave = $args['mani_tipo_aeronave'] ?? null;
        $this->mani_zona_salto = $args['mani_zona_salto'] ?? null;
        $this->mani_fecha = $args['mani_fecha'] ?? null;
        $this->mani_despegue = $args['mani_despegue'] ?? null;
        $this->mani_aterrizaje = $args['mani_aterrizaje'] ?? null;
        $this->mani_altura = $args['mani_altura'] ?? null;
        $this->mani_jefe = $args['mani_jefe'] ?? null;
        $this->mani_unidad = $args['mani_unidad'] ?? null;
        $this->mani_grado = $args['mani_grado'] ?? null;
        $this->mani_paracaidas = $args['mani_paracaidas'] ?? null;
        $this->mani_altimetro = $args['mani_altimetro'] ?? null;
        $this->mani_situacion = $args['mani_situacion'] ?? 1;
    }
}