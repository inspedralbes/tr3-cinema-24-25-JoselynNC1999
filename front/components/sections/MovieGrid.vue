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
            <span class="text-blue-300 text-sm font-medium">Sessions:</span>
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
import { onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { useMovieStore } from '@/stores/movies'
import { useSessionStore } from '@/stores/sessions'
import { useAuthStore } from '@/stores/auth' // Importamos el store de autenticación

const movieStore = useMovieStore()
const sessionStore = useSessionStore()
const authStore = useAuthStore() // Accedemos a la autenticación
const router = useRouter()

// Función para obtener las sesiones de una película específica
const sessionsForMovie = (movieId) => {
  return sessionStore.sessions.filter(session => session.movie_id === movieId)
}

// Función para manejar la compra de entradas
const buyTicket = (movie) => {
  if (!authStore.isAuthenticated) {
    // Guardamos la película seleccionada para después
    authStore.selectMovie(movie)
    
    // Redirigimos al login
    router.push('/login')
  } else {
    // Si el usuario está autenticado, lo llevamos a la página de compra
    router.push(`/movies/${movie.id}`)
  }
}

// Cargar películas y sesiones al montar el componente
onMounted(async () => {
  if (movieStore.regularMovies.length === 0) {
    await movieStore.fetchMovies()
  }

  for (const movie of movieStore.regularMovies) {
    if (!sessionStore.sessions.some(session => session.movie_id === movie.id)) {
      await sessionStore.fetchSessions(movie.id)
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
