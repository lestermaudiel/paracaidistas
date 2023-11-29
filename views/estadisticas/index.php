<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h1 class="reporte-titulo text-center">ESTADOS DE PARACAIDAS</h1>
            <button id="btnActualizar" class="btn btn-info">Actualizar</button>
            <div class="row mt-5">
                <div class="card col-lg-8 mb-5 item text-center">
                    <h4>PARACAIDAS</h4>
                    <canvas id="chartparacaidas" width="100%"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= asset('./build/js/estadisticas/index.js') ?>"></script>
</body>
</html>
