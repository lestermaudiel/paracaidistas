import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import Swal from "sweetalert2";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.getElementById('formularioParacaidas');
const btnBuscar = document.getElementById('btnBuscar');
const btnModificar = document.getElementById('btnModificar');
const btnGuardar = document.getElementById('btnGuardar');
const btnCancelar = document.getElementById('btnCancelar');
const divTabla = document.getElementById('divTabla');
const selectTipoParacaidas = document.getElementById('tipo_paracaidas');

btnModificar.disabled = true;
btnModificar.parentElement.style.display = 'none';
btnCancelar.disabled = true;
btnCancelar.parentElement.style.display = 'none';
let contador = 1;

const datatable = new Datatable('#tablaParacaidas', {
    language: lenguaje,
    data: null,
    columns: [
        {
            title: 'NO.',
            render: () => contador++
        },
        {
            title: 'Tipo de Paracaídas',
            data: 'tipo_par_descripcion',
        },
        {
            title: 'Cúpula',
            data: 'paraca_cupula',
        },
        {
            title: 'Arnés',
            data: 'paraca_arnes',
        },
        {
            title: 'Fecha de Fabricación',
            data: 'paraca_fecha_fabricacion',
        },
        {
            title: 'Fecha de Caducidad',
            data: 'paraca_fecha_caducidad',
        },
        {
            title: 'Saltos Totales',
            data: 'paraca_saltos_total',
        },
        {
            title: 'Saltos en Uso',
            data: 'paraca_saltos_uso',
        },
        {
            title: 'MODIFICAR',
            data: 'paraca_id',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => `<button class="btn btn-warning" data-id='${data}' data-paraca-cupula='${row["paraca_cupula"]}' data-paraca-arnes='${row["paraca_arnes"]}' data-paraca-fecha-fabricacion='${row["paraca_fecha_fabricacion"]}' data-paraca-fecha-caducidad='${row["paraca_fecha_caducidad"]}' data-paraca-saltos-total='${row["paraca_saltos_total"]}' data-paraca-saltos-uso='${row["paraca_saltos_uso"]}' data-tipo-par-id='${row["paraca_tipo"]}'
            >Modificar</button>`
        },
        {
            title: 'ELIMINAR',
            data: 'paraca_id',
            searchable: false,
            orderable: false,
            render: (data) => {
                const btnEliminar = document.createElement('button');
                btnEliminar.classList.add('btn', 'btn-danger');
                btnEliminar.textContent = 'Eliminar';
                btnEliminar.addEventListener('click', () => {
                    eliminar(data);
                });
                return btnEliminar.outerHTML;
            },
        },
    ],
});

const cargarTiposParacaidas = async () => {
    const url = '/paracaidistas/API/paracaidas/obtenerTiposParacaidas';
    const config = {
        method: 'GET',
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

        selectTipoParacaidas.innerHTML = '';

        data.forEach((tipo) => {
            const option = document.createElement('option');
            option.value = tipo.tipo_par_id;
            option.text = tipo.tipo_par_descripcion;
            selectTipoParacaidas.appendChild(option);
        });
    } catch (error) {
        console.log(error);
    }
};

cargarTiposParacaidas();

const guardar = async (evento) => {
    evento.preventDefault();
    if (!validarFormulario(formulario, ['paraca_cupula', 'paraca_arnes', 'paraca_fecha_fabricacion', 'paraca_fecha_caducidad', 'paraca_saltos_total', 'paraca_saltos_uso', 'tipo_paracaidas'])) {
        Toast.fire({
            icon: 'info',
            text: 'Debe llenar todos los datos'
        });
        return;
    }

    const body = new FormData(formulario);
    body.delete('paraca_id');
    const url = '/paracaidistas/API/paracaidas/guardar';
    const config = {
        method: 'POST',
        body
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

        const { codigo, mensaje, detalle } = data;
        let icon = 'info';
        switch (codigo) {
            case 1:
                formulario.reset();
                icon = 'success';
                buscar();
                break;

            case 0:
                icon = 'error';
                console.log(detalle);
                break;

            default:
                break;
        }

        Toast.fire({
            icon,
            text: mensaje
        });

    } catch (error) {
        console.log(error);
    }
};

const buscar = async () => {
    let tipo_paracaidas = formulario.tipo_paracaidas.value;
    const url = `/paracaidistas/API/paracaidas/buscar?paraca_tipo=${tipo_paracaidas}`;
    const config = {
        method: 'GET'
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        datatable.clear().draw();
        if (data) {
            contador = 1;
            datatable.rows.add(data).draw();
        } else {
            Toast.fire({
                title: 'No se encontraron registros',
                icon: 'info'
            });
        }
    } catch (error) {
        console.log(error);
    }
};

