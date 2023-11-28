import { Dropdown } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import Swal from "sweetalert2";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.getElementById('formularioParacaidista');
const inputIdentificacion = document.getElementById('identificacion');
const selectTipoPersona = document.getElementById('tipoPersona');

const btnModificar = document.getElementById('btnModificar');
const btnCancelar = document.getElementById('btnCancelar');

btnModificar.disabled = true;
btnModificar.parentElement.style.display = 'none';
btnCancelar.disabled = true;
btnCancelar.parentElement.style.display = 'none';

let contador = 1;

const datatableConfig = {
    language: lenguaje,
    data: null,
    columns: [
        { title: 'NO', render: () => contador++ },
        { title: 'Militar', data: 'paraca_codigo' },
        { title: 'Nombre Militar', data: 'militar' },
        { title: 'Civil', data: 'paraca_civil_dpi' },
        { title: 'Nombre Civil', data: 'civil' },
        { title: 'Fecha de Graduación', data: 'paraca_fecha_graduacion' },
        {
            title: 'ELIMINAR',
            data: 'paraca_id',
            searchable: false, orderable: false,
            render: (data) => `<button class="btn btn-danger" data-id='${data}'>Eliminar</button>`
        },
    ],
};

const datatable = new Datatable('#tablaParacaidista', datatableConfig);

const buscar = async () => {
    const url = `/paracaidistas/API/paracaidista/buscar`;
    const config = { method: 'GET' };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

        datatable.clear().draw();
        if (data) {
            contador = 1;
            datatable.rows.add(data).draw();
        } else {
            Toast.fire({ title: 'No se encontraron registros', icon: 'info' });
        }
    } catch (error) {
        console.error(error);
    }
};

const guardar = async (evento) => {
    evento.preventDefault();

    if (!validarFormulario(formulario, ['paraca_id'])) {
        Toast.fire({ icon: 'info', text: 'Debe llenar todos los datos' });
        return;
    }

    const formData = new FormData(formulario);
    formData.append(selectTipoPersona.value === 'militar' ? 'paraca_codigo' : 'paraca_civil_dpi', inputIdentificacion.value);
    const body = new FormData(formulario);
body.append('fechaGraduacion', document.getElementById('fechaGraduacion').value);


    const url = '/paracaidistas/API/paracaidista/guardar';
    const config = { method: 'POST', body: formData };

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
                console.error(detalle);
                break;

            default:
                break;
        }

        Toast.fire({ icon, text: mensaje });

    } catch (error) {
        console.error(error);
    }
};

const eliminar = async (e) => {
    const button = e.target;
    const id = button.dataset.id;

    if (await confirmacion('warning', '¿Desea eliminar este registro?')) {
        const formData = new FormData();
        formData.append('altimetro_id', id);

        const url = '/paracaidistas/API/paracaidista/eliminar';
        const config = { method: 'POST', body: formData };

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
                    console.error(detalle);
                    break;

                default:
                    break;
            }

            Toast.fire({ icon, text: mensaje });

        } catch (error) {
            console.error(error);
        }

    }
};

function validarTipoPersona() {
    inputIdentificacion.placeholder = (selectTipoPersona.value === 'militar') ? 'Ingrese catalogo' : 'Ingrese DPI';
}

validarTipoPersona();
buscar();

selectTipoPersona.addEventListener('change', validarTipoPersona);
formulario.addEventListener('submit', guardar);
datatable.on('click', '.btn-danger', eliminar);
