import { Dropdown } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import Swal from "sweetalert2";
import { validarFormulario, Toast, confirmacion } from "../funciones";
0
const formulario = document.getElementById('formularioParacaidas');
const btnBuscar = document.getElementById('btnBuscar');
const btnModificar = document.getElementById('btnModificar');
const btnGuardar = document.getElementById('btnGuardar');
const btnCancelar = document.getElementById('btnCancelar');
//const divTabla = document.getElementById('divTabla');
const selectTipoParacaidas = document.getElementById('paraca_tipo');

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
            title: 'Dias restantes',
            data: 'tiempo_restante',
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
            title: 'Saltos Disponibles',
            data: 'saltos_disponibles',
        },
        {
            title: 'MODIFICAR',
            data: 'paraca_id',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => {
                return `<button class="btn btn-warning" data-id='${data}' data-tipo-par-id='${row["paraca_tipo"]}' data-paraca-cupula='${row["paraca_cupula"]}' data-paraca-arnes='${row["paraca_arnes"]}'
            data-paraca-fecha-fabricacion='${row["paraca_fecha_fabricacion"]}' data-paraca-fecha-caducidad='${row["paraca_fecha_caducidad"]}' data-paraca-saltos-total='${row["paraca_saltos_total"]}' data-paraca-saltos-uso='${row["paraca_saltos_uso"]}'
            >Modificar</button>`}
        },
        {
            title: 'ELIMINAR',
            data: 'paraca_id',
            searchable: false,
            orderable: false,
            render: (data) => `<button class="btn btn-danger" data-id='${data}'>Eliminar</button>` 

        },
    ],
}

);

// Función para cargar dinámicamente las opciones del tipo de paracaídas
const cargarTiposParacaidas = async () => {
    const url = '/paracaidistas/API/tiposparacaidas/buscar?situacion=1';
    const config = {
        method: 'GET',
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

        // Limpia las opciones actuales
        selectTipoParacaidas.innerHTML = '';

        // Añade una opción por cada tipo de paracaídas
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

// Llama a la función para cargar los tipos de paracaídas al cargar la página
// cargarTiposParacaidas();

const buscar = async () => {
    let paraca_tipo = formulario.paraca_tipo.value;
    let paraca_cupula = formulario.paraca_cupula.value;
    const url = `/paracaidistas/API/paracaidas/buscar?paraca_tipo=${paraca_tipo}&paraca_cupula=${paraca_cupula}`;
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
    if (!validarFormulario(formulario, ['paraca_id'])) {
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

const eliminar = async (paraca_id) => {
    const button = e.target;
    const id = button.dataset.id;

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

const modificar = async (e) => {
    e.preventDefault()
    if (!validarFormulario(formulario, ['paraca_id'])) {
        Toast.fire({
            icon: 'info',
            text: 'Debe llenar todos los datos'
        });
        return;
    }

    const body = new FormData(formulario);
    const url = '/paracaidistas/API/paracaidas/modificar';
    const config = {
        method: 'POST',
        body
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

        const { codigo, mensaje, detalle } = data;
        let icon = 'success';
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



const traeDatos = (e) => {
    const button = e.target;
    const id = button.dataset.id;
    const paraca_tipo = button.dataset.paracaTipo;
    const paraca_cupula = button.dataset.paracaCupula;
    const paraca_arnes = button.dataset.paracaArnes;
    const paraca_fecha_fabricacion = button.dataset.paracaFechaFabricacion;
    const paraca_fecha_caducidad = button.dataset.paracaFechaCaducidad;
    const paraca_saltos_total = button.dataset.paracaSaltosTotal;
    const paraca_saltos_uso = button.dataset.paracaSaltosUso;

    const dataset = {
        id,
        paraca_tipo,
        paraca_cupula,
        paraca_arnes,
        paraca_fecha_fabricacion,
        paraca_fecha_caducidad,
        paraca_saltos_total,
        paraca_saltos_uso
    };

    colocarDatos(dataset);
};

const colocarDatos = (dataset) => {
    // Asigna los valores a los campos del formulario
    formulario.paraca_tipo.value = dataset.paraca_tipo;
    formulario.paraca_cupula.value = dataset.paraca_cupula;
    formulario.paraca_arnes.value = dataset.paraca_arnes;
    formulario.paraca_fecha_fabricacion.value = dataset.paraca_fecha_fabricacion;
    formulario.paraca_fecha_caducidad.value = dataset.paraca_fecha_caducidad;
    formulario.paraca_saltos_total.value = dataset.paraca_saltos_total;
    formulario.paraca_saltos_uso.value = dataset.paraca_saltos_uso;
    formulario.paraca_id.value = dataset.id;

    // Habilita y muestra los botones de Modificar y Cancelar
    btnGuardar.disabled = true;
    btnGuardar.parentElement.style.display = 'none';
    btnBuscar.disabled = true;
    btnBuscar.parentElement.style.display = 'none';
    btnModificar.disabled = false;
    btnModificar.parentElement.style.display = '';
    btnCancelar.disabled = false;
    btnCancelar.parentElement.style.display = '';
};

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
// Event listeners

btnBuscar.addEventListener('click', buscar);
btnCancelar.addEventListener('click', cancelarAccion);
btnModificar.addEventListener('click', modificar);
datatable.on('click', '.btn-danger', eliminar);
formulario.addEventListener('submit', guardar);
datatable.on('click', '.btn-warning', traeDatos);




// Carga los tipos de paracaídas al cambiar la opción del select
selectTipoParacaidas.addEventListener('change', () => {
    buscar();
});





buscar();