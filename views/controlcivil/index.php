<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PARACAIDISTA CIVIL</title>
</head>

<body>
    <h1 class="text-center">PARACAIDISTA CIVIL</h1>
    <div class="row justify-content-center mb-5">
        <form class="col-lg-8 border bg-light p-3" id="formularioControlCivil">
            <div class="row mb-3">
                <div class="col">
                    <label for="dpi_paracaidista">DPI de Paracaidista Civil</label>
                    <input type="number" name="dpi_paracaidista" id="dpi_paracaidista" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <button type="button" id="btnBuscarCivil" class="btn btn-primary w-100">Buscar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2>Información del Paracaidista Civil</h2>
            <table class="table table-bordered table-hover" id="tablaControlCivil">
            </table>
        </div>
    </div>

    <script src="<?= asset('./build/js/controlcivil/index.js') ?>"></script>
</body>

</html>
