<script setup>
import { ref, watch, onMounted } from 'vue';
import { useTheaterStore } from '@/stores/theater';
import { useSessionStore } from '@/stores/sessions';

const theaterStore = useTheaterStore();
const sessionStore = useSessionStore();

const selectedMovie = ref(null);
const selectedSession = ref(null);

onMounted(() => {
  sessionStore.fetchAllSessions();
});

watch(selectedSession, (newSession) => {
  if (newSession) {
    theaterStore.fetchOccupiedSeats(newSession.id);
  }
});
</script>

<template>
  <div class="p-6 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Asientos Ocupados</h2>

    <!-- Selección de película -->
    <label class="block mb-2 font-semibold">Seleccionar película:</label>
    <select v-model="selectedMovie" class="border rounded p-2 w-full">
      <option v-for="session in sessionStore.sessions" :key="session.id" :value="session.movie.id">
        {{ session.movie.title }}
      </option>
    </select>

    <!-- Selección de sesión -->
    <label class="block mt-4 mb-2 font-semibold">Seleccionar sesión:</label>
    <select v-model="selectedSession" class="border rounded p-2 w-full" :disabled="!selectedMovie">
      <option v-for="session in sessionStore.sessions.filter(s => s.movie.id === selectedMovie)" 
              :key="session.id" :value="session">
        {{ session.date }} - {{ session.time }}
      </option>
    </select>

    <!-- Tabla de asientos ocupados -->
    <div v-if="theaterStore.occupiedSeats.length" class="mt-6">
      <h3 class="text-xl font-semibold mb-2">Lista de Asientos Ocupados</h3>
      <table class="w-full border-collapse border">
        <thead>
          <tr class="bg-gray-100">
            <th class="border p-2">Fila</th>
            <th class="border p-2">Número</th>
            <th class="border p-2">Estado</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="seat in theaterStore.occupiedSeats" :key="seat.id" class="text-center">
            <td class="border p-2">{{ seat.row }}</td>
            <td class="border p-2">{{ seat.seat }}</td>
            <td class="border p-2 text-red-600">Ocupado</td>
          </tr>
        </tbody>
      </table>
    </div>
    <p v-else class="mt-4 text-gray-500">No hay asientos ocupados para esta sesión.</p>
  </div>
</template>
