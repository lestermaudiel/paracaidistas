import { Dropdown } from "bootstrap";
import Swal from "sweetalert2";
import Chart from "chart.js/auto";
import { Toast } from "../funciones";

/* Canvas para las divisiones de los gráficos y evitar conflictos */
const canvas = document.getElementById("chartparacaidas");

const btnActualizar = document.getElementById("btnActualizar");

const context = canvas.getContext("2d");



const chartparacaidas = new Chart(context, {
  type: "bar",
  data: {
    labels: [],
    datasets: [
      {
        label: "estados paracaidas",
        data: [],
        backgroundColor: [],
      },
    ],
  },
  options: {
    indexAxis: "x",
    scales: {
      x: {
        beginAtZero: true,
      },
      y: {
        beginAtZero: true,
      },
    },
  },
});


const getRandomColor = () => {
    const r = Math.floor(Math.random() * 256);
    const g = Math.floor(Math.random() * 256);
    const b = Math.floor(Math.random() * 256);
  
    const rgbColor = `rgba(${r},${g},${b},0.5)`;
    return rgbColor;
  };
  

  const getEstadisticas = async () => {
    const url = `/paracaidistas/API/estadisticas/getEstadisticas`;
    const config = {
      method: "GET",
    };
  
    try {
      const request = await fetch(url, config);
      const data = await request.json();
  
      console.log("Respuesta JSON:", data);
      chartparacaidas.data.labels = [];
      chartparacaidas.data.datasets[0].data = [];
      chartparacaidas.data.datasets[0].backgroundColor = [];
  
      if (data && Object.keys(data).length > 0) {
        // Iterar sobre los resultados de la consulta y agregar a los datos del gráfico
        data.forEach((registro) => {
          chartparacaidas.data.labels.push(registro.categoria);
          chartparacaidas.data.datasets[0].data.push(registro.cantidad);
          chartparacaidas.data.datasets[0].backgroundColor.push(getRandomColor());
        });
  
        chartEquipo.update();
    } else {
      Toast.fire({
        title: "No se encontraron registros",
        icon: "info",
      });
    }
} catch (error) {
    console.error("Error al obtener estadísticas:", error);
    Toast.fire({
      title: "Error al obtener estadísticas",
      icon: "error",
    });
  }
};

  
  

btnActualizar.addEventListener('click', getEstadisticas)