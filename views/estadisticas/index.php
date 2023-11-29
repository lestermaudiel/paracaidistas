
<style>
    body{
        background-color: #8fcfbf;
    }

    .reporte-titulo {
            font-family: Arial;
            font-size: 48px;
            font-weight: bold;
            color: #000000;
        }
    #btnActualizar{
        background-color: #e13647; /* Cambia "red" por el color que desees */
        
    }
    /* Estilos para agregar espaciado entre los div */
    .container > .row > .col-lg-18 > div {
        margin-bottom: 100px; /* Cambia el valor según el espaciado deseado */
    }

    /* Estilo para resaltar al pasar el ratón */
    .container > .row > .col-lg-18 > div:hover {
        box-shadow: 0 0 10px rgba(0, 0, 0, 1.10); /* Cambia la sombra según tu preferencia */
        z-index: 3; /* Para asegurar que esté sobre las demás figuras */
        transform: scale(1.10); /* Efecto de escala al pasar el ratón */
        transition: all 0.2s ease; /* Animación suave */
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-lg-18">
            <center><h1 class="reporte-titulo">ESTADISTICAS DE PARACAIDAS</h1>
            <button id="btnActualizar" class="btn btn-info">Actualizar</button></center>
            <div class="row mt-5">
                <div class="card col-lg-3 mb-4 item">
                <h4><center>PARACAIDAS</center></h4>
                    <canvas id="chartparacaidas" width="50%"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= asset('./build/js/estadisticas/index.js') ?>"></script>