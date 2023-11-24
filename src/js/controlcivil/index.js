import { Dropdown } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import Swal from "sweetalert2";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.querySelector('#formularioControlCivil');
const btnBuscar = document.querySelector('#btnBuscarCivil');
let contador = 1;

const datatable = new Datatable('#tablaControlCivil', {
    language: lenguaje,
    data: null,
    columns: [
        {
            title: 'NO.',
            render: () => contador++
        },
        {
            title: 'DPI',
            data: 'dpi_paracaidista',
        },
        {
            title: 'Paracaidista',
            data: 'nombre_paracaidista',
        },
        {
            title: 'Tipo de Salto',
            data: 'tipo_salto_detalle',
        },
        {
            title: 'Saltos Total',
            data: 'cantidad_saltos',
        },
    ],
});

const buscar = async () => {
    let dpi_paracaidista = formulario.dpi_paracaidista.value;

    const url = `/paracaidistas/API/controlcivil/buscar?dpi_paracaidista=${dpi_paracaidista}`;
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
