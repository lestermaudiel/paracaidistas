import { Dropdown } from "bootstrap";
import Swal from "sweetalert2";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.querySelector('form');
const tablaCivil = document.getElementById('tablaCivil');
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
    if (!validarFormulario(formulario, ['paracaidista_civil_dpi'])) {
        Swal.fire({
            icon: 'info',
            text: 'Debe llenar todos los datos'
        });
        return;
    }

    const body = new FormData(formulario);
    body.delete('paracaidista_civil_dpi');
    const url = '/paracaidistas/API/civil/guardar';
    const config = {
        method: 'POST',
        body
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

        console.log(data);

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
            text: mensaje,
        })
    } catch (error) {
        console.log(error);
    }
};

const buscar = async () => {
    let paracaidista_civil_dpi = formulario.paracaidista_civil_dpi.value;
    let paracaidista_civil_nombre = formulario.paracaidista_civil_nombre.value;
    let paracaidista_civil_apellidos = formulario.paracaidista_civil_apellidos.value;
    let paracaidista_civil_telefono = formulario.paracaidista_civil_apellidos.value;
    let paracaidista_civil_direccion = formulario.paracaidista_civil_direccion.value;
    let paracaidista_civil_correo_electronico = formulario.paracaidista_civil_correo_electronico.value;
    let paracaidista_civil_saltos = formulario.paracaidista_civil_correo_electronico.value;
   
    const url = `/paracaidistas/API/civil/buscar?paracaidista_civil_dpi=${paracaidista_civil_dpi}&paracaidista_civil_nombre=${paracaidista_civil_nombre}&paracaidista_civil_apellidos=${paracaidista_civil_apellidos}&paracaidista_civil_telefono=${paracaidista_civil_telefono}&paracaidista_civil_direccion=${paracaidista_civil_direccion}&paracaidista_civil_correo_electronico=${paracaidista_civil_correo_electronico}&paracaidista_civil_saltos=${paracaidista_civil_saltos}`;
    const config = {
        method: 'GET'
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

        tablaCivil.tBodies[0].innerHTML = '';
        const fragment = document.createDocumentFragment();
        console.log(data);
        
        if (data.length > 0) {
            let contador = 1;
            data.forEach(civil => {
                const tr = document.createElement('tr');
                const td1 = document.createElement('td');
                td1.innerText = contador;
                const td2 = document.createElement('td');
                td2.innerText = civil.paracaidista_civil_dpi;
                const td3 = document.createElement('td');
                td3.innerText = civil.paracaidista_civil_nombre;
                const td4 = document.createElement('td');
                td4.innerText = civil.paracaidista_civil_apellidos;
                const td5 = document.createElement('td');
                td5.innerText = civil.paracaidista_civil_telefono;
                const td6 = document.createElement('td');
                td6.innerText = civil.paracaidista_civil_direccion;
                const td7 = document.createElement('td');
                td7.innerText = civil.paracaidista_civil_correo_electronico;
                const td8 = document.createElement('td');
                td7.innerText = civil.paracaidista_civil_saltos;
                const td9 = document.createElement('td');
                const td10 = document.createElement('td');

                
                const buttonModificar = document.createElement('button');
                const buttonEliminar = document.createElement('button');
                buttonModificar.classList.add('btn', 'btn-warning');
                buttonEliminar.classList.add('btn', 'btn-danger');
                buttonModificar.textContent = 'Modificar';
                buttonEliminar.textContent = 'Eliminar';

                buttonModificar.addEventListener('click', () => colocarDatos(civil));
                buttonEliminar.addEventListener('click', () => eliminar(civil.paracaidista_civil_dpi));

                td9.appendChild(buttonModificar);
                td10.appendChild(buttonEliminar);


                tr.appendChild(td1);
                tr.appendChild(td2);
                tr.appendChild(td3);
                tr.appendChild(td4);
                tr.appendChild(td5);
                tr.appendChild(td6);
                tr.appendChild(td7);
                tr.appendChild(td8);
                tr.appendChild(td9);
                tr.appendChild(td10);

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

        tablaCivil.tBodies[0].appendChild(fragment);
 
        if (data.length > 0) {
            let contador = 1;
            data.forEach(civil => {
                const tr = document.createElement('tr');
                const td1 = document.createElement('td');
                const td2 = document.createElement('td');
                const td3 = document.createElement('td');
                const td4 = document.createElement('td');
                const td5 = document.createElement('td');
                const td6 = document.createElement('td');
                const td7 = document.createElement('td');
                const td8 = document.createElement('td');
                const td9 = document.createElement('td');
                const td10 = document.createElement('td');
                const buttonModificar = document.createElement('button');
                const buttonEliminar = document.createElement('button');

                buttonModificar.classList.add('btn', 'btn-warning')
                buttonEliminar.classList.add('btn', 'btn-danger')
                buttonModificar.textContent = 'Modificar'
                buttonEliminar.textContent = 'Eliminar'

                buttonModificar.addEventListener('click', () => colocarDatos(civil))
                buttonEliminar.addEventListener('click', () => eliminar(civil.paracaidista_civil_dpi))

                td1.innerText = contador;
                td2.innerText = civil.paracaidista_civil_dpi;
                td3.innerText = civil.paracaidista_civil_nombre;
                td4.innerText = civil.paracaidista_civil_apellidos;
                td5.innerText = civil.paracaidista_civil_telefono;
                td6.innerText = civil.paracaidista_civil_direccion;
                td7.innerText = civil.paracaidista_civil_correo_electronico;
                td8.innerText = civil.paracaidista_civil_saltos;
                td9.appendChild(buttonModificar);
                td10.appendChild(buttonEliminar);

                tr.appendChild(td1);
                tr.appendChild(td2);
                tr.appendChild(td3);
                tr.appendChild(td4);
                tr.appendChild(td5);
                tr.appendChild(td6);
                tr.appendChild(td7);
                tr.appendChild(td8);
                tr.appendChild(td9);
                tr.appendChild(td10);

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

        tablaZonaSalto.tBodies[0].appendChild(fragment);
    } catch (error) {
        console.log(error);
    }
}

const colocarDatos = (datos) => {
    formulario.paracaidista_civil_dpi.value = datos.paracaidista_civil_dpi;
    formulario.paracaidista_civil_nombre.value = datos.paracaidista_civil_nombre;
    formulario.paracaidista_civil_apellidos.value = datos.paracaidista_civil_apellidos;
    formulario.paracaidista_civil_telefono.value = datos.paracaidista_civil_telefono;
    formulario.paracaidista_civil_direccion.value = datos.paracaidista_civil_direccion;
    formulario.paracaidista_civil_correo_electronico.value = datos.paracaidista_civil_correo_electronico;
    formulario.paracaidista_civil_saltos.value = datos.paracaidista_civil_saltos;


    btnGuardar.disabled = true;
    btnGuardar.parentElement.style.display = 'none';
    btnBuscar.disabled = true;
    btnBuscar.parentElement.style.display = 'none';
    btnModificar.disabled = false;
    btnModificar.parentElement.style.display = '';
    btnCancelar.disabled = false;
    btnCancelar.parentElement.style.display = '';
    divTabla.style.display = 'none';
}


const cancelarAccion = () => {
    btnGuardar.disabled = false
    btnGuardar.parentElement.style.display = ''
    btnBuscar.disabled = false
    btnBuscar.parentElement.style.display = ''
    btnModificar.disabled = true
    btnModificar.parentElement.style.display = 'none'
    btnCancelar.disabled = true
    btnCancelar.parentElement.style.display = 'none'

    divTabla.style.display = '';
};

const modificar = async () => {
    if (!validarFormulario(formulario)) {
        alert('Debe llenar todos los campos');
        return
    }

    const body = new FormData(formulario);
    const url = '/paracaidistas/API/civil/modificar';
    const config = {
        method: 'POST',
        body,
    };

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();
        //    console.log(data);
        //    return;

        const { codigo, mensaje, detalle } = data;
        let icon = 'info'
        switch (codigo) {
            case 1:
                formulario.reset();
                icon = 'success'
                buscar();
                cancelarAccion();
                break;

            case 0:
                icon = 'error'
                console.log(detalle)
                break;

            default:
                break;
        }

        Toast.fire({
            icon,
            text: mensaje
        })
    } catch (error) {
        console.log(error);
    }
};

const eliminar = async (id) => {
    if (await confirmacion('warning', '¿Desea eliminar este registro?')) {
        const body = new FormData();
        body.append('paracaidista_civil_dpi', id)
        const url = '/paracaidistas/API/civil/eliminar';
        const config = {
            method: 'POST',
            body
        };
        try {
            const respuesta = await fetch(url, config);
            const data = await respuesta.json();
            console.log(data);

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
}

buscar();
formulario.addEventListener('submit', guardar);
btnBuscar.addEventListener('click', buscar);
btnCancelar.addEventListener('click', cancelarAccion);
btnModificar.addEventListener('click', modificar);

