<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zziy2YFZ5rPqFMPPpjBRBoxDx2PbAKL3LO9QGHvZ56z25UNR/lvO+ebBqISQSmF5" crossorigin="anonymous">
    <title>CARTILLA SALTO ENGANCHADO</title>
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
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
            background-color: #ffffff;
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

        .libreta-salto {
            margin-top: 30px;
        }

        .libreta-salto li {
            margin-bottom: 10px;
            font-size: 12px;
        }

        .escala-insignias {
            margin-top: 30px;
            display: inline-block; /* Alinea en línea */
            width: 50%; /* Asegura que ocupe la mitad del contenedor padre */
        }

        .escala-insignias h1 {
            font-size: 15px;
            color: black;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: bold;
            font-family: 'Arial', sans-serif;
            margin-bottom: 20px;
        }

        .escala-insignias p {
            font-size: 12px;
        }

        .paragrafatura {
            font-size: 12px;
            margin-bottom: 10px;
            text-align: justify;
        }
        
    </style>
</head>

<body>
<div class="container">
        <div class="first-page">
        <p style="text-align: center; font-weight: bold; text-decoration: underline;">RECORD INDIVIDUAL DE SALTO EN PARACAIDAS</p>
        <p>Nombre: <?= $info['nombre'] ?></p>
        <p>Grado: <?= $info['grado'] ?></p>
        
        <p>Número de Serie: <?= $info['serie'] ?></p>
        <p>Fecha de Graduación como Paracaidista: <?= $info['graduacion'] ?></p>
        <p>Unidad: <?= $info['unidad'] ?></p>
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
        <pagebreak/>
    </div>
    <div class="libreta-salto">
                <h1>SU LIBRETA DE SALTO ENGANCHADO</h1>
                <ol>
                    <li>Escriba su nombre con tinta en el espacio indicado.</li>
                    <li>Mantenga su libreta al día y con tinta.</li>
                    <li>Llene Todos los espacios que se indican, exceptuando el de la firma del Oficial responsable.</li>
                    <li>Llene los espacios como sigue:</li>
                    <ol type="a">
                        <li>Columna 1: Número que corresponda al salto</li>
                        <li>Columna 2: Unidad a la que pertenece.</li>
                        <li>Columna 3: Nombre de la Zona de Salto y localización.</li>
                        <li>Columna 4: Fecha del Salto.</li>
                        <li>Columna 5: Posición en el Stick.</li>
                        <li>Columna 6: Tipo del Avión.</li>
                        <li>Columna 7: Tipo del Paracaidas.</li>
                        <li>Columna 8: Tipo de Salto como sigue:</li>
                        <ul>
                            <li>T-Táctico</li>
                            <li>M-Masa</li>
                            <li>A/NT-Administrativo o No Táctico.</li>
                            <li>J-Jumpmaster.</li>
                            <li>EC-Equipo de Combate.</li>
                            <li>N-Nocturno</li>
                        </ul>
                        <li>Columna 9: Firma y Grado del Oficial que certifica el Salto.</li>
                        <li>Columna 10: Observaciones. (Se incluye el nombre de la Unidad con la que se efectúan el Salto).</li>
                    </ol>
                </ol>
            </div>
        </div>
        <pagebreak/>
        <div class="container">
            <div class="escala-insignias">
                <h1>ESCALA DE INSIGNIAS</h1>
        <p><strong>I. ALAS DE PARACAIDISTA:</strong></p>
        <P> Cinco saltos en paracaídas. Uno de ellos con equipo de combate.</p>
        <p><strong>II. ALAS DE PARACAIDISTA EXPERTO:</strong></p>
        <p class="paragrafatura">ARTÍCULO 182. Las Alas de Paracaidismo Experto, se otorgarán después de haber efectuado un mínimo de treinta saltos conforme los requisitos siguientes:</p>
        <p class="paragrafatura">A. De los treinta saltos, haber efectuado quince saltos en combate simulado, dos saltos nocturnos (uno como jefe de salto), y dos saltos en masa, como miembro de una Unidad que salte completa.</p>
        <p class="paragrafatura">B. Ser graduado en una Escuela para Jefes de salto en el extranjero, o haber recibido y aprobado este entrenamiento en el Ejército de Guatemala.</p>
        <p class="paragrafatura">C. Haber sido jefe en quince saltos o haber efectuado un salto en combate real.</p>
        <p class="paragrafatura">D. Haber servido en situación de activo (saltando), en las Unidades de Paracaidista o en otras organizaciones de Paracaidista autorizado, por lo menos durante un año.</p>
        <p><strong>III. ALAS DE PARACAIDISTA MAESTRO:</strong></p>
        <p class="paragrafatura">ARTÍCULO 183. Las Alas de Paracaidista Maestro, se otorgarán después de haber efectuado un número de sesenta y cinco saltos y llenar cualesquiera de los requisitos siguientes:</p>
        <p class="paragrafatura">A. De los sesenta y cinco saltos, haber efectuado veinticinco saltos en combate simulado, cuatro saltos nocturnos (dos como jefe de salto), dos saltos libre (uno de ellos con caída controlada) y cinco saltos en masa cuando la Unidad salte completa.</p>
        <p class="paragrafatura">B. Haber sido jefe en treinta y tres saltos, o en dos o más saltos en combate real; y.</p>
        <p class="paragrafatura">C. Haber servido en situación de activo (saltando), en las Unidades de Paracaidistas en el Ejército de Guatemala, o en otra organización de paracaidistas autorizado, durante un tiempo no menor de dos años</p>
        </div>
        <div class="images-container" style="float: right; width: 50%;">
            <img src="../public/images/paracaidista.jpg" alt="Paracaidista">
            <img src="../public/images/experto.jpg" alt="Experto">
            <img src="../public/images/maestro.jpg" alt="Maestro">
        </div>
    </div>
</div>
</body>
</html>