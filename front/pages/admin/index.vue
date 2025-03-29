<template>
  <div v-if="isLoading" class="flex items-center justify-center h-screen text-white">
    <p>Cargando...</p>
  </div>

  <div v-else-if="isAuthorized" class="flex h-screen">
    <!-- Sidebar -->
    <slideBar />

    <!-- Main Content -->
    <main class="flex-1 p-6 bg-gray-100 overflow-y-auto">
      <header class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Dashboard</h1>
        <button class="bg-blue-900 text-white px-4 py-2 rounded">Informe Setmanal</button>
      </header>

      <!-- Dashboard Grid -->
      <div class="grid grid-cols-2 gap-6">
        <!-- Resumen de ventas -->
       <!-- Resumen de ventas con desglose de ingresos -->
<div class="bg-white p-6 rounded shadow">
  <div class="flex justify-between items-center mb-4">
    <h2 class="text-lg font-bold">Resum de Vendes</h2>
    <button class="bg-blue-900 text-white px-4 py-2 rounded">Detalls</button>
  </div>

  <div class="grid grid-cols-2 gap-4">
    <div class="p-4 bg-gray-200 text-center rounded">
      <p class="text-xl font-bold text-blue-900">55€</p>
      <p class="text-sm text-gray-600">Ingressos Totals</p>
    </div>
    <div class="p-4 bg-gray-200 text-center rounded">
      <p class="text-xl font-bold text-blue-900">3</p>
      <p class="text-sm text-gray-600">Entrades Venudes</p>
    </div>
    <div class="p-4 bg-gray-200 text-center rounded">
      <p class="text-xl font-bold text-blue-900">1</p>
      <p class="text-sm text-gray-600">Sessions Avui</p>
    </div>
    <div class="p-4 bg-gray-200 text-center rounded">
      <p class="text-xl font-bold text-blue-900">25%</p>
      <p class="text-sm text-gray-600">Ocupació Mitja</p>
    </div>
  </div>

  <!-- Tabla de desglose de ingresos -->
  <div class="mt-6">
    <h3 class="text-md font-bold mb-2">Desglossament d'Ingressos</h3>
    <table class="w-full border-collapse border border-gray-300">
      <thead>
        <tr class="bg-gray-200">
          <th class="border border-gray-300 px-4 py-2 text-left">Categoria</th>
          <th class="border border-gray-300 px-4 py-2 text-right">Ingressos</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="border border-gray-300 px-4 py-2">Entrades Normals</td>
          <td class="border border-gray-300 px-4 py-2 text-right">25€</td>
        </tr>
        <tr>
          <td class="border border-gray-300 px-4 py-2">Entrades VIP</td>
          <td class="border border-gray-300 px-4 py-2 text-right">14€</td>
        </tr>
        <tr>
          <td class="border border-gray-300 px-4 py-2">Descomptes</td>
          <td class="border border-gray-300 px-4 py-2 text-right">0€</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

        <!-- Estado de asientos de la sesión 1 -->
        <div class="bg-white p-6 rounded shadow">
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold">Ocupació Sessió 1</h2>
          </div>
          <div v-if="selectedSession" class="theater-layout mt-6">
            <div class="screen">PANTALLA</div>
            <div class="seats-grid">
              <div v-for="row in rows" :key="row" class="seat-row">
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

        <!-- Películas más populares -->
        <div class="bg-white p-6 rounded shadow">
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold">Pel·lícules Més Populars</h2>
            <button class="bg-blue-900 text-white px-4 py-2 rounded">Veure Totes</button>
          </div>
          <div class="grid grid-cols-2 gap-4">
            <div v-for="(movie, index) in popularMovies" :key="index" class="p-4 bg-gray-200 text-center rounded">
              <p class="text-lg font-bold">{{ movie.title }}</p>
              <p class="text-sm text-gray-600">{{ movie.ticketsSold }} Entrades</p>
            </div>
          </div>
        </div>

        <!-- Estado de sesiones -->
        <div class="bg-white p-6 rounded shadow">
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold">Estat de Sessions</h2>
            <button class="bg-blue-900 text-white px-4 py-2 rounded">Gestionar</button>
          </div>
          <div class="grid grid-cols-2 gap-4">
            <div class="p-4 bg-gray-200 text-center rounded">
              <p class="text-xl font-bold text-blue-900">12</p>
              <p class="text-sm text-gray-600">Sessions Programades</p>
            </div>
            <div class="p-4 bg-gray-200 text-center rounded">
              <p class="text-xl font-bold text-blue-900">1</p>
              <p class="text-sm text-gray-600">Sessions Avui</p>
            </div>
            <div class="p-4 bg-gray-200 text-center rounded">
              <p class="text-xl font-bold text-blue-900">0</p>
              <p class="text-sm text-gray-600">Sessions Cancel·lades</p>
            </div>
            <div class="p-4 bg-gray-200 text-center rounded">
              <p class="text-xl font-bold text-blue-900">98%</p>
              <p class="text-sm text-gray-600">Taxa d'Execució</p>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import slideBar from '@/components/layout/slideBar' 
import { useSessionStore } from '@/stores/sessions'
import { useAuthStore } from '@/stores/auth'
import { useRouter } from 'vue-router'
import { toRaw } from 'vue'
import { ref, onMounted, watch } from 'vue'
import { useTheaterStore } from '@/stores/theater'

// Tiendas y configuración
const authStore = useAuthStore()
const router = useRouter()
const sessionStore = useSessionStore()
const theaterStore = useTheaterStore()

const isLoading = ref(true)
const isAuthorized = ref(false)
const selectedSession = ref(null)

// Obtener sesiones y la primera sesión disponible
onMounted(async () => {
  await sessionStore.fetchAllSessions()
  selectedSession.value = sessionStore.sessions[0] // Suponiendo que tomamos la primera sesión
  isLoading.value = false
})

// Lógica para mostrar ocupación de los asientos
const rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L']
const seats = Array.from({ length: 10 }, (_, i) => i + 1)

watch(selectedSession, (newSession) => {
  if (newSession) {
    theaterStore.fetchOccupiedSeats(newSession.id)
  }
})

// Verificar si un asiento está ocupado
const isSeatOccupied = (row, seatNumber) => {
  return theaterStore.occupiedSeats.some(
    occupiedSeat => occupiedSeat.row === row && occupiedSeat.seat === seatNumber
  )
}

// Verificación de autenticación
watchEffect(() => {
  const user = toRaw(authStore.user)  // Usar `toRaw` para deshacer el proxy
  
  if (!user) {
    router.push('/login')  // Si no está autenticado, redirigir al login
  } else if (user.is_admin !== 1) {
    router.push('/')  // Si no es admin, mandarlo al home
  } else {
    isAuthorized.value = true
  }
})

const popularMovies = ref([])

onMounted(async () => {
  await sessionStore.fetchAllSessions() // Cargamos todas las sesiones
  const sortedSessions = sessionStore.sessions
    .map(session => ({
      title: session.movie.title,
      ticketsSold: session.tickets_sold
    }))
    .sort((a, b) => b.ticketsSold - a.ticketsSold)
    .slice(0, 4)
  popularMovies.value = sortedSessions
})
</script>

<style scoped>
/* Estilos adicionales si es necesario */
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
  overflow-y: auto;
  max-height: 60vh;
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
