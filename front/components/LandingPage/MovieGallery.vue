<template>
  <section class="py-16">
    <div class="container mx-auto px-6">
      <h2 class="text-3xl md:text-4xl font-bold mb-2 text-center">{{ title }}</h2>
      <p class="text-blue-300 text-center mb-12">{{ subtitle }}</p>

      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <MovieCard
          v-for="movie in topMovies"
          :key="movie.id"
          :title="movie.title"
          :rating="movie.rating"
          :genre="movie.genre"
          :duration="movie.duration"
          :poster="movie.poster_url"
          :tag="movie.badge"
          :buttonText="buttonText"
        />
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
import { computed, onMounted, watch } from 'vue'
import { useMovieStore } from '@/stores/movies'
import MovieCard from '@/components/LandingPage/MovieCard'

const movieStore = useMovieStore()

// Computed para obtener las primeras 4 películas de la cartelera
const topMovies = computed(() => movieStore.regularMovies.slice(0, 4))

onMounted(async () => {
  try {
    if (movieStore.regularMovies.length === 0) {
      await movieStore.fetchMovies() // Asegurar que las películas se cargan correctamente
    }
  } catch (error) {
    console.error("Error al cargar las películas:", error)
  }
})

// Opcional: Si fetchMovies() es reactivo, podemos usar watch para asegurarnos de que topMovies se actualiza correctamente.
watch(() => movieStore.regularMovies, () => {
  console.log("Películas actualizadas:", movieStore.regularMovies)
})

defineProps({
  title: { type: String, default: 'Properes sessions' },
  subtitle: { type: String, default: 'Les millors estrenes i pel·lícules del moment' },
  buttonText: { type: String, default: 'Comprar entrades' },
  showAllLink: { type: String, default: '/cartellera' }, // Ruta corregida per Nuxt
  showAllText: { type: String, default: 'Veure tota la cartellera' }
})
</script>