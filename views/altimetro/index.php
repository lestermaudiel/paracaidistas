<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantenimiento de Altímetros</title>
</head>
<body>
    <h1 class="text-center">Mantenimiento de Altímetros</h1>
    <div class="row justify-content-center mb-5">
        <form class="col-lg-8 border bg-light p-3" id="formularioAltimetro">
            <input type="hidden" name="altimetro_id" id="altimetro_id">
            <div class="row mb-3">
                <div class="col">
                    <label for="altimetro_serie">Número de Serie</label>
                    <input type="text" name="altimetro_serie" id="altimetro_serie" class="form-control">
                </div>
                <div class="col">
                    <label for="altimetro_marca">Marca</label>
                    <input type="text" name="altimetro_marca" id="altimetro_marca" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <button type="submit" form="formularioAltimetro" id="btnGuardar" class="btn btn-primary w-100">Guardar</button>
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
            <h2>Listado de Altímetros</h2>
            <table class="table table-bordered table-hover" id="tablaAltimetro">
            </table>
        </div>
    </div>
</body>

</html>
<script src="<?= asset('./build/js/altimetro/index.js') ?>"></script>
