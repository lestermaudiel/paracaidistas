import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import Swal from "sweetalert2";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.getElementById('formularioTipoSalto');
const btnBuscar = document.getElementById('btnBuscar');
const btnModificar = document.getElementById('btnModificar');
const btnGuardar = document.getElementById('btnGuardar');
const btnCancelar = document.getElementById('btnCancelar');
const divTabla = document.getElementById('divTabla');

btnModificar.disabled = true;
btnModificar.parentElement.style.display = 'none';
btnCancelar.disabled = true;
btnCancelar.parentElement.style.display = 'none';
let contador = 1;
const datatable = new Datatable('#tablaTipoSalto', {
    language: lenguaje,
    data: null,
    columns: [
        {
            title: 'NO.',
            render: () => contador++
        },
        {
            title: 'Detalle',
            data: 'tipo_salto_detalle',
        },
        {
            title: 'MODIFICAR',
            data: 'tipo_salto_id',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => `<button class="btn btn-warning" data-id='${data}' data-tipo-salto-detalle='${row["tipo_salto_detalle"]}'
            >Modificar</button>`
        },
        {
            title: 'ELIMINAR',
            data: 'tipo_salto_id',
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

const guardar = async (evento) => {
    evento.preventDefault();
    if (!validarFormulario(formulario, ['tipo_salto_id'])) {
        Toast.fire({
            icon: 'info',
            text: 'Debe llenar todos los datos'
        });
        return;
    }

    const body = new FormData(formulario);
    body.delete('tipo_salto_id');
    const url = '/paracaidistas/API/tiposalto/guardar'; // Ajusta la URL según tu configuración
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
    let tipo_salto_detalle = formulario.tipo_salto_detalle.value;
    const url = `/paracaidistas/API/tiposalto/buscar?tipo_salto_detalle=${tipo_salto_detalle}`;
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
    const tipo_salto_detalle = button.dataset.tipoSaltoDetalle;

    const dataset = {
        id,
        tipo_salto_detalle,
    };

    colocarDatos(dataset);
};

const colocarDatos = (dataset) => {
    formulario.tipo_salto_detalle.value = dataset.tipo_salto_detalle;
    formulario.tipo_salto_id.value = dataset.id;

    btnGuardar.disabled = true;
    btnGuardar.parentElement.style.display = 'none';
    btnBuscar.disabled = true;
    btnBuscar.parentElement.style.display = 'none';
    btnModificar.disabled = false;
    btnModificar.parentElement.style.display = '';
    btnCancelar.disabled = false;
    btnCancelar.parentElement.style.display = '';
}

const modificar = async () => {
    if (!validarFormulario(formulario)) {
        Toast.fire({
            icon: 'info',
            text: 'Debe llenar todos los datos'
        });
        return
    }

    const body = new FormData(formulario)
    const url = '/paracaidistas/API/tiposalto/modificar'; // Ajusta la URL según tu configuración
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
}

const eliminar = async (tipo_salto_id) => {
    if (await confirmacion('warning', '¿Desea eliminar este registro?')) {
        const body = new FormData();
        body.append('tipo_salto_id', tipo_salto_id);
        const url = '/paracaidistas/API/tiposalto/eliminar'; // Ajusta la URL según tu configuración
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
