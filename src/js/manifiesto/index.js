import { Dropdown } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import Swal from "sweetalert2";
import { validarFormulario, Toast, confirmacion } from "../funciones";
import { get } from "jquery";

const formulario = document.getElementById('formularioManifiesto');
const inputJefe = document.getElementById('inputJefe');
const btnGuardar = document.getElementById('btnGuardar');
const inputParacaidista = document.getElementById('identificacion_paracaidista');

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

const getParacaidista = async (e) => {
    e.preventDefault()
    console.log('getParacaidista')
    let identificacion_paracaidista = formulario.identificacion_paracaidista.value;
    
    console.log(identificacion_paracaidista)
    const url = `/paracaidistas/API/manifiesto/getParacaidista?codigo_paracaidista=${identificacion_paracaidista}`;
    const config = {
        method: 'GET'
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        console.log(respuesta)
        console.log(data)
        if (data) {
            formulario.nombre_paracaidista.value=data[0]['nombre_paracaidista']
            formulario.mani_paraca_cod.value=data[0]['paraca_id']
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

const getJefeSalto = async (e) => {
    e.preventDefault();
    console.log('getJefeSalto');
    let mani_jefe = formulario.mani_jefe.value;

    console.log(mani_jefe);
    const url = `/paracaidistas/API/manifiesto/getJefeSalto?codigo_jefe=${mani_jefe}`;
    const config = {
        method: 'GET'
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        console.log(respuesta);
        console.log(data);
        if (data) {
            formulario.nombre_jefe.value = data[0]['nombre_jefe'];
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


const buscar = async () => {
    // Implementa la lógica para realizar la búsqueda según tus necesidades
};

const guardar = async (evento) => {
    evento.preventDefault();

    const formData = new FormData(formulario);
    const url = '/paracaidistas/API/manifiesto/guardar';

    for(var pair of formData.entries()){
        console.log(pair[0], pair[1]);
    }
    const config = {
        method: 'POST',
        body: formData
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        console.log(data)
        if (data.codigo === 1) {
            Toast.fire({
                title: 'Registro guardado correctamente',
                icon: 'success'
            });
        } else {
            Toast.fire({
                title: 'Ocurrió un error al guardar',
                icon: 'error'
            });
        }
    } catch (error) {
        console.log(error);
    }
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

formulario.addEventListener('submit', guardar);
datatable.on('click', '.btn-warning', traeDatos);
datatable.on('click', '.btn-danger', eliminar);

inputParacaidista.addEventListener('change',getParacaidista)
inputJefe.addEventListener('change', getJefeSalto);

