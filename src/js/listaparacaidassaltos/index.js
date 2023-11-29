import { Dropdown } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import Swal from "sweetalert2";
import { validarFormulario, Toast, confirmacion } from "../funciones";

let contador = 1;
const datatable = new Datatable('#tablaListaParacaidassaltos', {
    language: lenguaje,
    data: null,
    columns: [
        {
            title: 'NO.',
            render: () => contador++
        },
        {
            title: 'Cúpula',
            data: 'cupula',
        },
        {
            title: 'Arnés',
            data: 'arnes',
        },
        {
            title: 'Tipo de Paracaídas',
            data: 'tipo_paracaidas',
        },
        {
            title: 'Saltos Total',
            data: 'saltos_totales',
        },
        {
            title: 'Saltos Uso',
            data: 'saltos_uso',
        },
        {
            title: 'Fecha Caducidad',
            data: 'fecha_caducidad',
        },
        {
            title: 'Saltos Diponibles',
            data: 'saltos_disponibles',
            createdCell: function (td, cellData, rowData, row, col) {
                if (cellData > 1000) {
                    $(td).css('background-color', 'lightgreen');
                } else if (cellData > 100 && cellData <= 1000) {
                    $(td).css('background-color', 'yellow');
                } else if (cellData > 50 && cellData <= 100) {
                    $(td).css('background-color', 'orange');
                } else if (cellData <= 50) {
                    $(td).css('background-color', 'red');
                }
            }
        },
        {
            title: 'Fecha Caducidad',
            data: 'fecha_caducidad',
            createdCell: function (td, cellData, rowData, row, col) {
                // cellData es la fecha caducidad formateada
                // Agrega tu lógica de colores aquí para la fecha

                // Convierte la fecha formateada a un objeto Date
                const fechaCaducidad = new Date(cellData);

                // Obtiene la fecha actual
                const fechaActual = new Date();

                // Calcula la diferencia en milisegundos
                const diferenciaMilisegundos = fechaCaducidad - fechaActual;

                // Calcula la diferencia en días
                const diferenciaDias = diferenciaMilisegundos / (1000 * 60 * 60 * 24);

                // Aplica colores basándote en la lógica que mencionaste
                if (diferenciaDias > 365) {
                    $(td).css('background-color', 'lightgreen'); // Más de un año: verde
                } else if (diferenciaDias > 180) {
                    $(td).css('background-color', 'yellow'); // Más de 6 meses: amarillo
                } else if (diferenciaDias > 90) {
                    $(td).css('background-color', 'orange'); // De 6 meses a 3 meses: naranja
                } else {
                    $(td).css('background-color', 'red'); // Menos de 3 meses: rojo
                }
            }
        },
    ],
});

const buscar = async () => {
    const url = `/paracaidistas/API/listaparacaidassaltos/buscar`;
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
