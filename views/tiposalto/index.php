<h1 class="text-center">Tipos de Saltos</h1>
<div class="row justify-content-center mb-5">
    <form class="col-lg-8 border bg-light p-3" id="formularioTipoSalto">
        <input type="hidden" name="tipo_salto_id" id="tipo_salto_id">
        <div class="row mb-3">
            <div class="col">
                <label for="tipo_salto_detalle">Detalle</label>
                <input type="text" name="tipo_salto_detalle" id="tipo_salto_detalle" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <button type="submit" form="formularioTipoSalto" id="btnGuardar" class="btn btn-primary w-100">Guardar</button>
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
        <h2>Listado de Tipos de Salto</h2>
        <table class="table table-bordered table-hover" id="tablaTipoSalto">
            <thead class="table-dark">
                <tr>
                    <th>NO.</th>
                    <th>DETALLE</th>
                    <th>MODIFICAR</th>
                    <th>ELIMINAR</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<script src="<?= asset('./build/js/tiposalto/index.js')  ?>"></script>