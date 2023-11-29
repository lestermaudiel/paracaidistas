<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PARACAIDISTA MILITAR</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .progress-container {
            width: 100%;
            text-align: center;
            margin: 20px;
            display: none;
        }

        .progress-box {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
        }

        progress {
            width: 100%;
            margin-top: 10px;
        }

        #btnMostrarProgreso {
            width: 50%;
            margin: 10px auto;
        }
    </style>
</head>

<body>
    <h1 class="text-center">PARACAIDISTA MILITAR</h1>
    <div class="container">
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
                        <button type="button" id="btnBuscar" class="btn btn-primary btn-block">Buscar</button>
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
    </div>
    <button type="button" id="btnMostrarProgreso" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalProgreso">Proceso de Condecoraciones</button>

    <div class="modal fade" id="modalProgreso" tabindex="-1" role="dialog" aria-labelledby="modalProgresoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalProgresoLabel">Proceso de Condecoraciones</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="progress-container" id="contenedorProgreso">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="progress-box">
                                    <h2>ALAS DE PARACAIDISMO EXPERTO</h2>
            <p>Saltos Totales</p>
            <div id="divTotal"></div>
            <progress id="progresoTotal" value="0" max="100"></progress>
    
            <p>Saltos Tácticos</p>
            <div id="divTactico"></div>
            <progress id="progresoTactico" value="0" max="100"></progress>
    
            <p>Saltos de Jefe de Salto</p>
            <div id="divJefe"></div>
            <progress id="progresoJefe" value="0" max="100"></progress>
            </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="progress-box">
                                    <h2>ALAS DE PARACAIDISMO MAESTRO</h2>
            <p>Saltos Totales</p>
            <div id="divTotalMaestro"></div>
            <progress id="progresoTotalMaestro" value="0" max="100"></progress>
    
            <p>Saltos Tácticos</p>
            <div id="divTacticoMaestro"></div>
            <progress id="progresoTacticoMaestro" value="0" max="100"></progress>
    
            <p>Saltos de Jefe de Salto</p>
            <div id="divJefeMaestro"></div>
            <progress id="progresoJefeMaestro" value="0" max="100"></progress>
    
            <p>Saltos Nocturnos</p>
            <div id="divNocturnoMaestro"></div>
            <progress id="progresoNocturnoMaestro" value="0" max="100"></progress>
            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= asset('./build/js/control/index.js') ?>"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>