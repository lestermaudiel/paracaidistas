import { Dropdown } from "bootstrap";
import Swal from "sweetalert2";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.querySelector('form');
const tablaZonaSalto = document.getElementById('tablaZonaSalto');
const btnBuscar = document.getElementById('btnBuscar');
const btnModificar = document.getElementById('btnModificar');
const btnGuardar = document.getElementById('btnGuardar');
const btnCancelar = document.getElementById('btnCancelar');
const divTabla = document.getElementById('divTabla');

btnModificar.disabled = true
btnModificar.parentElement.style.display = 'none'
btnCancelar.disabled = true
btnCancelar.parentElement.style.display = 'none'

const guardar = async (evento) => {
    evento.preventDefault();
    if (!validarFormulario(formulario, ['zona_salto_id'])) {
        Toast.fire({
            icon: 'info',
            text: 'Debe llenar todos los datos'
        })
        return
    }

    const body = new FormData(formulario)
    body.delete('zona_salto_id')
    const url = '/paracaidistas/API/zonasalto/guardar';
    const config = {
        method: 'POST',
        body
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();

        console.log(data);
        // return

        const { codigo, mensaje, detalle } = data;
        let icon = 'info';
        switch (codigo) {
            case 1:
                formulario.reset();
                icon = 'success'
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
    let zona_salto_nombre = formulario.zona_salto_nombre.value;
    let zona_salto_latitud = formulario.zona_salto_latitud.value;
    let zona_salto_longitud = formulario.zona_salto_longitud.value;
    let zona_salto_direc_latitud = formulario.zona_salto_direc_latitud.value;
    let zona_salto_direc_longitud = formulario.zona_salto_direc_longitud.value;
    const url = `/paracaidistas/API/zonasalto/buscar?zona_salto_nombre=${zona_salto_nombre}&zona_salto_latitud=${zona_salto_latitud}&zona_salto_longitud=${zona_salto_longitud}&zona_salto_direc_latitud=${zona_salto_direc_latitud}&zona_salto_direc_longitud=${zona_salto_direc_longitud}`;
    const config = {
        method: 'GET'
    }
    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        // console.log(data)

        tablaZonaSalto.tBodies[0].innerHTML = '';
        const fragment = document.createDocumentFragment();
        console.log(data);
        // ...
        // ...
if (data.length > 0) {
    let contador = 1;
    data.forEach(zonaSalto => {
        const tr = document.createElement('tr');
        
        // Crea celdas para cada propiedad
        const td1 = document.createElement('td');
        td1.innerText = contador;
        const td2 = document.createElement('td');
        td2.innerText = zonaSalto.zona_salto_nombre;
        const td3 = document.createElement('td');
        td3.innerText = zonaSalto.zona_salto_latitud;
        const td4 = document.createElement('td');
        td4.innerText = zonaSalto.zona_salto_longitud;
        const td5 = document.createElement('td');
        td5.innerText = zonaSalto.zona_salto_direc_latitud;
        const td6 = document.createElement('td');
        td6.innerText = zonaSalto.zona_salto_direc_longitud;
        const td7 = document.createElement('td');
        const td8 = document.createElement('td');

        // Agrega botones a las celdas
        const buttonModificar = document.createElement('button');
        const buttonEliminar = document.createElement('button');
        buttonModificar.classList.add('btn', 'btn-warning');
        buttonEliminar.classList.add('btn', 'btn-danger');
        buttonModificar.textContent = 'Modificar';
        buttonEliminar.textContent = 'Eliminar';

        // Asigna eventos a los botones
        buttonModificar.addEventListener('click', () => colocarDatos(zonaSalto));
        buttonEliminar.addEventListener('click', () => eliminar(zonaSalto.zona_salto_id));

        // Agrega botones a las celdas
        td7.appendChild(buttonModificar);
        td8.appendChild(buttonEliminar);

        // Agrega las celdas a la fila
        tr.appendChild(td1);
        tr.appendChild(td2);
        tr.appendChild(td3);
        tr.appendChild(td4);
        tr.appendChild(td5);
        tr.appendChild(td6);
        tr.appendChild(td7);
        tr.appendChild(td8);

        // Agrega la fila a la tabla
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
// ...


        if (data.length > 0) {
            let contador = 1;
            data.forEach(zonaSalto => {
                const tr = document.createElement('tr');
                const td1 = document.createElement('td');
                const td2 = document.createElement('td');
                const td3 = document.createElement('td');
                const td4 = document.createElement('td');
                const td5 = document.createElement('td');
                const td6 = document.createElement('td');
                const td7 = document.createElement('td');
                const td8 = document.createElement('td');
                const buttonModificar = document.createElement('button');
                const buttonEliminar = document.createElement('button');

                buttonModificar.classList.add('btn', 'btn-warning')
                buttonEliminar.classList.add('btn', 'btn-danger')
                buttonModificar.textContent = 'Modificar'
                buttonEliminar.textContent = 'Eliminar'

                buttonModificar.addEventListener('click', () => colocarDatos(zonaSalto))
                buttonEliminar.addEventListener('click', () => eliminar(zonaSalto.zona_salto_id))

                td1.innerText = contador;
                td2.innerText = zonaSalto.zona_salto_nombre;
                td3.innerText = zonaSalto.zona_salto_latitud;
                td4.innerText = zonaSalto.zona_salto_longitud;
                td5.innerText = zonaSalto.zona_salto_direc_latitud;
                td6.innerText = zonaSalto.zona_salto_direc_longitud;
                td7.appendChild(buttonModificar);
                td8.appendChild(buttonEliminar);

                tr.appendChild(td1);
                tr.appendChild(td2);
                tr.appendChild(td3);
                tr.appendChild(td4);
                tr.appendChild(td5);
                tr.appendChild(td6);
                tr.appendChild(td7);
                tr.appendChild(td8);

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
    formulario.zona_salto_nombre.value = datos.zona_salto_nombre;
    formulario.zona_salto_latitud.value = datos.zona_salto_latitud;
    formulario.zona_salto_longitud.value = datos.zona_salto_longitud;
    formulario.zona_salto_direc_latitud.value = datos.zona_salto_direc_latitud;
    formulario.zona_salto_direc_longitud.value = datos.zona_salto_direc_longitud;
    formulario.zona_salto_id.value = datos.zona_salto_id;

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
    const url = '/paracaidistas/API/zonasalto/modificar';
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
        body.append('zona_salto_id', id)
        const url = '/paracaidistas/API/zonasalto/eliminar'; 
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

