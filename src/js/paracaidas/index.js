import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import Swal from "sweetalert2";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.getElementById('formularioAeronave');
const btnBuscar = document.getElementById('btnBuscar');
const btnModificar = document.getElementById('btnModificar');
const btnGuardar = document.getElementById('btnGuardar');
const btnCancelar = document.getElementById('btnCancelar');
const divTabla = document.getElementById('divTabla');
const selectTipoParacaidas = document.getElementById('tipo_paracaidas'); // Ajusta el ID según tu formulario

btnModificar.disabled = true;
btnModificar.parentElement.style.display = 'none';
btnCancelar.disabled = true;
btnCancelar.parentElement.style.display = 'none';
let contador = 1;
const datatable = new Datatable('#tablaAeronave', {
    language: lenguaje,
    data: null,
    columns: [
        {
            title: 'NO.',
            render: () => contador++
        },
        {
            title: 'Descripción de Aeronave',
            data: 'aer_desc_aeronave',
        },
        {
            title: 'Tipo de Ala',
            data: 'aer_tip_ala',
        },
        {
            title: 'MODIFICAR',
            data: 'aer_tip_registro',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => `<button class="btn btn-warning" data-id='${data}' data-aer-desc-aeronave='${row["aer_desc_aeronave"]}' data-aer-tip-ala='${row["aer_tip_ala"]}'
            >Modificar</button>`
        },
        {
            title: 'ELIMINAR',
            data: 'aer_tip_registro',
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

// Función para cargar dinámicamente las opciones del tipo de paracaidas
const cargarTiposParacaidas = async () => {
    const url = '/paracaidistas/API/tiposparacaidas/buscar';
    const config = {
        method: 'GET',
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

        // Limpia las opciones actuales
        selectTipoParacaidas.innerHTML = '';

        // Añade una opción por cada tipo de paracaidas
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

// Llama a la función para cargar los tipos de paracaidas al cargar la página
cargarTiposParacaidas();

const guardar = async (evento) => {
    evento.preventDefault();
    if (!validarFormulario(formulario, ['aer_desc_aeronave', 'aer_tip_ala'])) {
        Toast.fire({
            icon: 'info',
            text: 'Debe llenar todos los datos'
        });
        return;
    }

    const body = new FormData(formulario);
    body.delete('aeronave_id');
    const url = '/paracaidistas/API/aeronave/guardar'; // Ajusta la URL según tu configuración
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
    let aer_desc_aeronave = formulario.aer_desc_aeronave.value;
    let aer_tip_ala = formulario.aer_tip_ala.value;
    const url = `/paracaidistas/API/aeronave/buscar?aer_desc_aeronave=${aer_desc_aeronave}&aer_tip_ala=${aer_tip_ala}`;
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
    const aer_desc_aeronave = button.dataset.aerDescAeronave;
    const aer_tip_ala = button.dataset.aerTipAla;

    const dataset = {
        id,
        aer_desc_aeronave,
        aer_tip_ala,
    };

    colocarDatos(dataset);
};

const colocarDatos = (dataset) => {
    formulario.aer_desc_aeronave.value = dataset.aer_desc_aeronave;
    formulario.aer_tip_ala.value = dataset.aer_tip_ala;
    formulario.aeronave_id.value = dataset.id;

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
    if (!validarFormulario(formulario)) {
        Toast.fire({
            icon: 'info',
            text: 'Debe llenar todos los datos'
        });
        return
    }

    const body = new FormData(formulario)
    const url = '/paracaidistas/API/aeronave/modificar'; // Ajusta la URL según tu configuración
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

const eliminar = async (aer_tip_registro) => {
    if (await confirmacion('warning', '¿Desea eliminar este registro?')) {
        const body = new FormData();
        body.append('aer_tip_registro', aer_tip_registro);
        const url = '/paracaidistas/API/aeronave/eliminar'; // Ajusta la URL según tu configuración
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
