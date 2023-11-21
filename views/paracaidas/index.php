<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantenimiento de Paracaídas</title>
</head>

<body>
    <h1 class="text-center">Mantenimiento de Paracaídas</h1>
    <div class="row justify-content-center mb-5">
        <form class="col-lg-8 border bg-light p-3" id="formularioParacaidas">
            <input type="hidden" name="paraca_id" id="paraca_id">
            <div class="row mb-3">
                <div class="col">
                    <label for="paraca_tipo">Tipo de Paracaídas</label>
                    <select name="paraca_tipo" id="paraca_tipo" class="form-control">
                        <option value="">Selecione un Tipo</option>
                        <?php foreach ($tipoParacaidas as $tipo): ?>
                            <option value="<?= $tipo['tipo_par_id'] ?>">
                                <?= $tipo['tipo_par_descripcion'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="paraca_cupula">Cúpula</label>
                    <input type="text" name="paraca_cupula" id="paraca_cupula" class="form-control">
                </div>
                <div class="col">
                    <label for="paraca_arnes">Arnés</label>
                    <input type="text" name="paraca_arnes" id="paraca_arnes" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="paraca_fecha_fabricacion">Fecha de Fabricación</label>
                    <input type="date" name="paraca_fecha_fabricacion" id="paraca_fecha_fabricacion" class="form-control">
                </div>
                <div class="col">
                    <label for="paraca_fecha_caducidad">Fecha de Caducidad</label>
                    <input type="date" name="paraca_fecha_caducidad" id="paraca_fecha_caducidad" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="paraca_saltos_total">Saltos Totales</label>
                    <input type="number" name="paraca_saltos_total" id="paraca_saltos_total" class="form-control">
                </div>
                <div class="col">
                    <label for="paraca_saltos_uso">Saltos en Uso</label>
                    <input type="number" name="paraca_saltos_uso" id="paraca_saltos_uso" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="paraca_descripcion">Observaciones</label>
                    <textarea name="paraca_descripcion" id="paraca_descripcion" class="form-control"></textarea>
                </div>
                <div class="col">
                    <label for="paraca_estado">Estado</label>
                    <select name="paraca_estado" id="paraca_estado" class="form-control">
                        <option value="1">Buen Estado</option>
                        <option value="2">Regular Estado</option>
                        <option value="3">Mal Estado Reparable</option>
                        <option value="4">Mal Estado Irreparable</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <button type="submit" form="formularioParacaidas" id="btnGuardar" class="btn btn-primary w-100">Guardar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnModificar" class="btn btn-warning w-100">Modificar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnBuscar" class="btn btn-info w-100">Buscar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnCancelar" class="btn btn-danger w-100">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row justify-content-center">
        <div class="col table-responsive" style="max-width: 80%; padding: 10px;">
            <h2>Listado de Paracaídas</h2>
            <table class="table table-bordered table-hover" id="tablaParacaidas">
                
            </table>
        </div>
    </div>
    <script src="<?= asset('./build/js/paracaidas/index.js') ?>"></script>
</body>

</html>
