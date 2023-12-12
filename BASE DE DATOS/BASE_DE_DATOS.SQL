-- Tabla: par_tipo_paracaidas
CREATE TABLE par_tipo_paracaidas (
    tipo_par_id SERIAL PRIMARY KEY,
    tipo_par_descripcion VARCHAR(100),
    tipo_par_situacion SMALLINT DEFAULT 1
);



-- Tabla: par_paracaidas
CREATE TABLE par_paracaidas (
    paraca_id SERIAL PRIMARY KEY,
    paraca_tipo INTEGER REFERENCES par_tipo_paracaidas(tipo_par_id),
    paraca_cupula VARCHAR(100),
    paraca_arnes VARCHAR(100),
    paraca_fecha_fabricacion DATE NOT NULL,
    paraca_fecha_caducidad DATE NOT NULL,
    paraca_saltos_total INT,
    paraca_saltos_uso INT,
    paraca_descripcion LVARCHAR (350),
    paraca_estado VARCHAR (100),
    paraca_situacion SMALLINT DEFAULT 1
);


CREATE TABLE par_aeronave(
    aer_tip_registro SERIAL PRIMARY KEY,
    aer_desc_aeronave VARCHAR(50),
    aer_tip_ala VARCHAR(50),
    aer_tip_situacion CHAR(1)
)


-- Tabla: par_tipo_salto
CREATE TABLE par_tipo_salto (
    tipo_salto_id SERIAL PRIMARY KEY,
    tipo_salto_detalle VARCHAR(100),
    tipo_salto_situacion SMALLINT DEFAULT 1
);



-- Tabla: par_zona_salto
CREATE TABLE par_zona_salto (
    zona_salto_id SERIAL PRIMARY KEY,
    zona_salto_nombre VARCHAR(100),
    zona_salto_latitud DECIMAL(9,6),
    zona_salto_longitud DECIMAL(9,6),
    zona_salto_direc_latitud CHAR(1),
    zona_salto_direc_longitud CHAR(1),
    zona_salto_situacion SMALLINT DEFAULT 1
);

-- Tabla: mdep
CREATE TABLE mdep (
    dep_llave SMALLINT PRIMARY KEY,
    dep_desc_lg CHAR(100),
    dep_desc_md CHAR(35),
    dep_desc_ct CHAR(15)
);

-- Tabla: grado
CREATE TABLE grados (
    gra_codigo SMALLINT PRIMARY KEY,
    gra_desc_md CHAR(15),
    gra_desc_ct CHAR(8)
);

-- Tabla: arma
CREATE TABLE armas (
    arm_codigo SMALLINT PRIMARY KEY,
    arm_desc_md CHAR(15)
);

-- Tabla: par_altimetro  LA MODIFIQUE LE AGREGUE MARCA
CREATE TABLE par_altimetro (
    altimetro_id SERIAL PRIMARY KEY,
    altimetro_serie VARCHAR(100),
    altimetro_marca VARCHAR(100),
    altimetro_situacion SMALLINT DEFAULT 1
);

-- Tabla: mper (Personal Militar)
CREATE TABLE mper (
    per_catalogo INTEGER PRIMARY KEY,
    per_nom1 CHAR(15),
    per_nom2 CHAR(15),
    per_ape1 CHAR(15),
    per_ape2 CHAR(15),
    per_grado SMALLINT REFERENCES grados(gra_codigo),
    per_arma SMALLINT REFERENCES armas(arm_codigo),
    per_tipo SMALLINT DEFAULT 1
);

-- Tabla: par_pista
CREATE TABLE par_pista (
    pista_id SERIAL PRIMARY KEY,
    pista_detalle VARCHAR(100),
    pista_salto_latitud DECIMAL(9,6),
    pista_salto_longitud DECIMAL(9,6),
    pista_salto_direc_latitud CHAR(1),
    pista_salto_direc_longitud CHAR(1),
    pista_situacion SMALLINT DEFAULT 1
);

-- Tabla: paraca_paracaidistas_civil (Para paracaidistas civiles)
CREATE TABLE par_paraca_civil (
    paraca_civil_dpi bigint PRIMARY KEY,
    paraca_civil_nom1 VARCHAR(100),
    paraca_civil_nom2 VARCHAR(100),
    paraca_civil_ape1 VARCHAR(100),
    paraca_civil_ape2 VARCHAR(100),
    paraca_civil_tel VARCHAR(15),
    paraca_civil_direc VARCHAR(100),
    paraca_civil_email VARCHAR(100),
    paraca_civil_situacion SMALLINT DEFAULT 1
);


CREATE TABLE par_paracaidista (
    paraca_id SERIAL PRIMARY KEY,
    paraca_codigo INTEGER REFERENCES mper(per_catalogo), 
    paraca_civil_dpi BIGINT REFERENCES par_paraca_civil(paraca_civil_dpi),
    paraca_situacion SMALLINT DEFAULT 1,
    paraca_fecha_graduacion DATE
);


CREATE TABLE par_plantrabajo(
  plan_id SERIAL PRIMARY KEY,
  plan_codigo VARCHAR(100),
  plan_situacion SMALLINT DEFAULT 1
);

CREATE TABLE par_manifiesto (
    mani_id SERIAL PRIMARY KEY,
    mani_plan_trabajo INTEGER REFERENCES par_plantrabajo (plan_id),
    mani_no_avion INTEGER,
    mani_no_vuelo INTEGER,
    mani_tipo_salto INTEGER REFERENCES par_tipo_salto(tipo_salto_id),
    mani_tipo_aeronave INTEGER REFERENCES par_aeronave(aer_tip_registro),   
    mani_zona_salto INTEGER REFERENCES par_zona_salto(zona_salto_id),
    mani_fecha DATE,
    mani_despegue INTEGER REFERENCES par_pista(pista_id),
    mani_aterrizaje INTEGER REFERENCES par_pista(pista_id),
    mani_altura INTEGER,
    mani_jefe INTEGER REFERENCES mper(per_catalogo),
    mani_unidad SMALLINT REFERENCES mdep(dep_llave),
    mani_observacion VARCHAR(255),
    mani_situacion SMALLINT DEFAULT 1
    mani_retardo INTEGER,
    mani_maniobra VARCHAR(100),
    mani_distancia_blanco VARCHAR(100),
    mani_viento_superficie VARCHAR(100)
);

--tabla par_detalle_manifiesto con llave primaria compuesta
CREATE TABLE par_detalle_manifiesto (
    detalle_id SERIAL,
    detalle_mani_id INTEGER REFERENCES par_manifiesto(mani_id),
    detalle_paracaidista INTEGER REFERENCES par_paracaidista(paraca_id),
    detalle_paracaidas INTEGER REFERENCES par_paracaidas(paraca_id),
    detalle_altimetro INTEGER REFERENCES par_altimetro(altimetro_id),
    detalle_stick INTEGER,
   PRIMARY KEY (detalle_id, detalle_mani_id)  
);
