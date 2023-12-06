<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantenimiento de Manifiestos</title>
</head>

<body>
    <h1 class="text-center">Mantenimiento de Manifiestos</h1>
    <div class="row justify-content-center mb-5">
        <form class="col-lg-8 border bg-light p-3" id="formularioManifiesto">
            <input type="hidden" name="mani_id" id="mani_id">
            <div class="row mb-3">
                <div class="col">
                    <label for="mani_plan_trabajo">Plan de Trabajo</label>
                    <select name="mani_plan_trabajo" id="mani_plan_trabajo" class="form-control">
                        <option value="">Selecione un Tipo</option>
                        <?php foreach ($plantrabajo as $plantrabajo): ?>
                            <option value="<?= $plantrabajo['plan_id'] ?>">
                                <?= $plantrabajo['plan_codigo'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <label for="mani_no_avion">Número de Avión</label>
                    <input type="number" name="mani_no_avion" id="mani_no_avion" class="form-control">
                </div>
                <div class="col">
                    <label for="mani_no_vuelo">Número de Vuelo</label>
                    <input type="number" name="mani_no_vuelo" id="mani_no_vuelo" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="mani_tipo_salto">Tipo de Salto</label>
                    <select name="mani_tipo_salto" id="mani_tipo_salto" class="form-control">
                        <option value="">Selecione un Tipo</option>
                        <?php foreach ($tiposSalto as $tiposSalto): ?>
                            <option value="<?= $tiposSalto['tipo_salto_id'] ?>">
                                <?= $tiposSalto['tipo_salto_detalle'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col">
                    <label for="mani_tipo_aeronave">Tipo de Aeronave</label>
                    <select name="mani_tipo_aeronave" id="mani_tipo_aeronave" class="form-control">
                        <option value="">Selecione un Avion</option>
                        <?php foreach ($aeronaves as $aeronaves): ?>
                            <option value="<?= $aeronaves['aer_tip_registro'] ?>">
                                <?= $aeronaves['aer_desc_aeronave'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col">
                    <label for="mani_zona_salto">Zona de Salto</label>
                    <select name="mani_zona_salto" id="mani_zona_salto" class="form-control">
                        <option value="">Selecione Opcion</option>
                        <?php foreach ($zonasSalto as $zonasSalto): ?>
                            <option value="<?= $zonasSalto['zona_salto_id'] ?>">
                                <?= $zonasSalto['zona_salto_nombre'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="mani_fecha">Fecha</label>
                    <input type="date" name="mani_fecha" id="mani_fecha" class="form-control">
                </div>
                <div class="col">
                    <label for="mani_despegue">Despegue</label>
                    <select name="mani_despegue" id="mani_despegue" class="form-control">
                        <option value="">Selecione un Tipo</option>
                        <?php foreach ($pistas as $pistas): ?>
                            <option value="<?= $pistas['pista_id'] ?>">
                                <?= $pistas['pista_detalle'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col">
                    <label for="mani_aterrizaje">Aterrizaje</label>
                    <select name="mani_aterrizaje" id="mani_aterrizaje" class="form-control">
                        <option value="">Selecione un Tipo</option>
                        <?php foreach ($pistas2 as $pista2): ?>
                            <option value="<?= $pista2['pista_id'] ?>">
                                <?= $pista2['pista_detalle'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col">
                    <label for="mani_altura">Altura</label>
                    <input type="number" name="mani_altura" id="mani_altura" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="mani_jefe">Jefe de Salto</label>
                    <input type="input" name="mani_jefe" id="inputJefe" class="form-control">
                </div>
                <div class="col">
                    <label for="nombre_jefe">Nombre del Jefe</label>
                    <input type="input" name="nombre_jefe" id="nombre_jefe" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="mani_unidad">Unidad</label>
                    <select name="mani_unidad" id="mani_unidad" class="form-control">
                        <option value="">Selecione un Tipo</option>
                        <?php foreach ($dependencias as $dependencia): ?>
                            <option value="<?= $dependencia['dep_llave'] ?>">
                                <?= $dependencia['dep_desc_lg'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col">
                    <label for="mani_observacion">Observaciones</label>
                    <textarea name="mani_observacion" id="mani_observacion" class="form-control"></textarea>
                </div>
            </div>
            <div class="row mb-3"  id="ocultar-campos">
                <div class="col" >
                    <label for="mani_retardo">Retardo</label>
                    <input type="number" name="mani_retardo" id="mani_retardo" class="form-control">
                </div>
                <div class="col" >
                    <label for="mani_maniobra">Maniobra</label>
                    <input type="text" name="mani_maniobra" id="mani_maniobra" class="form-control">
                </div>
                <div class="col" >
                    <label for="mani_distancia_blanco">Distancia al Blanco</label>
                    <input type="text" name="mani_distancia_blanco" id="mani_distancia_blanco" class="form-control">
                </div>
                <div class="col" >
                    <label for="mani_viento_superficie">Viento en Superficie</label>
                    <input type="text" name="mani_viento_superficie" id="mani_viento_superficie" class="form-control">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="mani_situacion">Situación</label>
                    <select name="mani_situacion" id="mani_situacion" class="form-control">
                        <option value="" selected disabled>Seleccione una opción</option>
                        <option value="1">Pendiente</option>
                        <option value="2">Realizado</option>
                        <option value="3">Cancelado</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <button type="submit" form="formularioManifiesto" id="btnGuardar"
                        class="btn btn-primary w-100">Guardar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnCancelar" class="btn btn-danger w-100">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row justify-content-center">
        <div class="col table-responsive" style="max-width: 80%; padding: 10px;">
            <h2>Listado de Manifiestos</h2>
            <table class="table table-bordered table-hover" id="tablaManifiesto">
            </table>
        </div>
    </div>
    <!-- Agrega esto al cuerpo de tu HTML -->
<div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="previewModalLabel">Vista previa de datos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="previewData">
        <!-- Aquí se mostrará la información -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="confirmarCargaCSV">Confirmar Carga</button>
      </div>
    </div>
  </div>
</div>

</body>

</html>
<script src="<?= asset('./build/js/manifiesto/index.js') ?>"></script>