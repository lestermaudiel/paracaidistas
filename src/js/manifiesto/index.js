import { Dropdown } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import Swal from "sweetalert2";
import { validarFormulario, Toast, confirmacion } from "../funciones";
import { get, param } from "jquery";
import csv from "csvtojson";
import Papa from "papaparse"
const formulario = document.getElementById('formularioManifiesto');
const inputJefe = document.getElementById('inputJefe');
const btnGuardar = document.getElementById('btnGuardar');
const inputParacaidista = document.getElementById('identificacion_paracaidista');

const maniTipoSalto = document.getElementById('mani_tipo_salto');
const camposAdicionales = document.querySelector('.ocultar-campos');
const divOculto = document.getElementById('ocultar-campos')
let contador = 1;

const datatable = new Datatable('#tablaManifiesto', {
    language: lenguaje,
    data: null,
    columns: [
        { title: 'NO', render: () => contador++ },
        { title: 'Plan de trabajo', data: 'mani_plan_trabajo' },
        { title: 'No. Avion', data: 'mani_no_avion' },
        { title: 'Vuelo', data: 'mani_no_vuelo' },
        { title: 'Tipo de Salto', data: 'tipo_salto_detalle' },
        { title: 'Fecha Manifiesto', data: 'mani_fecha' },
        { title: 'Altura de Salto', data: 'mani_altura' },
        { title: 'Jefe', data: 'nombre_jefe' },


        {
            title: 'ASIGNAR PARACAIDISTAS',
            data: 'mani_id',
            searchable: false, orderable: false,
            render: (data) => `<input type='file' class='btn btn-success' style='width: 220px' data-id='${data}' />`
        },
        {
            title: 'APROBAR',
            data: 'mani_id',
            searchable: false, orderable: false,
            render: (data) => `<button class="btn btn-warning" data-id='${data}'>APROBAR</button>`
        },
        {
            title: 'DENEGAR',
            data: 'mani_id',
            searchable: false, orderable: false,
            render: (data) => `<button class="btn btn-danger" data-id='${data}'>DENEGAR</button>`
        },


    ],
});


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

    const url = '/paracaidistas/API/manifiesto/buscar';


    const config = {
        method: 'GET',
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        console.log(data)
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

    const formData = new FormData(formulario);
    const url = '/paracaidistas/API/manifiesto/guardar';

    for (var pair of formData.entries()) {
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

            setTimeout(() => {
                location.reload();
            }, 1000);
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


const asignarParacaidas = async (evento) => {
    evento.preventDefault();
    const fileInput = evento.target;
    const id = fileInput.dataset.id;

    if (fileInput.files.length > 0) {
        const file = fileInput.files[0];

        let json = new Promise((resolve, reject) => {
            Papa.parse(file, {
                header: true,
                complete(results) {
                    console.log(results.data)
                    const array = results.data.filter(function (dato) {
                        return dato['catalogo'] != ''
                    });

                    resolve(array)
                },
                error(err) {
                    reject(err)
                }
            })
        })

        let paracaidistas = await json;
        var dataCell = ""
        const tabla = await Promise.all(
            paracaidistas.map(async (p) => {

                const disponible = await getSaltosDisponibles(p['paracaidas'])
                console.log(disponible)
                var cellColor = ""
                if (disponible > 1000) {
                    cellColor = 'background:#004dcf;';
                } else if (disponible > 100 && disponible <= 1000) {
                    cellColor = 'background:#8bc34a;';
                } else if (disponible > 50 && disponible <= 100) {
                    cellColor = 'background:#fccb00;';
                } else if (disponible > 1 && disponible <= 50) {
                    cellColor = 'background:#ff9800;';
                } else if (disponible <= 0) {
                    cellColor = 'background:#ff001f;';
                }

                console.log(cellColor)
                dataCell += `
                <tr>
                    <td>${p['catalogo']}</td>
                    <td style=${cellColor}>${p['paracaidas']}</td>
                    <td>${p['altimetro']}</td>
                    <td>${p['stick']}</td>
                </tr>
            `}))

        const tableHTML = `
            <table class="table">
                <thead>
                    <tr>
                        <th>Catalogo</th>
                        <th>Paracaidas</th>
                        <th>Altimetro</th>
                        <th>Stick</th>
                    </tr>
                </thead>
                <tbody>
                        ${dataCell}
                </tbody>
            </table>`;
        Swal.fire({
            title: 'Datos a guardar',
            html: tableHTML,
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Guardar',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                guardarDatos(id, paracaidistas);
            }
        });
    }
};

const getSaltosDisponibles = async (paracaidas) => {
    console.log(paracaidas)

    const url = `/paracaidistas/API/manifiesto/getSaltos?paracaidas=${paracaidas}`;


    const config = {
        method: 'GET'
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        console.log(data)
        return data[0]['disponible']
    } catch (error) {
        console.log(error);
    }
}

const guardarDatos = async (id, paracaidistas) => {
    for (const paracaidista of paracaidistas) {
        const formData = new FormData();
        formData.append("detalle_paracaidista", paracaidista['catalogo'])
        formData.append("detalle_paracaidas", paracaidista['paracaidas'])
        formData.append("detalle_altimetro", paracaidista['altimetro'])
        formData.append("detalle_mani_id", id)
        formData.append("detalle_stick", paracaidista['stick'])

        const url = '/paracaidistas/API/manifiesto/guardarDetalle';

        const config = {
            method: 'POST',
            body: formData
        };

        try {
            const respuesta = await fetch(url, config);
            const data = await respuesta.json();
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
    }
};




const aprobar = async (e) => {
    const button = e.target;
    const id = button.dataset.id;

    if (await confirmacion('warning', '¿Desea aprobar este manifiesto?')) {
        const body = new FormData();
        body.append('mani_id', id);
        const url = '/paracaidistas/API/manifiesto/aprobar';
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

    }
};

const denegar = async (e) => {
    const button = e.target;
    const id = button.dataset.id;

    if (await confirmacion('warning', '¿Desea denegar este manifiesto?')) {
        const body = new FormData();
        body.append('mani_id', id);
        const url = '/paracaidistas/API/manifiesto/denegar';
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

    }
};
maniTipoSalto.addEventListener('change', function (e) {
    const select = e.target
    const selectedValue = select.value;
    if (selectedValue === '9') {
        divOculto.style.display = "none";
    } else {
        divOculto.style.display = "block";
    }



});

buscar();

formulario.addEventListener('submit', guardar);
datatable.on('click', '.btn-warning', aprobar);
datatable.on('click', '.btn-danger', denegar);
inputJefe.addEventListener('change', getJefeSalto);
datatable.on('change', '.btn-success', (e) => {
    console.log("Here")
    asignarParacaidas(e)
});


