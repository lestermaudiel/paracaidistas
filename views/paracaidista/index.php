<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantenimiento de Paracaidistas</title>
</head>

<body>
    <h1 class="text-center">Mantenimiento de Paracaidistas</h1>
    <div class="row justify-content-center mb-5">
        <form class="col-lg-8 border bg-light p-3" id="formularioParacaidista">
            <input type="hidden" name="paraca_id" id="paraca_id">

            <div class="row mb-3">
                <div class="col">
                    <label for="tipoPersona">Tipo de Persona</label>
                    <select name="tipoPersona" id="tipoPersona" class="form-control">
                        <option value="militar">Militar</option>
                        <option value="civil">Civil</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3" id="catalogo">
                <div class="col">
                    <label for="identificacion">Catalogo</label>
                    <input type="text" name="identificacion" id="identificacion" class="form-control">
                </div>
            </div>

            <!-- <div class="row mb-3" id="dpi">
                <div class="col">
                    <div class="col" id="divDPI">
                        <label for="paraca_civil_dpi">DPI</label>
                        <input type="text" name="paraca_civil_dpi" id="paraca_civil_dpi" class="form-control"
                            placeholder="Ingrese DPI">
                    </div>
                </div>
            </div> -->



            <div class="row mb-3">
                <div class="col">
                    <button type="submit" form="formularioParacaidista" id="btnGuardar"
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
            <h2>Listado de Paracaidistas</h2>
            <table class="table table-bordered table-hover" id="tablaParacaidista">
            </table>
        </div>
    </div>
    <script src="<?= asset('./build/js/paracaidista/index.js') ?>"></script>
</body>

</html>