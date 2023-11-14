<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paracaidistas Civiles</title>
</head>

<body>
    <h1 class="text-center">Paracaidistas Civiles</h1>
    <div class="row justify-content-center mb-5">
        <form class="col-lg-8 border bg-light p-3" id="formularioParacaidistaCivil">
            <div class="row mb-3">
                <div class="col">
                    <label for="paraca_civil_dpi">DPI</label>
                    <input type="text" name="paraca_civil_dpi" id="paraca_civil_dpi" class="form-control">
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
                    <label for="paraca_civil_direc">Dirección</label>
                    <input type="text" name="paraca_civil_direc" id="paraca_civil_direc" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="paraca_civil_email">Correo Electrónico</label>
                    <input type="email" name="paraca_civil_email" id="paraca_civil_email" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <button type="submit" form="formularioParacaidistaCivil" id="btnGuardar" class="btn btn-primary w-100">Guardar</button>
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
            <h2>Listado de Paracaidistas Civiles</h2>
            <table class="table table-bordered table-hover" id="tablaParacaidistaCivil">
                <thead class="table-dark">
                    <tr>
                        <th>DPI</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Teléfono</th>
                        <th>Correo Electrónico</th>
                        <th>MODIFICAR</th>
                        <th>ELIMINAR</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <script src="<?= asset('./build/js/civil/index.js') ?>"></script>
</body>

</html>
