<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantenimiento de Pistas</title>
</head>
<body>
    <h1 class="text-center">Formulario de Pistas</h1>
    <div class="row justify-content-center mb-5">
        <form class="col-lg-8 border bg-light p-3" id="formularioPista">
            <input type="hidden" name="pista_id" id="pista_id">
            <div class="row mb-3">
                <div class="col">
                    <label for="pista_detalle">Detalle de la Pista</label>
                    <input type="text" name="pista_detalle" id="pista_detalle" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="pista_salto_latitud">Latitud</label>
                    <input type="decimal" name="pista_salto_latitud" id="pista_salto_latitud" class="form-control">
                </div>
                <div class="col">
                    <label for="pista_salto_longitud">Longitud</label>
                    <input type="decimal" name="pista_salto_longitud" id="pista_salto_longitud" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="pista_salto_direc_latitud">Dirección de Latitud</label>
                    <select name="pista_salto_direc_latitud" id="pista_salto_direc_latitud" class="form-control">
                        <option value="">Seleccione</option>
                        <option value="N">Norte</option>
                        <option value="S">Sur</option>
                    </select>
                </div>
                <div class="col">
                    <label for="pista_salto_direc_longitud">Dirección de Longitud</label>
                    <select name="pista_salto_direc_longitud" id="pista_salto_direc_longitud" class="form-control">
                        <option value="">Seleccione</option>
                        <option value="E">Este</option>
                        <option value="O">Oeste</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <button type="submit" form="formularioPista" id="btnGuardar"
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
    <div class="row justify-content-center" id="divTabla">
        <div class="col-lg-8">
            <h2>Listado de Pistas</h2>
            <table class="table table-bordered table-hover" id="tablaPista">
            </table>
        </div>
    </div>
</body>
</html>
<script src="<?= asset('./build/js/pista/index.js') ?>"></script>
