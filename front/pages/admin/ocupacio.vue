<script setup>
import { ref, watch, onMounted, computed } from 'vue'
import { useTheaterStore } from '@/stores/theater'
import { useSessionStore } from '@/stores/sessions'
import slideBar from '@/components/layout/slideBar'

const theaterStore = useTheaterStore()
const sessionStore = useSessionStore()

const selectedMovie = ref(null)
const selectedSession = ref(null)

onMounted(() => {
  sessionStore.fetchAllSessions()
})

watch(selectedSession, (newSession) => {
  if (newSession) {
    theaterStore.fetchOccupiedSeats(newSession.id)
  }
})

// Rows from A to L
const rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L']
const seats = Array.from({ length: 10 }, (_, i) => i + 1)

// Check if a seat is occupied
const isSeatOccupied = (row, seatNumber) => {
  return theaterStore.occupiedSeats.some(
    occupiedSeat => occupiedSeat.row === row && occupiedSeat.seat === seatNumber
  )
}
</script>

<template>
  <div class="admin-layout">
    <!-- Sidebar -->
    <slideBar />

    <!-- Main Content -->
    <div class="main-content p-6 bg-white rounded-lg shadow">
      <h2 class="text-2xl font-bold mb-4">Distribució de Seients</h2>

      <!-- Movie Selection -->
      <label class="block mb-2 font-semibold">Seleccionar pel·lícula:</label>
      <select v-model="selectedMovie" class="border rounded p-2 w-full">
        <option v-for="session in sessionStore.sessions" :key="session.id" :value="session.movie.id">
          {{ session.movie.title }}
        </option>
      </select>

      <!-- Session Selection -->
      <label class="block mt-4 mb-2 font-semibold">Seleccionar sessió:</label>
      <select v-model="selectedSession" class="border rounded p-2 w-full" :disabled="!selectedMovie">
        <option 
          v-for="session in sessionStore.sessions.filter(s => s.movie.id === selectedMovie)"
          :key="session.id" 
          :value="session"
        >
          {{ session.date }} - {{ session.time }}
        </option>
      </select>

      <!-- Visual Seat Representation -->
      <div v-if="selectedSession" class="theater-layout mt-6">
        <div class="screen">PANTALLA</div>
        <div class="seats-grid">
          <div 
            v-for="row in rows" 
            :key="row" 
            class="seat-row"
          >
            <div class="row-label">{{ row }}</div>
            <div 
              v-for="seat in seats" 
              :key="seat" 
              class="seat"
              :class="{
                'occupied': isSeatOccupied(row, seat),
                'available': !isSeatOccupied(row, seat)
              }"
            >
              {{ seat }}
            </div>
          </div>
        </div>
      </div>
      <p v-else-if="!selectedSession" class="mt-4 text-gray-500">
        Si us plau, selecciona una pel·lícula i una sessió.
      </p>
    </div>
  </div>
</template>

<style scoped>
.admin-layout {
  display: flex;
  height: 100vh;
}

.main-content {
  flex-grow: 1;
  padding: 20px;
  background-color: #f4f4f4;
  overflow-y: auto; /* Permite desplazamiento si el contenido es muy grande */
}

.theater-layout {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-top: 20px;
}

.screen {
  background-color: #333;
  color: white;
  text-align: center;
  padding: 10px;
  width: 100%;
  max-width: 600px;
  margin-bottom: 20px;
}

.seats-grid {
  display: flex;
  flex-direction: column;
  gap: 10px;
  max-width: 600px;
  width: 100%;
  overflow-y: auto; /* Permite scroll si hay muchas filas */
  max-height: 60vh; /* Limita la altura de la grilla de asientos */
}

.seat-row {
  display: flex;
  align-items: center;
  gap: 10px;
}

.row-label {
  font-weight: bold;
  width: 30px;
  text-align: right;
}

.seat {
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 1px solid #ccc;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.seat.available {
  background-color: #e0e0e0;
}

.seat.occupied {
  background-color: #ff4444;
  color: white;
  cursor: not-allowed;
}
</style>
