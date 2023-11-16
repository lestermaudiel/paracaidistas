import { Dropdown } from "bootstrap";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import Swal from "sweetalert2";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.getElementById('formularioParacaidista');

const inputIdentificacion = document.getElementById('identificacion');

const selectTipoPersona = document.getElementById('tipoPersona');

btnModificar.disabled = true;
btnModificar.parentElement.style.display = 'none';
btnCancelar.disabled = true;
btnCancelar.parentElement.style.display = 'none';



let contador = 1;

const datatable = new Datatable('#tablaParacaidista', {
    // Configuración de la tabla DataTable
    language: lenguaje,
    data: null,
    columns: [

//         paraca_id
// paraca_codigo
// paraca_civil_dpi
// paraca_saltos
// paraca_tipo_salto
// paraca_situación
        { title: 'NO', render: () => contador++ },
        { title: 'Militar', data: 'paraca_codigo' },
        { title: 'Nombre Militar', data: 'militar' },
        { title: 'Civil', data: 'paraca_civil_dpi' },
        { title: 'Nombre Civil', data: 'civil' },
        
        
        { title: 'ELIMINAR', 
        data: 'paraca_id',
        searchable: false, orderable: false,
          render: (data) => `<button class="btn btn-danger" data-id='${data}'>Eliminar</button>` 
        },
    ],
});

const buscar = async () => {    

    const url = `/paracaidistas/API/paracaidista/buscar`;
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

const guardar = async (evento) => {
    evento.preventDefault();

    if (!validarFormulario(formulario, ['paraca_id'])) {
        Toast.fire({
            icon: 'info',
            text: 'Debe llenar todos los datos'
        });
        return;
    }
    

    const body = new FormData(formulario);
    if(selectTipoPersona.value === 'militar'){
        body.append('paraca_codigo',inputIdentificacion.value)
    }else{
        
        body.append('paraca_civil_dpi',inputIdentificacion.value)
    }
    console.log(selectTipoPersona.value)
    for(var pair of body.entries()){
        console.log(pair[0], pair[1]);
    }
    const url = '/paracaidistas/API/paracaidista/guardar';
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

const eliminar = async (e) => {
    const button = e.target;
    const id = button.dataset.id;

    if (await confirmacion('warning', '¿Desea eliminar este registro?')) {
        const body = new FormData();
        body.append('altimetro_id', id);
        const url = '/paracaidistas/API/paracaidista/eliminar';
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
function validarTipoPersona(){
    if(selectTipoPersona.value === 'militar'){
        inputIdentificacion.placeholder='Ingrese catalogo'       
    }else{       
        inputIdentificacion.placeholder='Ingrese DPI'
    }
}
validarTipoPersona()
buscar();

selectTipoPersona.addEventListener('change',validarTipoPersona)
formulario.addEventListener('submit', guardar);
datatable.on('click', '.btn-danger', eliminar);
