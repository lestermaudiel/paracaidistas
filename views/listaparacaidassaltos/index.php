<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantenimiento de Paracaídas</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="row justify-content-center">
        <div class="col-4">
            <h4>Significado de Colores (Fecha de Caducidad)</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Color</th>
                        <th>Significado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="background-color: blue;"></td>
                        <td>Más de un año</td>
                    </tr>
                    <tr>
                        <td style="background-color: green;"></td>
                        <td>Más de 6 meses</td>
                    </tr>
                    <tr>
                        <td style="background-color: yellow;"></td>
                        <td>De 6 meses a 3 meses</td>
                    </tr>
                    <tr>
                        <td style="background-color: orange;"></td>
                        <td>De 3 meses a 1 mes</td>
                    </tr>
                    <tr>
                        <td style="background-color: red;"></td>
                        <td>Menos de 1 mes</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-4">
            <h4>Significado de Colores (Cantidad de Saltos)</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Color</th>
                        <th>Significado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="background-color: blue;"></td>
                        <td>Más de 1000 saltos</td>
                    </tr>
                    <tr>
                        <td style="background-color: lightgreen;"></td>
                        <td>De 100 a 1000 saltos</td>
                    </tr>
                    <tr>
                        <td style="background-color: yellow;"></td>
                        <td>De 50 a 100 saltos</td>
                    </tr>
                    <tr>
                        <td style="background-color: orange;"></td>
                        <td>De 1 a 50 saltos</td>
                    </tr>
                    <tr>
                        <td style="background-color: red;"></td>
                        <td>Sin saltos disponibles</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col table-responsive">
            <h2>Cantidad de Saltos</h2>
            <table class="table table-bordered table-hover" id="tablaListaParacaidassaltos">
            </table>
        </div>
    </div>

    <script src="<?= asset('./build/js/listaparacaidassaltos/index.js') ?>"></script>
</body>

</html>
