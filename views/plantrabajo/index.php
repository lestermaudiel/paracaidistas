<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plan de Trabajo</title>
</head>

<body>
    <h1 class="text-center">Plan de Trabajo</h1>
    <div class="row justify-content-center mb-5">
        <form class="col-lg-8 border bg-light p-3" id="formularioPlantrabajo">
            <input type="hidden" name="plan_id" id="plan_id">
            <div class="row mb-3">
                <div class="col">
                    <label for="plan_codigo">Código</label>
                    <input type="text" name="plan_codigo" id="plan_codigo" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <button type="submit" form="formularioPlantrabajo" id="btnGuardar"
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
            <h2>Listado de Planes de Trabajo</h2>
            <table class="table table-bordered table-hover" id="tablaPlantrabajo">
            </table>
        </div>
    </div>
</body>
</html>
<script src="<?= asset('./build/js/plantrabajo/index.js') ?>"></script>
