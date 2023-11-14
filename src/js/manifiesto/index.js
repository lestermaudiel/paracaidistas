import { Dropdown } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import Swal from "sweetalert2";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.getElementById('formularioManifiesto');
const btnBuscar = document.getElementById('btnBuscar');
const btnModificar = document.getElementById('btnModificar');
const btnGuardar = document.getElementById('btnGuardar');
const btnCancelar = document.getElementById('btnCancelar');

btnModificar.disabled = true;
btnModificar.parentElement.style.display = 'none';
btnCancelar.disabled = true;
btnCancelar.parentElement.style.display = 'none';

let contador = 1;

const datatable = new Datatable('#tablaManifiesto', {
    language: lenguaje,
    data: null,
    columns: [
        { title: 'NO', render: () => contador++ },
        // Incluir las columnas necesarias para la tabla par_manifiesto
        // Por ejemplo:
        // { title: 'ID', data: 'mani_id' },
        // { title: 'Plan de Trabajo', data: 'mani_plan_trabajo' },
        // ...

        // Agrega las columnas que necesites para tu aplicación
        // Asegúrate de ajustar los nombres de las columnas según la estructura de tu base de datos
        // y la lógica de tu aplicación
    ],
});

const buscar = async () => {
    // Implementa la lógica para realizar la búsqueda según tus necesidades
};

const guardar = async (evento) => {
    // Implementa la lógica para guardar según tus necesidades
};

const eliminar = async (e) => {
    // Implementa la lógica para eliminar según tus necesidades
};

const modificar = async (e) => {
    // Implementa la lógica para modificar según tus necesidades
};

const traeDatos = (e) => {
    // Implementa la lógica para obtener los datos y llenar el formulario de modificación
};

const colocarDatos = (dataset) => {
    // Implementa la lógica para colocar los datos en el formulario de modificación
};

const cancelarAccion = () => {
    // Implementa la lógica para cancelar la acción y limpiar el formulario
};

buscar();

btnModificar.addEventListener('click', modificar);
btnCancelar.addEventListener('click', cancelarAccion);
btnBuscar.addEventListener('click', buscar);
formulario.addEventListener('submit', guardar);
datatable.on('click', '.btn-warning', traeDatos);
datatable.on('click', '.btn-danger', eliminar);
