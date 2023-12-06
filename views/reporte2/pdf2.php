<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zziy2YFZ5rPqFMPPpjBRBoxDx2PbAKL3LO9QGHvZ56z25UNR/lvO+ebBqISQSmF5" crossorigin="anonymous">
    <title>CARTILLA SALTO LIBRE</title>
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
            display: inline-block;
            width: 50%;
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
        <div class="first-page" style="text-align: center; padding: 20px; background-color: #f8f9fa; color: #343a40;">
            <h1 style="font-weight: bold; text-decoration: underline; margin-bottom: 20px; font-size: 24px;">
                RECORD INDIVIDUAL DE SALTO EN PARACAIDAS ESTILO LIBRE
            </h1>
            <div class="images-container" style="width: 100%; text-align: center;">
                <img src="../public/images/maestro.jpg" alt="Paracaidista" style="max-width: 100%; height: auto;">
            </div>
            <div style="font-size: 18px; margin-bottom: 10px; text-align: justify;">
                <strong>Nombre:</strong>&nbsp;&nbsp;
                <?= $info['nombre'] ?>
            </div>
            <div style="font-size: 18px; margin-bottom: 10px; text-align: justify;">
                <strong>Grado:</strong>&nbsp;&nbsp;
                <?= $info['grado'] ?>
            </div>
            <div style="font-size: 18px; margin-bottom: 10px; text-align: justify;">
                <strong>Número de Serie:</strong>&nbsp;&nbsp;
                <?= $info['serie'] ?>
            </div>
            <div style="font-size: 18px; margin-bottom: 10px; text-align: justify;">
                <strong>Fecha de Graduación como Paracaidista:</strong>&nbsp;&nbsp;
                <?= $info['graduacion'] ?>
            </div>
            <div style="font-size: 18px; margin-bottom: 10px; text-align: justify;">
                <strong>Unidad:</strong>&nbsp;&nbsp;
                <?= $info['unidad'] ?>
            </div>
        </div>
    </div>
    <pagebreak />
    </div>
    <div>
        <h1>CARTILLA DE SALTO LIBRE</h1>
        <table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Salto No.</th>
            <th>Fecha</th>
            <th>Localización</th>
            <th>Tipo Avión</th>
            <th>Certifica el salto</th>
            <th>Paracaídas</th>
            <th>Altura Salto</th>
            <th>Retardo Segundos</th>
            <th>Maniobras</th>
            <th>Distancia del Blanco</th>
            <th>Viento Superficie</th>
            <th>Observaciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dataSet as $key => $data): ?>
            <tr>
                <td><?= $key + 1 ?></td>
                <td><?= $data['fecha'] ?></td>
                <td><?= $data['zona_salto'] ?></td>
                <td><?= $data['avion'] ?></td>
                <td><?= $data['jefe'] ?></td>
                <td><?= $data['tipo_paracaidas'] ?></td>
                <td><?= $data['altura'] ?></td>
                <td><?= $data['retardo'] ?></td>
                <td><?= $data['maniobras'] ?></td>
                <td><?= $data['distancia_del_blanco'] ?></td>
                <td><?= $data['viento_superficie'] ?></td>
                <td><?= $data['observacion'] ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
        </table>
        <pagebreak />
    </div>
    <div class="container">
        <div class="libreta-salto" style="background-color: #f8f9fa; padding: 20px; margin-bottom: 20px;">
            <h1 style="font-weight: bold; text-decoration: underline; font-size: 24px; margin-bottom: 20px;">
                SU LIBRETA DE SALTO LIBRE
            </h1>
            <ol style="font-size: 16px;">
                <li>Escriba su nombre con tinta en el espacio indicado.</li>
                <li>Mantenga su libreta al día y con tinta.</li>
                <li>Llene Todos los espacios que se indican, exceptuando el de la firma del Oficial responsable.</li>
                <li>Llene los espacios como sigue:
                    <ol type="a">
                        <li>Número que corresponda al salto</li>
                        <li>Unidad a la que pertenece.</li>
                        <li>Nombre de la Zona de Salto y localización.</li>
                        <li>Fecha del Salto.</li>
                        <li>Posición en el Stick.</li>
                        <li>Tipo del Avión.</li>
                        <li>Tipo del Paracaídas.</li>
                        <li>Tipo de Salto como sigue:
                            <ul>
                                <li>T-Táctico</li>
                                <li>M-Masa</li>
                                <li>A/NT-Administrativo o No Táctico.</li>
                                <li>J-Jumpmaster.</li>
                                <li>EC-Equipo de Combate.</li>
                                <li>N-Nocturno</li>
                            </ul>
                        </li>
                        <li>Firma y Grado del Oficial que certifica el Salto.</li>
                        <li>Observaciones. (Se incluye el nombre de la Unidad con la que se efectúan el Salto).</li>
                    </ol>
                </li>
            </ol>
        </div>
    </div>

    <pagebreak />

    <div class="container">
        <div class="escala-insignias" style="background-color: #f8f9fa; padding: 20px; margin-bottom: 20px;">
            <h1 style="font-weight: bold; font-size: 24px; margin-bottom: 20px;">ESCALA DE INSIGNIAS</h1>
            <p style="font-size: 16px;"><strong>I. ALAS DE PARACAIDISTA:</strong></p>
            <p style="font-size: 16px;">Cinco saltos en paracaídas. Uno de ellos con equipo de combate.</p>
            <p style="font-size: 16px;"><strong>II. ALAS DE PARACAIDISTA EXPERTO:</strong></p>
            <p style="font-size: 16px;">ARTÍCULO 182. Las Alas de Paracaidismo Experto, se otorgarán después de haber
                efectuado un mínimo de treinta saltos conforme los requisitos siguientes:</p>
            <p style="font-size: 16px;">A. De los treinta saltos, haber efectuado quince saltos en combate simulado, dos
                saltos nocturnos (uno como jefe de salto), y dos saltos en masa, como miembro de una Unidad que salte
                completa.</p>
            <p style="font-size: 16px;">B. Ser graduado en una Escuela para Jefes de salto en el extranjero, o haber
                recibido y aprobado este entrenamiento en el Ejército de Guatemala.</p>
            <p style="font-size: 16px;">C. Haber sido jefe en quince saltos o haber efectuado un salto en combate real.
            </p>
            <p style="font-size: 16px;">D. Haber servido en situación de activo (saltando), en las Unidades de
                Paracaidista o en otras organizaciones de Paracaidista autorizado, por lo menos durante un año.</p>
            <p style="font-size: 16px;"><strong>III. ALAS DE PARACAIDISTA MAESTRO:</strong></p>
            <p style="font-size: 16px;">ARTÍCULO 183. Las Alas de Paracaidista Maestro, se otorgarán después de haber
                efectuado un número de sesenta y cinco saltos y llenar cualesquiera de los requisitos siguientes:</p>
            <p style="font-size: 16px;">A. De los sesenta y cinco saltos, haber efectuado veinticinco saltos en combate
                simulado, cuatro saltos nocturnos (dos como jefe de salto), dos saltos libre (uno de ellos con caída
                controlada) y cinco saltos en masa cuando la Unidad salte completa.</p>
            <p style="font-size: 16px;">B. Haber sido jefe en treinta y tres saltos, o en dos o más saltos en combate
                real; y.</p>
            <p style="font-size: 16px;">C. Haber servido en situación de activo (saltando), en las Unidades de
                Paracaidistas en el Ejército de Guatemala, o en otra organización de paracaidistas autorizado, durante
                un tiempo no menor de dos años</p>
        </div>
        <div class="images-container" style="float: right; width: 50%;">
            <img src="../public/images/paracaidista.jpg" alt="Paracaidista" style="width: 100%;">

        </div>
    </div>
</body>

</html>