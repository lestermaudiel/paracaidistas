import { Dropdown } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import Swal from "sweetalert2";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.getElementById('formularioCartillaLibre');
const btnBuscar = document.getElementById('btnBuscar');




const buscar = async () => {
    let id_paracaidista = formulario.codigo_paracaidista.value;

    const url = `/paracaidistas/pdf?id_paracaidista=${id_paracaidista}`;
    const config = {
        method: 'GET'
    };

    try {
        const respuesta = await fetch(url, config);

        if (respuesta.ok) {
            const blob = await respuesta.blob();

            if (blob) {
                const urlBlob = window.URL.createObjectURL(blob);

                window.open(urlBlob, '_blank');
            } else {
                console.error('No se pudo obtener el blob del PDF.');
            }
        } else {
            console.error('Error al generar el PDF.');
        }
    } catch (error) {
        console.error(error);
    }
};

btnBuscar.addEventListener('click', buscar);
