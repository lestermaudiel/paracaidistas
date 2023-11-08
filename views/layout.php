<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="build/js/app.js"></script>
    <link rel="shortcut icon" href="<?= asset('images/cit.png') ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= asset('build/styles.css') ?>">
    <title>Paracaidistas</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark  bg-dark">

        <div class="container-fluid">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler"
                aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="/paracaidistas/">
                <img src="<?= asset('./images/cit.png') ?>" width="35px'" alt="cit">
                Paracaidistas
            </a>
            <div class="collapse navbar-collapse" id="navbarToggler">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="margin: 0;">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/paracaidistas/"><i
                                class="bi bi-house-fill me-2"></i>Inicio</a>
                    </li>

                    <div class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-gear me-2"></i>Insertar Datos
                        </a>
                        <ul class="dropdown-menu  dropdown-menu-dark " id="dropwdownRevision" style="margin: 0;">
                            <!-- <h6 class="dropdown-header">Información</h6> -->
                            <li>
                                <a class="dropdown-item nav-link text-white " href="/paracaidistas/tiposparacaidas"><i
                                        class="ms-lg-0 ms-2 bi bi-plus-circle me-2"></i>Tipos de Paracaidas</a>
                            </li>
                            <li>
                                <a class="dropdown-item nav-link text-white " href="/paracaidistas/tiposalto"><i
                                        class="ms-lg-0 ms-2 bi bi-plus-circle me-2"></i>Tipos de Saltos</a>
                            </li>
                            <li>
                                <a class="dropdown-item nav-link text-white " href="/paracaidistas/zonasalto"><i
                                        class="ms-lg-0 ms-2 bi bi-plus-circle me-2"></i>Zona de Saltos</a>
                            </li>
                            <li>
                                <a class="dropdown-item nav-link text-white " href="/paracaidistas/altimetro"><i
                                        class="ms-lg-0 ms-2 bi bi-plus-circle me-2"></i>Altimetros</a>
                            </li>
                            <li>
                                <a class="dropdown-item nav-link text-white " href="/paracaidistas/pista"><i
                                        class="ms-lg-0 ms-2 bi bi-plus-circle me-2"></i>Pistas de Aterrizaje</a>
                            </li>
                            <li>
                                <a class="dropdown-item nav-link text-white " href="/paracaidistas/aeronave"><i
                                        class="ms-lg-0 ms-2 bi bi-plus-circle me-2"></i>Aeronaves</a>
                            </li>
                        </ul>
                    </div>
                    <div class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-person-add me-2"></i>Pesonal Civil
                        </a>
                        <ul class="dropdown-menu  dropdown-menu-dark " id="dropwdownRevision" style="margin: 0;">
                            <li>
                                <a class="dropdown-item nav-link text-white " href="/paracaidistas/persona"><i
                                        class="ms-lg-0 ms-2 bi bi-plus-circle me-2"></i>Personal Civil</a>
                            </li>
                            <li>
                                <a class="dropdown-item nav-link text-white " href="/paracaidistas/manifiestocivil"><i
                                        class="ms-lg-0 ms-2 bi bi-filetype-pdf me-2"></i>Manifiesto Civil</a>
                            </li>
                        </ul>
                    </div>
                    <div class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-filetype-pdf me-2"></i>Manifieto
                        </a>
                        <ul class="dropdown-menu  dropdown-menu-dark " id="dropwdownRevision" style="margin: 0;">
                            <li>
                                <a class="dropdown-item nav-link text-white " href="/paracaidistas/manifiesto"><i
                                        class="ms-lg-0 ms-2 bi bi-plus-circle me-2"></i>Crear Manifiesto</a>
                            </li>
                            <li>
                                <a class="dropdown-item nav-link text-white " href="/paracaidistas/manifiestolista"><i
                                        class="ms-lg-0 ms-2 bi bi-filetype-pdf me-2"></i>Lista de Manifiestos</a>
                            </li>
                        </ul>
                    </div>
                    <div class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-person-arms-up me-2"></i>Saltos
                        </a>
                        <ul class="dropdown-menu  dropdown-menu-dark " id="dropwdownRevision" style="margin: 0;">
                            <li>
                                <a class="dropdown-item nav-link text-white " href="/paracaidistas/saltomilitar"><i
                                        class="ms-lg-0 ms-2 bi bi-person-fill me-2"></i>Saltos Mitares</a>
                            </li>
                            <li>
                                <a class="dropdown-item nav-link text-white " href="/paracaidistas/saltocivil"><i
                                        class="ms-lg-0 ms-2 bi bi-filetype-pdf me-2"></i>Saltos Civiles</a>
                            </li>
                        </ul>
                    </div>

                </ul>
                <div class="col-lg-1 d-grid mb-lg-0 mb-2">
                    <a href="/paracaidistas/" class="btn btn-danger"><i class="bi bi-arrow-bar-left"></i>MENÚ</a>
                </div>
            </div>
        </div>

    </nav>
    <div class="progress fixed-bottom" style="height: 6px;">
        <div class="progress-bar progress-bar-animated bg-danger" id="bar" role="progressbar" aria-valuemin="0"
            aria-valuemax="100"></div>
    </div>
    <div class="container-fluid pt-5 mb-4" style="min-height: 85vh">

        <?php echo $contenido; ?>
    </div>
    <div class="container-fluid ">
        <div class="row justify-content-center text-center">
            <div class="col-12">
                <p style="font-size:xx-small; font-weight: bold;">
                    Comando de Informática y Tecnología,
                    <?= date('Y') ?> &copy;
                </p>
            </div>
        </div>
    </div>
</body>

</html>