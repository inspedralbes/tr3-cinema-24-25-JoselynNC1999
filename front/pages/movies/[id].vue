<template>
  <div class="min-h-screen bg-gradient-to-b from-blue-900 to-blue-800 text-white">
    <TheHeader />

    <div class="container mx-auto px-4 py-8">
      <Breadcrumb v-if="movie" :items="[ 
        { name: 'Inici', path: '/' }, 
        { name: 'Películas', path: '/movies' }, 
        { name: movie.title, path: '#', current: true } 
      ]" />

      <!-- Cargando o error -->
      <div v-if="loading" class="text-center text-blue-200 text-lg">Carregant pel·lícula...</div>
      <div v-else-if="error" class="text-center text-red-500 text-lg">{{ error }}</div>

      <!-- Información de la película -->
      <div v-else-if="movie" class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Poster -->
        <div class="md:col-span-1 flex justify-center">
          <img :src="movie.poster_url || 'https://via.placeholder.com/300x450?text=No+Image'" 
               :alt="movie.title" 
               class="rounded-lg shadow-lg w-full max-w-sm">
        </div>

        <!-- Movie Info -->
        <div class="md:col-span-2">
          <h1 class="text-3xl font-bold mb-4">{{ movie.title }}</h1>
          <p class="text-blue-200 mb-2"><strong>Género:</strong> {{ movie.genre || 'No especificado' }}</p>
          <p class="text-blue-200 mb-2"><strong>Duración:</strong> {{ movie.duration }} min</p>
          <p class="text-blue-200 mb-2"><strong>Clasificación:</strong> {{ movie.ageRating || 'No disponible' }}</p>
          <p class="text-blue-200 mb-4"><strong>Descripción:</strong> {{ movie.description }}</p>

          <!-- Mostrar sesiones obtenidas desde Pinia -->
          <div v-if="sessions.length" class="mb-4">
            <span class="text-blue-300 text-sm font-medium">Sesiones:</span>
            <ul class="text-blue-200 text-sm">
              <li v-for="(session, index) in sessions" :key="index">
                🕒 {{ session.date }} - {{ session.time }}
              </li>
            </ul>
          </div>
          <div v-else class="text-sm text-red-500">
            No hay sesiones disponibles para esta película.
          </div>

          <!-- Botón de compra (verifica autenticación) -->
          <NuxtLink 
            v-if="isAuthenticated"
            :to="{
              path: '/seleccio-butaques',
              query: { id: movie.id, title: movie.title, poster: movie.poster_url }
            }"
            class="w-full bg-blue-600 hover:bg-blue-700 py-2 rounded-full transition-transform hover:scale-105 text-center block py-2"
            @click="buyTicket"
          >
            Comprar entrades
          </NuxtLink>

          <p v-else class="text-center text-red-500 mt-3">
            Debes iniciar sesión para comprar entradas.
          </p>
        </div>
      </div>

      <!-- Si no hay película cargada -->
      <div v-else class="text-center py-16">
        <p class="text-xl">Carregant informació de la pel·lícula...</p>
      </div>
    </div>

    <PromoSection class="my-12" />
    <NewsletterSection class="mt-16" />
    <TheFooter />
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import { useSessionStore } from '@/stores/sessions'
import { useAuthStore } from '@/stores/auth'
import { useMovieStore } from '@/stores/movies'
import TheHeader from '@/components/layout/TheHeader.vue'
import Breadcrumb from '@/components/layout/Breadcrumb.vue'
import PromoSection from '@/components/layout/PromoSection.vue'
import NewsletterSection from '@/components/sections/NewsletterSection.vue'
import TheFooter from '@/components/layout/TheFooter.vue'

const route = useRoute()
const movie = ref(null)
const loading = ref(false)
const error = ref(null)

const sessionStore = useSessionStore()
const authStore = useAuthStore()
const movieStore = useMovieStore()

const fetchMovie = async () => {
  try {
    loading.value = true
    error.value = null

    const movieId = route.params.id
    console.log(`📌 Obteniendo película con ID: ${movieId}`)

    // Obtener película desde el store
    movie.value = movieStore.getMovieById(movieId)

    if (!movie.value) {
      throw new Error('Película no encontrada en el store.')
    }

    // Seleccionar la película en el store de auth
    authStore.selectMovie(movie.value)  // Aquí se guarda la película seleccionada

    // Cargar sesiones desde el store
    sessionStore.fetchSessions(movieId)
  } catch (err) {
    error.value = 'No se pudo cargar la película. Inténtalo más tarde.'
    console.error('❌ Error:', err)
  } finally {
    loading.value = false
  }
}


// Crear un `computed()` para obtener las sesiones filtradas
const sessions = computed(() => {
  return sessionStore.sessions.filter(session => session.movie_id === movie.value?.id)
})

// Verificar si el usuario está autenticado
const isAuthenticated = computed(() => authStore.isAuthenticated)

const buyTicket = () => {
  console.log(`🎟️ Comprando entrada para ${movie.value.title}`)
}

onMounted(async () => {
  await fetchMovie();
  console.log('Película después de obtenerla:', movie.value); // Verificar que la película está correctamente asignada
});
</script>
