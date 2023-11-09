<?php

namespace Model;

class Civil extends ActiveRecord
{
    public static $tabla = 'paraca_paracaidistas_civil';
    public static $columnasDB = ['paracaidista_civil_dpi', 'paracaidista_civil_nombre', 'paracaidista_civil_apellidos', 'paracaidista_civil_telefono', 'paracaidista_civil_direccion', 'paracaidista_civil_correo_electronico', 'paracaidista_civil_saltos', 'paracaidista_civil_situacion'];
    public static $idTabla = 'paracaidista_civil_dpi';

    public $paracaidista_civil_dpi;
    public $paracaidista_civil_nombre;
    public $paracaidista_civil_apellidos;
    public $paracaidista_civil_telefono;
    public $paracaidista_civil_direccion;
    public $paracaidista_civil_correo_electronico;
    public $paracaidista_civil_saltos;
    public $paracaidista_civil_situacion;

    public function __construct($args = [])
    {
        $this->paracaidista_civil_dpi = $args['paracaidista_civil_dpi'] ?? null;
        $this->paracaidista_civil_nombre = $args['paracaidista_civil_nombre'] ?? '';
        $this->paracaidista_civil_apellidos = $args['paracaidista_civil_apellidos'] ?? '';
        $this->paracaidista_civil_telefono = $args['paracaidista_civil_telefono'] ?? '';
        $this->paracaidista_civil_direccion = $args['paracaidista_civil_direccion'] ?? '';
        $this->paracaidista_civil_correo_electronico = $args['paracaidista_civil_correo_electronico'] ?? '';
        $this->paracaidista_civil_saltos = $args['paracaidista_civil_saltos'] ?? 0;
        $this->paracaidista_civil_situacion = $args['paracaidista_civil_situacion'] ?? 1;
    }
}
