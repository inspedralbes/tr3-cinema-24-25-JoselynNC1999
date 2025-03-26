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
              {{ index === 0 ? 'Avui' : index === 1 ? 'Demà' : date }}
            </button>

            <button 
              class="px-4 py-2 rounded-full text-sm font-medium transition bg-blue-900/60 text-blue-300 hover:bg-blue-800"
              @click="showDropdown = true"
            >
              Totes les dates
            </button>
          </template>

          <select 
            v-else 
            v-model="selectedDate"
            class="bg-blue-900/60 text-blue-300 px-4 py-2 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
            @change="handleDropdownChange"
          >
            <option v-for="(date, index) in dates" :key="date" :value="date">
              {{ index === 0 ? 'Avui' : index === 1 ? 'Demà' : date }}
            </option>
          </select>
        </div>

        <div class="flex gap-2">
          <select 
            v-model="selectedGenre"
            class="bg-blue-900/60 text-blue-300 px-4 py-2 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
            @change="emitGenreSelection"
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
import { ref, computed, onMounted, defineEmits } from 'vue';
import { useSessionStore } from '@/stores/sessions'; // Importar Pinia

const sessionStore = useSessionStore(); // Usar store de Pinia
const emit = defineEmits(['date-selected', 'genre-selected']);

const selectedDate = ref('');
const selectedGenre = ref('');
const showDropdown = ref(false);

const genres = ref([
  
]);

// Función para formatear fechas en catalán
const formatDate = (date) => {
  return new Intl.DateTimeFormat('ca-ES', { weekday: 'long', day: 'numeric', month: 'long' }).format(date);
};

// Obtener fechas reales para la lógica interna
const today = new Date().toISOString().split('T')[0]; // Fecha en formato YYYY-MM-DD
const tomorrow = new Date(Date.now() + 86400000).toISOString().split('T')[0];

const dates = computed(() => [today, tomorrow, ...sessionStore.dates]); // Usar fechas del store
const visibleDates = computed(() => dates.value.slice(0, 2)); // Mostrar solo las primeras dos

// Manejar selección desde botones
const handleDateClick = (date) => {
  selectedDate.value = date;
  showDropdown.value = false;
  emit('date-selected', date);
};

// Manejar selección desde dropdown
const handleDropdownChange = () => {
  showDropdown.value = false;
  emit('date-selected', selectedDate.value);
};

// Manejar selección de género
const emitGenreSelection = () => {
  emit('genre-selected', selectedGenre.value);
};

// Cargar fechas desde Pinia al montar el componente
onMounted(async () => {
  await sessionStore.fetchDates(); // Llamar al método del store para obtener las fechas
});
</script>
