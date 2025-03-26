<template>
  <section class="py-16">
    <div class="container mx-auto px-6">
      <h2 class="text-3xl md:text-4xl font-bold mb-2 text-center">{{ title }}</h2>
      <p class="text-blue-300 text-center mb-12">{{ subtitle }}</p>

      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <div 
          v-for="movie in topMovies"
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

      <div v-if="showAllLink" class="text-center mt-10">
        <NuxtLink 
          :to="showAllLink" 
          class="inline-block border-2 border-blue-400 hover:bg-blue-800 text-white font-semibold py-2 px-8 rounded-full transition-transform hover:scale-105">
          {{ showAllText }}
        </NuxtLink>
      </div>
    </div>
  </section>
</template>

<script setup>
import { computed, onMounted } from 'vue'
import { useMovieStore } from '@/stores/movies'
import { useSessionStore } from '@/stores/sessions'
import MovieCard from '@/components/LandingPage/MovieCard'

const movieStore = useMovieStore()
const sessionStore = useSessionStore()

// Computed para obtener las primeras 4 películas de la cartelera
const topMovies = computed(() => movieStore.regularMovies.slice(0, 4))

// Función para obtener las sesiones de una película específica
const sessionsForMovie = (movieId) => {
  return sessionStore.sessions.filter(session => session.movie_id === movieId)
}

// Función para comprar entradas (por ahora solo loguea la película)
const buyTicket = (movie) => {
  console.log(`Comprando entradas para ${movie.title}`)
}

// Cargar las películas y sesiones cuando se monta el componente
onMounted(async () => {
  try {
    if (movieStore.regularMovies.length === 0) {
      await movieStore.fetchMovies() // Asegurar que las películas se cargan correctamente
    }

    // Cargar las sesiones para todas las películas
    for (const movie of movieStore.regularMovies) {
      if (!sessionStore.sessions.some(session => session.movie_id === movie.id)) {
        await sessionStore.fetchSessions(movie.id) // Obtener sesiones por película
      }
    }
  } catch (error) {
    console.error("Error al cargar las películas y las sesiones:", error)
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
