<h1 class="text-center">Formulario de Aeronave</h1>
<div class="row justify-content-center mb-5">
    <form class="col-lg-8 border bg-light p-3" id="formularioAeronave">
        <input type="hidden" name="aeronave_id" id="aeronave_id">
        <div class="row mb-3">
            <div class="col">
                <label for="aer_desc_aeronave">Descripción de Aeronave</label>
                <input type="text" name="aer_desc_aeronave" id="aer_desc_aeronave" class="form-control">
            </div>
            <div class="col">
                <label for="aer_tip_ala">Tipo de Ala</label>
                <select name="aer_tip_ala" id="aer_tip_ala" class="form-select">
                <option value="">Seleccione una Opción</option>    
                <option value="FIJA">FIJA</option>
                    <option value="ROTATIVA">ROTATIVA</option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <button type="submit" form="formularioAeronave" id="btnGuardar" class="btn btn-primary w-100">Guardar</button>
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
        <h2>Listado de Aeronaves</h2>
        <table class="table table-bordered table-hover" id="tablaAeronave">
            <thead class="table-dark">
                <tr>
                    <th>NO.</th>
                    <th>Descripción de Aeronave</th>
                    <th>Tipo de Ala</th>
                    <th>MODIFICAR</th>
                    <th>ELIMINAR</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<script src="<?= asset('./build/js/aeronave/index.js')  ?>"></script>
