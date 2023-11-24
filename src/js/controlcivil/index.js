import { Dropdown } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import Swal from "sweetalert2";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.querySelector('#formularioControl');
const btnBuscar = document.querySelector('#btnBuscar');
let contador = 1;
const datatable = new Datatable('#tablaControl', {
    language: lenguaje,
    data: null,
    columns: [
        {
            title: 'NO.',
            render: () => contador++
        },
        {
            title: 'codigo',
            data: 'id_paracaidista',
        },
        {
            title: 'Paracaidista',
            data: 'nombre_paracaidista',
        },
        {
            title: 'Tipo de Salto',
            data: 'tipo_salto',
        },
        {
            title: 'Saltos Total',
            data: 'cantidad_de_saltos',
        },
    
    ],
});

const buscar = async () => {

    let cod_paraca = formulario.codigo_paracaidista.value;
console.log(cod_paraca);

    const url = `/paracaidistas/API/control/buscar?cod_paraca=${cod_paraca}`;
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


btnBuscar.addEventListener('click', buscar);