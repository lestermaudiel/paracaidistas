<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PARACAIDISTA MILITAR</title>
</head>

<body>
    <h1 class="text-center">PARACAIDISTA MILITAR</h1>
    <div class="row justify-content-center mb-5">
        <form class="col-lg-8 border bg-light p-3" id="formularioControl">
            <div class="row mb-3">
                <div class="col">
                    <label for="codigo_paracaidista">Código de Paracaidista</label>
                    <input type="number" name="codigo_paracaidista" id="codigo_paracaidista" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <button type="button" id="btnBuscar" class="btn btn-primary w-100">Buscar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2>Información del Paracaidista</h2>
            <table class="table table-bordered table-hover" id="tablaControl">
            </table>
        </div>
    </div>

    <div id="divTotal" ></div>
    <progress id="progresoTotal" value="0" max="100"></progress>
    
    <div id="divTactico" ></div>
    <progress id="progresoTactico" value="0" max="100"></progress>
    
    <div id="divJefe" ></div>
    <progress id="progresoJefe" value="0" max="100"></progress>

    <script src="<?= asset('./build/js/control/index.js') ?>"></script>
</body>

</html>