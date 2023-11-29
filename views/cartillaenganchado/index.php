<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CARTILLA ENGANCHADO</title>
</head>

<body>
    <h1 class="text-center">CARTILLA ENGANCHADO</h1>
    <div class="row justify-content-center mb-5">
        <form class="col-lg-8 border bg-light p-3" id="formularioCartillaEnganchado">
            <div class="row mb-3">
                <div class="col">
                    <label for="codigo_paracaidista">Catálogo o DPI de Paracaidista</label>
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
    

    <script src="<?= asset('./build/js/cartillaenganchado/index.js') ?>"></script>
</body>

</html>
