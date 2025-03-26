<template>
  <section class="pb-8 pt-4 bg-blue-950/80">
    <div class="container mx-auto px-6">
      <div class="flex flex-wrap items-center justify-between gap-4">
        <div class="flex flex-wrap gap-2">
          <template v-if="!showDropdown">
            <button 
              v-for="(date, index) in visibleDates" 
              :key="index"
              :class="[
                'px-4 py-2 rounded-full text-sm font-medium transition',
                selectedDate === date
                  ? 'bg-blue-600 text-white' 
                  : 'bg-blue-900/60 text-blue-300 hover:bg-blue-800'
              ]"
              @click="handleDateClick(date)"
            >
              {{ date }}
            </button>

            <!-- Botón para activar el dropdown -->
            <button 
              class="px-4 py-2 rounded-full text-sm font-medium transition bg-blue-900/60 text-blue-300 hover:bg-blue-800"
              @click="showDropdown = true"
            >
              Totes les dates
            </button>
          </template>

          <!-- Dropdown con todas las fechas -->
          <select 
            v-else 
            v-model="selectedDate"
            class="bg-blue-900/60 text-blue-300 px-4 py-2 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
            @change="handleDropdownChange"
          >
            <option v-for="date in dates" :key="date" :value="date">
              {{ date }}
            </option>
          </select>
        </div>

        <div class="flex gap-2">
          <select 
            v-model="selectedGenre"
            class="bg-blue-900/60 text-blue-300 px-4 py-2 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
          >
            <option value="">Tots els gèneres</option>
            <option v-for="genre in genres" :key="genre.value" :value="genre.value">
              {{ genre.label }}
            </option>
          </select>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';

// Función para formatear fechas en catalán
const formatDate = (date) => {
  return new Intl.DateTimeFormat('ca-ES', { weekday: 'long', day: 'numeric', month: 'long' }).format(date);
};

const selectedDate = ref('');
const selectedGenre = ref('');
const dates = ref([]);

const showDropdown = ref(false);

// Calcular "Avui" y "Demà" dinámicamente
const today = formatDate(new Date()); // "dimecres, 27 març"
const tomorrow = formatDate(new Date(Date.now() + 86400000)); // Suma 1 día en milisegundos

const visibleDates = computed(() => {
  return dates.value.slice(0, 2);
});

// Manejar selección desde botones
const handleDateClick = (date) => {
  selectedDate.value = date;
  showDropdown.value = false;
};

// Manejar selección desde dropdown
const handleDropdownChange = () => {
  showDropdown.value = false; // Cierra el desplegable después de seleccionar
};

onMounted(async () => {
  try {
    const response = await fetch('http://localhost:8000/api/dates'); 
    const data = await response.json();
    dates.value = [today, tomorrow, ...data]; // Añade "Avui" y "Demà" antes de los datos de la API
  } catch (error) {
    console.error('Error al obtener las fechas:', error);
  }
});
</script>