const cancelarAccion = () => {
    btnGuardar.disabled = false;
    btnGuardar.parentElement.style.display = '';
    btnBuscar.disabled = false;
    btnBuscar.parentElement.style.display = '';
    btnModificar.disabled = true;
    btnModificar.parentElement.style.display = 'none';
    btnCancelar.disabled = true;
    btnCancelar.parentElement.style.display = 'none';
    divTabla.style.display = '';
};

const traeDatos = (e) => {
    const button = e.target;
    const id = button.dataset.id;
    const paraca_cupula = button.dataset.paracaCupula;
    const paraca_arnes = button.dataset.paracaArnes;
    const paraca_fecha_fabricacion = button.dataset.paracaFechaFabricacion;
    const paraca_fecha_caducidad = button.dataset.paracaFechaCaducidad;
    const paraca_saltos_total = button.dataset.paracaSaltosTotal;
    const paraca_saltos_uso = button.dataset.paracaSaltosUso;
    const tipo_par_id = button.dataset.tipoParId;

    const dataset = {
        id,
        paraca_cupula,
        paraca_arnes,
        paraca_fecha_fabricacion,
        paraca_fecha_caducidad,
        paraca_saltos_total,
        paraca_saltos_uso,
        tipo_par_id,
    };

    colocarDatos(dataset);
};

const colocarDatos = (dataset) => {
    formulario.paraca_cupula.value = dataset.paraca_cupula;
    formulario.paraca_arnes.value = dataset.paraca_arnes;
    formulario.paraca_fecha_fabricacion.value = dataset.paraca_fecha_fabricacion;
    formulario.paraca_fecha_caducidad.value = dataset.paraca_fecha_caducidad;
    formulario.paraca_saltos_total.value = dataset.paraca_saltos_total;
    formulario.paraca_saltos_uso.value = dataset.paraca_saltos_uso;
    formulario.tipo_paracaidas.value = dataset.tipo_par_id;
    formulario.paraca_id.value = dataset.id;

    btnGuardar.disabled = true;
    btnGuardar.parentElement.style.display = 'none';
    btnBuscar.disabled = true;
    btnBuscar.parentElement.style.display = 'none';
    btnModificar.disabled = false;
    btnModificar.parentElement.style.display = '';
    btnCancelar.disabled = false;
    btnCancelar.parentElement.style.display = '';
};

const modificar = async () => {
    if (!validarFormulario(formulario, ['paraca_cupula', 'paraca_arnes', 'paraca_fecha_fabricacion', 'paraca_fecha_caducidad', 'paraca_saltos_total', 'paraca_saltos_uso', 'tipo_paracaidas'])) {
        Toast.fire({
            icon: 'info',
            text: 'Debe llenar todos los datos'
        });
        return
    }

    const body = new FormData(formulario)
    const url = '/paracaidistas/API/paracaidas/modificar';
    const config = {
        method: 'POST',
        body
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();

        const { codigo, mensaje, detalle } = data;
        let icon = 'success'
        switch (codigo) {
            case 1:
                formulario.reset();
                icon = 'success';
                buscar();
                break;

            case 0:
                icon = 'error'
                console.log(detalle)
                break;

            default:
                break;
        }

        Toast.fire({
            icon,
            text: mensaje
        })

    } catch (error) {
        console.log(error);
    }
};

const eliminar = async (paraca_id) => {
    if (await confirmacion('warning', '¿Desea eliminar este registro?')) {
        const body = new FormData();
        body.append('paraca_id', paraca_id);
        const url = '/paracaidistas/API/paracaidas/eliminar';
        const config = {
            method: 'POST',
            body
        };
        try {
            const respuesta = await fetch(url, config);
            const data = await respuesta.json();

            const { codigo, mensaje, detalle } = data;
            let icon = 'info';
            switch (codigo) {
                case 1:
                    buscar();
                    icon = 'success';
                    break;

                case 0:
                    icon = 'error';
                    console.log(detalle);
                    break;

                default:
                    break;
            }

            Toast.fire({
                icon,
                text: mensaje
            });
        } catch (error) {
            console.log(error);
            Toast.fire({
                icon: 'error',
                text: 'Error al intentar eliminar el registro.'
            });
        }
    }
};

buscar();
datatable.on('click', '.btn-warning', traeDatos);
formulario.addEventListener('submit', guardar);
btnBuscar.addEventListener('click', buscar);
btnCancelar.addEventListener('click', cancelarAccion);
btnModificar.addEventListener('click', modificar);
