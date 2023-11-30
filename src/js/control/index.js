import { Dropdown } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import Swal from "sweetalert2";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.querySelector('#formularioControl');
const btnBuscar = document.querySelector('#btnBuscar');

const divTotal = document.getElementById('divTotal');
const divJefe = document.getElementById('divJefe');
const divTactico = document.getElementById('divTactico');

const progresoTotal = document.getElementById('progresoTotal');
const progresoJefe = document.getElementById('progresoJefe');
const progresoTactico = document.getElementById('progresoTactico');

const divTotalMaestro = document.getElementById('divTotalMaestro');
const divJefeMaestro = document.getElementById('divJefeMaestro');
const divTacticoMaestro = document.getElementById('divTacticoMaestro');
const divNocturnoMaestro = document.getElementById('divNocturnoMaestro');

const progresoTotalMaestro = document.getElementById('progresoTotalMaestro');
const progresoJefeMaestro = document.getElementById('progresoJefeMaestro');
const progresoTacticoMaestro = document.getElementById('progresoTacticoMaestro');
const progresoNocturnoMaestro = document.getElementById('progresoNocturnoMaestro');
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
            data: 'codigo',
        },
        {
            title: 'grado',
            data: 'grado',
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

    let num_catalogo = formulario.codigo_paracaidista.value;
    console.log(num_catalogo);

    const url = `/paracaidistas/API/control/buscar?num_catalogo=${num_catalogo}`;
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
            buscarAlas()
            buscarAlasMaestro()
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

const buscarAlas = async () => {

    let num_catalogo = formulario.codigo_paracaidista.value;
    console.log(num_catalogo);

    const url = `/paracaidistas/API/control/buscarAlas?num_catalogo=${num_catalogo}`;
    const config = {
        method: 'GET'
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

        if (data) {
            var total = data[2]['porcentaje']
            var tactico = data[1]['porcentaje']
            var jefe = data[0]['porcentaje']

            progresoTotal.value += total
            progresoTactico.value += tactico
            progresoJefe.value += jefe
            divTotal.innerText = total + "%"
            divTactico.innerText = tactico + "%"
            divJefe.innerText = jefe + "%"

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


const buscarAlasMaestro = async () => {

    let num_catalogo = formulario.codigo_paracaidista.value;
    console.log(num_catalogo);

    const url = `/paracaidistas/API/control/buscarAlasMaestro?num_catalogo=${num_catalogo}`;
    const config = {
        method: 'GET'
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

        if (data) {
            var total = data[3]['porcentaje']
            var tactico = data[2]['porcentaje']
            var jefe = data[0]['porcentaje']
            var nocturno = data[1]['porcentaje']

            progresoTotalMaestro.value += total
            progresoTacticoMaestro.value += tactico
            progresoJefeMaestro.value += jefe
            progresoNocturnoMaestro.value += nocturno


            divTotalMaestro.innerText = total + "%"
            divTacticoMaestro.innerText = tactico + "%"
            divJefeMaestro.innerText = jefe + "%"
            divNocturnoMaestro.innerText = nocturno + "%"

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


document.getElementById('btnMostrarProgreso').addEventListener('click', function () {
    document.getElementById('contenedorProgreso').style.display = 'block';
});


btnBuscar.addEventListener('click', buscar);