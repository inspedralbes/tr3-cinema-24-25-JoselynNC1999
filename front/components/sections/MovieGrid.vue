<template>
  <div class="container mx-auto px-2 md:px-4 lg:px-6">
    <div v-if="movieStore.loading" class="text-center text-blue-200 text-lg">Carregant pel·licules...</div>
    <div v-else-if="movieStore.error" class="text-center text-red-500 text-lg">{{ movieStore.error }}</div>
    
    <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
      <div 
        v-for="movie in movieStore.regularMovies" 
        :key="movie.id" 
        class="bg-blue-900/40 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow"
      >
        <div class="relative h-64 bg-blue-800">
          <!-- Mostrar imagen de la película correctamente -->
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
          
          <!-- Mostrar sesiones -->
          <div v-if="sessionsForMovie(movie.id).length" class="mb-3">
            <span class="text-blue-300 text-sm font-medium">Sesiones:</span>
            <ul class="text-blue-200 text-sm">
              <li v-for="(session, index) in sessionsForMovie(movie.id)" :key="index">
                🕒 {{ session.date }} - {{ session.time }}
              </li>
            </ul>
          </div>
          <div v-else class="text-sm text-red-500">
            No hay sesiones disponibles para esta película.
          </div>
          
          <button 
            class="w-full bg-blue-600 hover:bg-blue-700 py-2 rounded-full transition transform hover:scale-105 text-white font-semibold"
            @click="buyTicket(movie)"
          >
            <NuxtLink :to="`/movies/${movie.id}`" class="block w-full bg-blue-600 hover:bg-blue-700 py-2 rounded-full transition-transform hover:scale-105 text-center text-white font-semibold">
              Comprar entrades
            </NuxtLink>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted, computed } from 'vue'
import { useMovieStore } from '@/stores/movies'
import { useSessionStore } from '@/stores/sessions'

const movieStore = useMovieStore()
const sessionStore = useSessionStore()

// Función para obtener las sesiones de una película específica
const sessionsForMovie = (movieId) => {
  // Filtrar las sesiones que correspondan a la película
  return sessionStore.sessions.filter(session => session.movie_id === movieId)
}

// Función para comprar entradas (por ahora solo loguea la película)
const buyTicket = (movie) => {
  console.log(`Comprando entradas para ${movie.title}`)
}

// Cargar las películas y sesiones cuando se monta el componente
onMounted(async () => {
  if (movieStore.regularMovies.length === 0) {
    await movieStore.fetchMovies() // Cargar películas si no están en el store
  }

  // Cargar las sesiones para todas las películas
  for (const movie of movieStore.regularMovies) {
    if (!sessionStore.sessions.some(session => session.movie_id === movie.id)) {
      await sessionStore.fetchSessions(movie.id) // Obtener sesiones por película
    }
  }
})
</script>

<style scoped>
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
