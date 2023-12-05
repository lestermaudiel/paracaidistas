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
                    $(td).css('background-color', 'blue');
                } else if (cellData > 100 && cellData <= 1000) {
                    $(td).css('background-color', 'lightgreen');
                } else if (cellData > 50 && cellData <= 100) {
                    $(td).css('background-color', 'yellow');
                } else if (cellData > 1 && cellData <= 50) {
                    $(td).css('background-color', 'orange');
                }
                else if (cellData <= 0) {
                    $(td).css('background-color', 'red');
                }
            }
        },
        {
            title: 'Fecha Caducidad',
            data: 'fecha_caducidad',
            createdCell: function (td, cellData, rowData, row, col) {
                const fechaCaducidad = new Date(cellData);
                const fechaActual = new Date();
                const diferenciaMilisegundos = fechaCaducidad - fechaActual;
                const diferenciaDias = diferenciaMilisegundos / (1000 * 60 * 60 * 24);
        
                if (diferenciaDias > 365) {
                    $(td).css('background-color', 'blue'); // Más de un año: azul
                } else if (diferenciaDias > 180) {
                    $(td).css('background-color', 'green'); // Más de 6 meses: verde
                } else if (diferenciaDias > 90) {
                    $(td).css('background-color', 'yellow'); // De 6 meses a 3 meses: amarillo
                } else if (diferenciaDias > 30) {
                    $(td).css('background-color', 'orange'); // De 3 meses a 1 mes: naranja
                } else {
                    $(td).css('background-color', 'red'); // Menos de 1 mes: rojo
                }
            }
        }
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
