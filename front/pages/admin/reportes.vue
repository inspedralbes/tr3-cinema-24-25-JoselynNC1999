<template>
    <div class="container mx-auto">
      <h2 class="text-2xl font-semibold my-4">Reportes de Ocupación y Ventas</h2>
      
      <!-- Input de fecha -->
      <div class="mb-4">
        <label for="reportDate" class="block">Selecciona una fecha</label>
        <input
          v-model="date"
          type="date"
          id="reportDate"
          class="p-2 border rounded"
        />
        <button
          @click="fetchReport"
          class="bg-blue-500 text-white p-2 rounded ml-2"
        >
          Generar Reporte
        </button>
      </div>
  
      <!-- Tabla de reportes -->
      <div v-if="reportData.length" class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full table-auto">
          <thead class="bg-gray-100">
            <tr>
              <th class="px-4 py-2 text-left">Película</th>
              <th class="px-4 py-2 text-left">Asientos Ocupados</th>
              <th class="px-4 py-2 text-left">Ingresos</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(report, index) in reportData" :key="index">
              <td class="px-4 py-2">{{ report.movie_title }}</td>
              <td class="px-4 py-2">{{ report.seats_occupied }}</td>
              <td class="px-4 py-2">{{ report.total_income | currency }}</td>
            </tr>
          </tbody>
        </table>
      </div>
  
      <!-- Mensaje de error -->
      <div v-if="error" class="text-red-500 mt-4">
        {{ error }}
      </div>
    </div>
  </template>
  
  <script>
  import { ref } from 'vue';
  
  export default {
    name: 'AdminReports',
    setup() {
      const date = ref('');
      const reportData = ref([]);
      const error = ref(null);
  
      const fetchReport = async () => {
        if (!date.value) {
          error.value = "Por favor, selecciona una fecha.";
          return;
        }
  
        error.value = null;
        
        try {
          const response = await fetch(`http://127.0.0.1:8000/api/reports?date=${date.value}`);
          if (!response.ok) {
            throw new Error('No se pudo obtener el reporte');
          }
          
          const data = await response.json();
          reportData.value = data;
        } catch (err) {
          error.value = err.message;
          reportData.value = [];
        }
      };
  
      return {
        date,
        reportData,
        error,
        fetchReport
      };
    },
  };
  </script>
  
  <style scoped>
  table {
    width: 100%;
    border-collapse: collapse;
  }
  
  th, td {
    border: 1px solid #ddd;
    text-align: left;
    padding: 8px;
  }
  
  th {
    background-color: #f4f4f4;
  }
  
  button:disabled {
    background-color: #ddd;
    cursor: not-allowed;
  }
  </style>
  