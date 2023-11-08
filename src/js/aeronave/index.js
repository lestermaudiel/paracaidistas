import Swal from "sweetalert2";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.querySelector('form');
const tablaAeronave = document.getElementById('tablaAeronave');
const btnBuscar = document.getElementById('btnBuscar');
const btnModificar = document.getElementById('btnModificar');
const btnGuardar = document.getElementById('btnGuardar');
const btnCancelar = document.getElementById('btnCancelar');
const divTabla = document.getElementById('divTabla');

btnModificar.disabled = true;
btnModificar.parentElement.style.display = 'none';
btnCancelar.disabled = true;
btnCancelar.parentElement.style.display = 'none';

const guardar = async (evento) => {
    evento.preventDefault();
    if (!validarFormulario(formulario, ['aer_desc_aeronave', 'aer_tip_ala'])) {
        Toast.fire({
            icon: 'info',
            text: 'Debe llenar todos los datos'
        });
        return;
    }

    const body = new FormData(formulario);
    body.delete('aeronave_id');
    const url = '/paracaidistas/API/aeronave/guardar';
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
                formulario.reset();
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
};

const buscar = async () => {
    let aer_desc_aeronave = formulario.aer_desc_aeronave.value;
    let aer_tip_ala = formulario.aer_tip_ala.value;
    const url = `/paracaidistas/API/aeronave/buscar?aer_desc_aeronave=${aer_desc_aeronave}&aer_tip_ala=${aer_tip_ala}`;
    const config = {
        method: 'GET'
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

        tablaAeronave.tBodies[0].innerHTML = '';
        const fragment = document.createDocumentFragment();

        if (data.length > 0) {
            let contador = 1;
            data.forEach(aeronave => {
                const tr = document.createElement('tr');

                const td1 = document.createElement('td');
                td1.innerText = contador;
                const td2 = document.createElement('td');
                td2.innerText = aeronave.aer_desc_aeronave;
                const td3 = document.createElement('td');
                td3.innerText = aeronave.aer_tip_ala;
                const td4 = document.createElement('td');
                const td5 = document.createElement('td');
                
                const buttonModificar = document.createElement('button');
                const buttonEliminar = document.createElement('button');

                buttonModificar.classList.add('btn', 'btn-warning');
                buttonEliminar.classList.add('btn', 'btn-danger');
                buttonModificar.textContent = 'Modificar';
                buttonEliminar.textContent = 'Eliminar';

                buttonModificar.addEventListener('click', () => colocarDatos(aeronave));
                buttonEliminar.addEventListener('click', () => eliminar(aeronave.aer_tip_registro));

                td4.appendChild(buttonModificar);
                td5.appendChild(buttonEliminar);

                tr.appendChild(td1);
                tr.appendChild(td2);
                tr.appendChild(td3);
                tr.appendChild(td4);
                tr.appendChild(td5);
                

                fragment.appendChild(tr);

                contador++;
            });
        } else {
            const tr = document.createElement('tr');
            const td = document.createElement('td');
            td.innerText = 'No existen registros';
            td.colSpan = 5;
            tr.appendChild(td);
            fragment.appendChild(tr);
        }

        tablaAeronave.tBodies[0].appendChild(fragment);
    } catch (error) {
        console.log(error);
    }
};

const colocarDatos = (datos) => {
    formulario.aer_desc_aeronave.value = datos.aer_desc_aeronave;
    formulario.aer_tip_ala.value = datos.aer_tip_ala;
    formulario.aeronave_id.value = datos.aer_tip_registro;

    btnGuardar.disabled = true;
    btnGuardar.parentElement.style.display = 'none';
    btnBuscar.disabled = true;
    btnBuscar.parentElement.style.display = 'none';
    btnModificar.disabled = false;
    btnModificar.parentElement.style.display = '';
    btnCancelar.disabled = false;
    btnCancelar.parentElement.style.display = '';
    divTabla.style.display = 'none';
};

const cancelarAccion = () => {
    btnGuardar.disabled = false;
    btnGuardar.parentElement.style.display = '';
    btnBuscar.disabled = false;
    btnBuscar.parentElement.style.display = '';
    btnModificar.disabled = true;
    btnModificar.parentElement.style.display = 'none';
    btnCancelar.disabled = true;
    btnCancelar.parentElement.style.display = 'none';
    divTabla.style.display = '';
};

const modificar = async () => {
    if (!validarFormulario(formulario)) {
        Toast.fire({
            icon: 'info',
            text: 'Debe llenar todos los campos'
        });
        return;
    }

    const body = new FormData(formulario);
    const url = '/paracaidistas/API/aeronave/modificar';
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
                formulario.reset();
                icon = 'success';
                buscar();
                cancelarAccion();
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
};

const eliminar = async (id) => {
    if (await confirmacion('warning', '¿Desea eliminar este registro?')) {
        const body = new FormData();
        body.append('aeronave_id', id);
        const url = '/paracaidistas/API/aeronave/eliminar';
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
                    buscar();
                    icon = 'success';
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

buscar();
formulario.addEventListener('submit', guardar);
btnBuscar.addEventListener('click', buscar);
btnCancelar.addEventListener('click', cancelarAccion);
btnModificar.addEventListener('click', modificar);
