import { Dropdown } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import Swal from "sweetalert2";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.getElementById('formularioZonaSalto');
const btnBuscar = document.getElementById('btnBuscar');
const btnModificar = document.getElementById('btnModificar');
const btnGuardar = document.getElementById('btnGuardar');
const btnCancelar = document.getElementById('btnCancelar');

btnModificar.disabled = true;
btnModificar.parentElement.style.display = 'none';
btnCancelar.disabled = true;
btnCancelar.parentElement.style.display = 'none';

let contador = 1;

const datatable = new Datatable('#tablaZonaSalto', {
    // Configuración de la tabla DataTable
    language: lenguaje,
    data: null,
    columns: [
        { title: 'NO', render: () => contador++ },
        { title: 'Nombre de la Zona', data: 'zona_salto_nombre' },
        { title: 'Latitud', data: 'zona_salto_latitud' },
        { title: 'Longitud', data: 'zona_salto_longitud' },
        { title: 'Dirección de Latitud', data: 'zona_salto_direc_latitud' },
        { title: 'Dirección de Longitud', data: 'zona_salto_direc_longitud' },
        { title: 'MODIFICAR', data: 'zona_salto_id', searchable: false, orderable: false,
          render: (data, type, row, meta) => {
            return `<button class="btn btn-warning" data-id='${data}' data-nombre='${row['zona_salto_nombre']}' data-latitud='${row['zona_salto_latitud']}' data-longitud='${row['zona_salto_longitud']}' data-direc-latitud='${row['zona_salto_direc_latitud']}' data-direc-longitud='${row['zona_salto_direc_longitud']}'>Modificar</button>` }
        },
        { title: 'ELIMINAR', 
        data: 'zona_salto_id',
        searchable: false, orderable: false,
          render: (data) => `<button class="btn btn-danger" data-id='${data}'>Eliminar</button>` 
        },
    ],
});

const buscar = async () => {
    let zona_salto_nombre = formulario.zona_salto_nombre.value;

    const url = `/paracaidistas/API/zonasalto/buscar?zona_salto_nombre=${zona_salto_nombre}`;
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

const guardar = async (evento) => {
    evento.preventDefault();
    if (!validarFormulario(formulario, ['zona_salto_id'])) {
        Toast.fire({
            icon: 'info',
            text: 'Debe llenar todos los datos'
        });
        return;
    }

    const body = new FormData(formulario);
    const url = '/paracaidistas/API/zonasalto/guardar';
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

const eliminar = async (e) => {
    const button = e.target;
    const id = button.dataset.id;

    if (await confirmacion('warning', '¿Desea eliminar este registro?')) {
        const body = new FormData();
        body.append('zona_salto_id', id);
        const url = '/paracaidistas/API/zonasalto/eliminar';
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

    }
};

const modificar = async (e) => {
    e.preventDefault()
    if (!validarFormulario(formulario, ['zona_salto_id'])) {
        alert('Debe llenar todos los campos');
        return;
    }

    const body = new FormData(formulario)
    const url = '/paracaidistas/API/zonasalto/modificar';
    const config = {
        method: 'POST',
        body
    }

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
                cancelarAccion();
                break;

            case 0:
                icon = 'error'
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
}

const traeDatos = (e) => {
    const button = e.target;
    const id = button.dataset.id;
    const nombre = button.dataset.nombre;
    const latitud = button.dataset.latitud;
    const longitud = button.dataset.longitud;
    const direcLatitud = button.dataset.direcLatitud;
    const direcLongitud = button.dataset.direcLongitud;

    const dataset = {
        id,
        nombre,
        latitud,
        longitud,
        direcLatitud,
        direcLongitud,
    };

    colocarDatos(dataset);
};

const colocarDatos = (dataset) => {
    formulario.zona_salto_nombre.value = dataset.nombre;
    formulario.zona_salto_latitud.value = dataset.latitud;
    formulario.zona_salto_longitud.value = dataset.longitud;
    formulario.zona_salto_direc_latitud.value = dataset.direcLatitud;
    formulario.zona_salto_direc_longitud.value = dataset.direcLongitud;
    formulario.zona_salto_id.value = dataset.id;

    btnGuardar.disabled = true;
    btnGuardar.parentElement.style.display = 'none';
    btnBuscar.disabled = true;
    btnBuscar.parentElement.style.display = 'none';
    btnModificar.disabled = false;
    btnModificar.parentElement.style.display = '';
    btnCancelar.disabled = false;
    btnCancelar.parentElement.style.display = '';
}

const cancelarAccion = () => {
    formulario.reset();
    btnGuardar.disabled = false;
    btnGuardar.parentElement.style.display = '';
    btnBuscar.disabled = false;
    btnBuscar.parentElement.style.display = '';
    btnModificar.disabled = true;
    btnModificar.parentElement.style.display = 'none';
    btnCancelar.disabled = true;
    btnCancelar.parentElement.style.display = 'none';
};

buscar();

btnModificar.addEventListener('click', modificar);
btnCancelar.addEventListener('click', cancelarAccion);
btnBuscar.addEventListener('click', buscar);
formulario.addEventListener('submit', guardar);
datatable.on('click', '.btn-warning', traeDatos);
datatable.on('click', '.btn-danger', eliminar);
