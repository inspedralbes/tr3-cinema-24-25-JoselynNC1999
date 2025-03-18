<template>
  <div class="container mx-auto px-2 md:px-4 lg:px-6">
    <div v-if="loading" class="text-center text-blue-200 text-lg">Cargando películas...</div>
    <div v-else-if="error" class="text-center text-red-500 text-lg">{{ error }}</div>

    <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
      <div 
        v-for="movie in movies" 
        :key="movie.id" 
        class="bg-blue-900/40 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow"
      >
        <div class="relative h-64 bg-blue-800">
          <img 
            :src="movie.poster_url || 'https://via.placeholder.com/300x450?text=No+Image'"
            :alt="movie.title" 
            class="w-full h-full object-cover"
          />
        </div>
        
        <div class="p-3">
          <h3 class="font-bold text-lg mb-1 text-white">{{ movie.title }}</h3>
          <div class="flex items-center mb-1 justify-between">
            <span class="text-blue-200 text-sm">{{ movie.duration }} min</span>
          </div>
          <p class="text-blue-200 text-sm mb-3 line-clamp-2">{{ movie.description }}</p>
          
          <!-- Mostrar sesiones obtenidas desde Pinia -->
          <div v-if="sessionsByMovie[movie.id]?.length" class="mb-3">
            <span class="text-blue-300 text-sm font-medium">Sesiones:</span>
            <ul class="text-blue-200 text-sm">
              <li v-for="(session, index) in sessionsByMovie[movie.id]" :key="index">
                🕒 {{ session.date }} - {{ session.time }}
              </li>
            </ul>
          </div>
          <div v-else class="text-sm text-red-500">
            No hay sesiones disponibles para esta película.
          </div>
          
          <NuxtLink :to="`/movies/${movie.id}`" class="block w-full bg-blue-600 hover:bg-blue-700 py-2 rounded-full transition-transform hover:scale-105 text-center text-white font-semibold">
            Comprar entradas
          </NuxtLink>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import { useSessionStore } from '@/stores/sessions' // Importamos el store de sesiones

const movies = ref([])
const loading = ref(false)
const error = ref(null)

const sessionStore = useSessionStore() // Instanciamos el store de sesiones

const fetchMovies = async () => {
  try {
    loading.value = true
    error.value = null

    const response = await fetch('http://127.0.0.1:8000/api/movies', {
      method: 'GET',
      headers: { Accept: 'application/json' },
    })

    if (!response.ok) throw new Error('Error al cargar las películas')
    const data = await response.json()

    movies.value = data

    // Cargar sesiones para cada película desde Pinia
    data.forEach(movie => {
      sessionStore.fetchSessions(movie.id)
    })
  } catch (err) {
    error.value = 'Error al cargar las películas. Inténtalo más tarde.'
    console.error('Error al cargar películas:', err)
  } finally {
    loading.value = false
  }
}

// Crear un mapa de sesiones organizadas por película
const sessionsByMovie = computed(() => {
  return movies.value.reduce((acc, movie) => {
    acc[movie.id] = sessionStore.sessions.filter(session => session.movie_id === movie.id)
    return acc
  }, {})
})

onMounted(fetchMovies)
</script>

<style scoped>
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
