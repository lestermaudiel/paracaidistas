<h1 class="text-center">Formulario de Paracaidistas Civiles</h1>
<div class="row justify-content-center mb-5">
    <form class="col-lg-8 border bg-light p-3" id="formularioParacaidistaCivil">
        <div class="row mb-3">
            <div class="col">
                <label for="paracaidista_civil_dpi">DPI del Paracaidista</label>
                <input type="text" name="paracaidista_civil_dpi" id="paracaidista_civil_dpi" class="form-control">
            </div>
            <div class="col">
                <label for="paracaidista_civil_nombre">Nombre del Paracaidista</label>
                <input type="text" name="paracaidista_civil_nombre" id="paracaidista_civil_nombre" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="paracaidista_civil_apellidos">Apellidos del Paracaidista</label>
                <input type="text" name="paracaidista_civil_apellidos" id="paracaidista_civil_apellidos" class="form-control">
            </div>
            <div class="col">
                <label for="paracaidista_civil_telefono">Teléfono del Paracaidista</label>
                <input type="text" name="paracaidista_civil_telefono" id="paracaidista_civil_telefono" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="paracaidista_civil_direccion">Dirección del Paracaidista</label>
                <input type="text" name="paracaidista_civil_direccion" id="paracaidista_civil_direccion" class="form-control">
            </div>
            <div class="col">
                <label for="paracaidista_civil_correo_electronico">Correo Electrónico del Paracaidista</label>
                <input type="text" name="paracaidista_civil_correo_electronico" id="paracaidista_civil_correo_electronico" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="paracaidista_civil_saltos">Número de Saltos</label>
                <input type="number" name="paracaidista_civil_saltos" id="paracaidista_civil_saltos" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <button type="submit" form="formularioParacaidistaCivil" id="btnGuardar" class="btn btn-primary w-100">Guardar</button>
            </div>
            <div class="col">
                <button type="button" id="btnModificar" class="btn btn-warning w-100">Modificar</button>
            </div>
            <div class="col">
                <button type="button" id="btnBuscar" class="btn btn-info w-100">Buscar</button>
            </div>
            <div class="col">
                <button type="button" id="btnCancelar" class="btn btn-danger w-100">Cancelar</button>
            </div>
        </div>
    </form>
</div>
<div class="row justify-content-center" id="divTabla">
    <div class="col-lg-8">
        <h2>Listado de Paracaidistas Civiles</h2>
        <table class="table table-bordered table-hover" id="tablaCivil">
            <thead class="table-dark">
                <tr>
                    <th>NO.</th>
                    <th>DPI</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Correo Electrónico</th>
                    <th>Número de Saltos</th>
                    <th>MODIFICAR</th>
                    <th>ELIMINAR</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<script src="<?= asset('./build/js/civil/index.js')  ?>"></script>