<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zziy2YFZ5rPqFMPPpjBRBoxDx2PbAKL3LO9QGHvZ56z25UNR/lvO+ebBqISQSmF5" crossorigin="anonymous">
    <title>CARTILLA SALTO LIBRE.</title>
    <style>
        body {
            position: relative;
        }

        .container {
            position: relative;
        }

        h1 {
            text-align: center;
            font-size: 15px;
            color: black;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: bold;
            font-family: 'Arial', sans-serif;
        }

        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
            background-color: #ffffff;
            /* Eliminar o ajustar la intensidad de la sombra */
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            border: 2px solid gray;
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }

        .table-bordered tbody tr,
        .table-bordered th,
        .table-bordered td {
            border: 2px solid black !important;
        }

        th {
            font-weight: bold;
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e0e0e0;
        }

        .data-label {
            font-weight: bold;
            font-size: 12px;
            color: #343a40;
        }

        .data-label::after {
            content: ":";
            margin-right: 3px;
        }

        .center-row th {
            text-align: center;
        }

        .hr-divider {
            border: none;
            height: 2px;
            background-color: #ddd;
            margin: 10px 0;
        }

        .form-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .form-box {
            width: 45%;
        }

        .form-label {
            display: block;
            font-size: 12px;
        }

        .description-row {
            background-color: #ffd700;
            font-weight: bold;
            color: #343a40;
        }

        .description-row td {
            padding: 8px;
            text-align: left;
            font-size: 12px;
            border: 2px solid #dee2e6;
        }
    </style>
</head>

<body>
    <div class="container">
    <div class="first-page">
            <div class="container">
        <!-- Información adicional del paracaidista -->
        <p style="text-align: center; font-weight: bold;"><?= $info['nombre'] ?></p>
        <p style="text-align: center; font-weight: bold; text-decoration: underline;">RECORD INDIVIDUAL DE SALTO EN PARACAIDAS</p>
        <p>Nombre: <?= $info['nombre'] ?></p>
        <p>Grado: <?= $info['grado'] ?></p>
        <!-- Agrega las siguientes líneas según tus necesidades -->
        <p>Número de Serie: <?= $info['numero_serie'] ?></p>
        <p>Fecha de Graduación como Paracaidista: <?= $info['fecha_graduacion'] ?></p>
        <p>Unidad: <?= $info['unidad'] ?></p>
            <!-- Puedes agregar más líneas según sea necesario -->

            <!-- Salto a la siguiente página -->
            <pagebreak/>
        </div>
        <div>
        <h1>CARTILLA DE SALTO ENGANCHADO</h1>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th rowspan="2">Salto No.</th>
                    <th rowspan="2">Unidad</th>
                    <th rowspan="2">Zona de Salto y Localización</th>
                    <th rowspan="2">Fecha</th>
                    <th rowspan="2">Número de Stick</th>
                    <th rowspan="2">Tipo de Avión</th>
                    <th rowspan="2">Tipo de Paracaídas</th>
                    <th rowspan="2">Tipo de Salto</th>
                    <th colspan="2">Oficial que Certifica</th>
                    <th rowspan="2">Observaciones</th>
                </tr>
                <tr>
                    <th>Nombre</th>
                    <th>Grado</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($dataSet as $key=>$data): ?> 
                <tr>
                    <td><?= $key+1 ?></td>
                    <td><?= $data['unidad']?></td>
                    <td><?= $data['zona_salto']?></td>
                    <td><?= $data['fecha']?></td>
                    <td><?= $data['stick']?></td>
                    <td><?= $data['avion']?></td>
                    <td><?= $data['tipo_paracaidas']?></td>
                    <td><?= $data['tipo_salto']?></td>
                    <td><?= $data['jefe']?></td>
                    <td><?= $data['grado_jefe']?></td>
                    <td><?= $data['observacion']?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</body>
</html>
