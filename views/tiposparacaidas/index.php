<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantenimiento Tipos de Paracaidas.</title>
</head>

<body>
    <h1 class="text-center">Tipos de Paracaídas</h1>
    <div class="row justify-content-center mb-5">
        <form class="col-lg-8 border bg-light p-3" id="formularioTipoParacaidas">
            <input type="hidden" name="tipo_par_id" id="tipo_par_id">
            <div class="row mb-3">
                <div class="col">
                    <label for="tipo_par_lote">Lote del Tipo de Paracaídas</label>
                    <input type="text" name="tipo_par_lote" id="tipo_par_lote" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="tipo_par_descripcion">Descripción del Tipo de Paracaídas</label>
                    <input type="text" name="tipo_par_descripcion" id="tipo_par_descripcion" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <button type="submit" form="formularioTipoParacaidas" id="btnGuardar"
                        class="btn btn-primary w-100">Guardar</button>
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
            <table id="tablaTipop" class="table table-bordered table-hover">
            </table>
        </div>
    </div>
</body>

</html>
<script src="<?= asset('./build/js/tiposparacaidas/index.js') ?>"></script>