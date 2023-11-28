import { Dropdown } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import Swal from "sweetalert2";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.getElementById('formularioTipoParacaidas');
const btnModificar = document.getElementById('btnModificar');
const btnGuardar = document.getElementById('btnGuardar');
const btnCancelar = document.getElementById('btnCancelar');

btnModificar.disabled = true;
btnModificar.parentElement.style.display = 'none';
btnCancelar.disabled = true;
btnCancelar.parentElement.style.display = 'none';
let contador = 1;
const datatable = new Datatable('#tablaTipop', {
    language: lenguaje,
    data: null,
    columns: [
        {
            title: 'NO',
            render: () => contador++
        },
        {
            title: 'Lote de paraidas',
            data: 'tipo_par_lote',
        },
        {
            title: 'Tipo de paracaidas',
            data: 'tipo_par_descripcion',
        },
        
        {
            title: 'MODIFICAR',
            data: 'tipo_par_id',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => {
                console.log(row['tipo_par_lote'])
                return `<button class="btn btn-warning" data-id='${data}' data-lote='${row['tipo_par_lote']}' data-descripcion='${row['tipo_par_descripcion']}'>Modificar</button>`}
        },
        {
            title: 'ELIMINAR',
            data: 'tipo_par_id',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => `<button class="btn btn-danger" data-id='${data}'>Eliminar</button>`
        },
    ],
});

const buscar = async () => {
    let tipo_par_lote = formulario.tipo_par_lote.value;
    let tipo_par_descripcion = formulario.tipo_par_descripcion.value;
    console.log(tipo_par_lote)
    console.log(tipo_par_descripcion)
    const url = `/paracaidistas/API/tiposparacaidas/buscar?tipo_par_lote=${tipo_par_lote}&tipo_par_descripcion=${tipo_par_descripcion}`;
    const config = {
        method: 'GET'
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        console.log(data)
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
    if (!validarFormulario(formulario, ['tipo_par_id'])) {
        Toast.fire({
            icon: 'info',
            text: 'Debe llenar todos los datos'
        });
        return;
    }

    const body = new FormData(formulario);
    for (var pair of body.entries()) {
        console.log(pair[0] + ', ' + pair[1]);
    }
    const url = '/paracaidistas/API/tiposparacaidas/guardar';
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
        body.append('tipo_par_id', id);
        const url = '/paracaidistas/API/tiposparacaidas/eliminar';
        const config = {
            method: 'POST',
            body
        };
        try {
            const respuesta = await fetch(url, config);
            const data = await respuesta.json();
            // console.log(data);

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
    if (!validarFormulario(formulario, ['tipo_par_id'])) {
        alert('Debe llenar todos los campos');
        return;
    }

    const body = new FormData(formulario)
    const url = '/paracaidistas/API/tiposparacaidas/modificar';
    const config = {
        method: 'POST',
        body
    }

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        console.log(data);
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
    const tipo_par_lote = button.dataset.lote;
    const tipo_par_descripcion = button.dataset.descripcion;

    const dataset = {
        id,
        tipo_par_lote,
        tipo_par_descripcion,
    };
    console.log(dataset)

    colocarDatos(dataset);
};

const colocarDatos = (dataset) => {
    formulario.tipo_par_lote.value = dataset.tipo_par_lote;
    formulario.tipo_par_descripcion.value = dataset.tipo_par_descripcion;
    formulario.tipo_par_id.value = dataset.id;

    btnGuardar.disabled = true;
    btnGuardar.parentElement.style.display = 'none';
    btnModificar.disabled = false;
    btnModificar.parentElement.style.display = '';
    btnCancelar.disabled = false;
    btnCancelar.parentElement.style.display = '';
}

const cancelarAccion = () => {
    formulario.reset();
    btnGuardar.disabled = false;
    btnGuardar.parentElement.style.display = '';
    btnModificar.disabled = true;
    btnModificar.parentElement.style.display = 'none';
    btnCancelar.disabled = true;
    btnCancelar.parentElement.style.display = 'none';
};



buscar();

formulario.addEventListener('submit', guardar);
datatable.on('click', '.btn-warning', traeDatos);
datatable.on('click', '.btn-danger', eliminar);
btnCancelar.addEventListener('click', cancelarAccion);
btnModificar.addEventListener('click', modificar);