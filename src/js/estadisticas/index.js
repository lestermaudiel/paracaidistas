import { Dropdown } from "bootstrap";
import Swal from "sweetalert2";
import Chart from "chart.js/auto";
import { Toast } from "../funciones";

import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";

/* Canvas para las divisiones de los gráficos y evitar conflictos */
const canvas = document.getElementById("chartparacaidas");
const canvasTipoParacaidas = document.getElementById("chartTipoParacaidas");
const canvasCaducidad = document.getElementById("chartCaducidad");
const canvasSaltos = document.getElementById("chartSaltos");


const btnActualizar = document.getElementById("btnActualizar");

const context = canvas.getContext("2d");
const contextTipoParacaidas = canvasTipoParacaidas.getContext("2d");
const contextCaducidad = canvasCaducidad.getContext("2d");
const contextSaltos = canvasSaltos.getContext("2d");

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
      data.forEach((registro) => {
        chartparacaidas.data.labels.push(registro.categoria);
        chartparacaidas.data.datasets[0].data.push(registro.cantidad);
        chartparacaidas.data.datasets[0].backgroundColor.push(getRandomColor());
      });

      chartparacaidas.update();
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


const chartTipoParacaidas = new Chart(contextTipoParacaidas, {
  type: "bar",
  data: {
    labels: [],
    datasets: [
      {
        label: "Tipo de Paracaídas",
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

const getTipoParacaidas = async () => {
  const url = `/paracaidistas/API/estadisticas/getTipoParacaidas`;
  const config = {
    method: "GET",
  };

  try {
    const request = await fetch(url, config);
    const data = await request.json();

    console.log("Respuesta JSON (Tipo de Paracaídas):", data);
    chartTipoParacaidas.data.labels = [];
    chartTipoParacaidas.data.datasets[0].data = [];
    chartTipoParacaidas.data.datasets[0].backgroundColor = [];

    if (data && Object.keys(data).length > 0) {
      data.forEach((registro) => {
        chartTipoParacaidas.data.labels.push(registro.tipo_paracaida);
        chartTipoParacaidas.data.datasets[0].data.push(registro.cantidad);
        chartTipoParacaidas.data.datasets[0].backgroundColor.push(getRandomColor());
      });

      chartTipoParacaidas.update();
    } else {
      Toast.fire({
        title: "No se encontraron registros para Tipo de Paracaídas",
        icon: "info",
      });
    }
  } catch (error) {
    console.error("Error al obtener estadísticas de Tipo de Paracaídas:", error);
    Toast.fire({
      title: "Error al obtener estadísticas de Tipo de Paracaídas",
      icon: "error",
    });
  }
};


const chartCaducidad = new Chart(contextCaducidad, {
  type: "bar",
  data: {
    labels: [],
    datasets: [
      {
        label: "Disponibilidad por Fecha de Caducidad",
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

const chartSaltos = new Chart(contextSaltos, {
  type: "bar",
  data: {
    labels: [],
    datasets: [
      {
        label: "Disponibilidad por Saltos",
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


const getCaducidadParacaidas = async () => {
  const url = `/paracaidistas/API/estadisticas/getCaducidadParacaidas`;
  const config = {
    method: "GET",
  };

  try {
    const request = await fetch(url, config);
    const data = await request.json();

    console.log("Respuesta JSON (Fecha de Caducidad):", data);
    chartCaducidad.data.labels = [];
    chartCaducidad.data.datasets[0].data = [];
    chartCaducidad.data.datasets[0].backgroundColor = [];

    if (data && data.hasOwnProperty('tiempo_caducidad') && data.hasOwnProperty('cantidad')) {
      // Procede con el bucle forEach
      chartCaducidad.data.labels.push(data.tiempo_caducidad);
      chartCaducidad.data.datasets[0].data.push(data.cantidad);
      chartCaducidad.data.datasets[0].backgroundColor.push(getRandomColor());

      chartCaducidad.update();
    } else {
      Toast.fire({
        title: "No se encontraron registros para Fecha de Caducidad",
        icon: "info",
      });
    }
  } catch (error) {
    console.error("Error al obtener estadísticas de Fecha de Caducidad:", error);
    Toast.fire({
      title: "Error al obtener estadísticas de Fecha de Caducidad",
      icon: "error",
    });
  }
};

const getSaltosDisponibilidad = async () => {
  const url = `/paracaidistas/API/estadisticas/getSaltosDisponibilidad`;
  const config = {
    method: "GET",
  };

  try {
    const request = await fetch(url, config);
    const data = await request.json();

    console.log("Respuesta JSON (Saltos Disponibilidad):", data);
    chartSaltos.data.labels = [];
    chartSaltos.data.datasets[0].data = [];
    chartSaltos.data.datasets[0].backgroundColor = [];

    if (data && Object.keys(data).length > 0) {
      data.forEach((registro) => {
        chartSaltos.data.labels.push(registro.disponibilidad_saltos);
        chartSaltos.data.datasets[0].data.push(registro.cantidad);
        chartSaltos.data.datasets[0].backgroundColor.push(getRandomColor());
      });

      chartSaltos.update();
    } else {
      Toast.fire({
        title: "No se encontraron registros para Disponibilidad por Saltos",
        icon: "info",
      });
    }
  } catch (error) {
    console.error("Error al obtener estadísticas de Disponibilidad por Saltos:", error);
    Toast.fire({
      title: "Error al obtener estadísticas de Disponibilidad por Saltos",
      icon: "error",
    });
  }
};

btnActualizar.addEventListener('click', async () => {
  await getEstadisticas();
  await getTipoParacaidas();
  await getCaducidadParacaidas();
  await getSaltosDisponibilidad();
});