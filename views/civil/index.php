<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantenimiento de Civiles</title>
</head>

<body>
    <h1 class="text-center">Mantenimiento de Civiles</h1>
    <div class="row justify-content-center mb-5">
        <form class="col-lg-8 border bg-light p-3" id="formularioCivil">
            <input type="hidden" name="paraca_civil_dpi" id="paraca_civil_dpi">
            
            <div class="row mb-3">
                <div class="col">
                    <label for="paraca_civil_dpi">DPI</label>
                    <input type="text" name="paraca_civil_dpi" id="paraca_civil_dpi" class="form-control" placeholder="Ingrese DPI">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="paraca_civil_nom1">Primer Nombre</label>
                    <input type="text" name="paraca_civil_nom1" id="paraca_civil_nom1" class="form-control">
                </div>
                <div class="col">
                    <label for="paraca_civil_nom2">Segundo Nombre</label>
                    <input type="text" name="paraca_civil_nom2" id="paraca_civil_nom2" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="paraca_civil_ape1">Primer Apellido</label>
                    <input type="text" name="paraca_civil_ape1" id="paraca_civil_ape1" class="form-control">
                </div>
                <div class="col">
                    <label for="paraca_civil_ape2">Segundo Apellido</label>
                    <input type="text" name="paraca_civil_ape2" id="paraca_civil_ape2" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="paraca_civil_tel">Teléfono</label>
                    <input type="text" name="paraca_civil_tel" id="paraca_civil_tel" class="form-control">
                </div>
                <div class="col">
                    <label for="paraca_civil_email">Correo Electrónico</label>
                    <input type="text" name="paraca_civil_email" id="paraca_civil_email" class="form-control">
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col">
                    <button type="submit" form="formularioCivil" id="btnGuardar" class="btn btn-primary w-100">Guardar</button>
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
            <h2>Listado de Civiles</h2>
            <table class="table table-bordered table-hover" id="tablaCivil">
            </table>
        </div>
    </div>
</body>

</html>
<script src="<?= asset('./build/js/civil/index.js') ?>"></script>
