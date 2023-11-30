import { Dropdown } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import Swal from "sweetalert2";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.getElementById('formularioCivil');
const btnBuscar = document.getElementById('btnBuscar');
const btnModificar = document.getElementById('btnModificar');
const btnGuardar = document.getElementById('btnGuardar');
const btnCancelar = document.getElementById('btnCancelar');

btnModificar.disabled = true;
btnModificar.parentElement.style.display = 'none';
btnCancelar.disabled = true;
btnCancelar.parentElement.style.display = 'none';

let contador = 1;

const datatable = new Datatable('#tablaCivil', {
    language: lenguaje,
    data: null,
    columns: [
        { title: 'NO', render: () => contador++ },
        { title: 'No. DPI', data: 'paraca_civil_dpi' },
        { title: 'Primer Nombre', data: 'paraca_civil_nom1' },
        { title: 'Segundo Nombre', data: 'paraca_civil_nom2' },
        { title: 'Primer Apellido', data: 'paraca_civil_ape1' },
        { title: 'Segundo Apellido', data: 'paraca_civil_ape2' },
        { title: 'Teléfono', data: 'paraca_civil_tel' },
        { title: 'Dirección', data: 'paraca_civil_direc' },
        { title: 'Email', data: 'paraca_civil_email' },
        {
            title: 'MODIFICAR', data: 'paraca_civil_dpi', searchable: false, orderable: false,
            render: (data, type, row, meta) => {
                return `<button class="btn btn-warning" data-id='${data}' data-dpi='${row['paraca_civil_dpi']}' data-nom1='${row['paraca_civil_nom1']}' 
            data-nom2='${row['paraca_civil_nom2']}' data-ape1='${row['paraca_civil_ape1']}' data-ape2='${row['paraca_civil_ape2']}' data-direc='${row['paraca_civil_direc']}'
            data-tel='${row['paraca_civil_tel']}' data-email='${row['paraca_civil_email']}'>Modificar</button>`
            }
        },
        {
            title: 'ELIMINAR',
            data: 'paraca_civil_dpi',
            searchable: false, orderable: false,
            render: (data) => `<button class="btn btn-danger" data-id='${data}'>Eliminar</button>`
        },
    ],
});

const buscar = async () => {
    let paraca_civil_dpi = formulario.paraca_civil_dpi.value;

    const url = `/paracaidistas/API/civil/buscar?paraca_civil_dpi=${paraca_civil_dpi}`;
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
    if (!validarFormulario(formulario, ['paraca_civil_dpi'])) {
        Toast.fire({
            icon: 'info',
            text: 'Debe llenar todos los datos'
        });
        return;
    }

    const body = new FormData(formulario);
    const url = '/paracaidistas/API/civil/guardar';
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
        body.append('paraca_civil_dpi', id);
        const url = '/paracaidistas/API/civil/eliminar';
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
    if (!validarFormulario(formulario, ['paraca_civil_dpi'])) {
        alert('Debe llenar todos los campos');
        return;
    }

    const body = new FormData(formulario)
    const url = '/paracaidistas/API/civil/modificar';
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
    const dpi = button.dataset.dpi;
    const nom1 = button.dataset.nom1;
    const nom2 = button.dataset.nom2;
    const ape1 = button.dataset.ape1;
    const ape2 = button.dataset.ape2;
    const direc = button.dataset.direc;
    const tel = button.dataset.tel;
    const email = button.dataset.email;

    const dataset = {
        id,
        dpi,
        nom1,
        nom2,
        ape1,
        ape2,
        direc,
        tel,
        email,
    };

    colocarDatos(dataset);
};

const colocarDatos = (dataset) => {
    formulario.paraca_civil_dpi.value = dataset.dpi;
    formulario.paraca_civil_nom1.value = dataset.nom1;
    formulario.paraca_civil_nom2.value = dataset.nom2;
    formulario.paraca_civil_ape1.value = dataset.ape1;
    formulario.paraca_civil_ape2.value = dataset.ape2;
    formulario.paraca_civil_direc.value = dataset.direc;
    formulario.paraca_civil_tel.value = dataset.tel;
    formulario.paraca_civil_email.value = dataset.email;

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

