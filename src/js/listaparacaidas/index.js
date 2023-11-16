import { Dropdown } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import Swal from "sweetalert2";
import { validarFormulario, Toast, confirmacion } from "../funciones";

let contador = 1;
const datatable = new Datatable('#tablaListaParacaidas', {
    language: lenguaje,
    data: null,
    columns: [
        {
            title: 'NO.',
            render: () => contador++
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
            title: 'Tipo de Paracaídas',
            data: 'tipo_par_descripcion',
        },
        {
            title: 'Dias restantes',
            data: 'tiempo_restante_formateado',
        },
    ],
}

);


const buscar = async () => {
    const url = `/paracaidistas/API/listaparacaidas/buscar`;
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





buscar();