<template>
  <div class="min-h-screen bg-gradient-to-b from-blue-900 to-blue-800 text-white">
    <TheHeader />

    <div class="container mx-auto px-4 py-8">
      <Breadcrumb v-if="movie" :items="[
        { name: 'Inici', path: '/' },
        { name: 'Películas', path: '/movies' },
        { name: movie.title, path: '#', current: true }
      ]" />

      <div v-if="loading" class="text-center text-blue-200 text-lg">Carregant pel·lícula...</div>
      <div v-else-if="error" class="text-center text-red-500 text-lg">{{ error }}</div>

      <div v-else-if="movie" class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="md:col-span-1 flex justify-center">
          <img :src="movie.poster_url || 'https://via.placeholder.com/300x450?text=No+Image'" 
               :alt="movie.title" 
               class="rounded-lg shadow-lg w-full max-w-sm">
        </div>

        <div class="md:col-span-2">
          <h1 class="text-3xl font-bold mb-4">{{ movie.title }}</h1>
          <p class="text-blue-200 mb-2"><strong>Género:</strong> {{ movie.genre || 'No especificado' }}</p>
          <p class="text-blue-200 mb-2"><strong>Duración:</strong> {{ movie.duration }} min</p>
          <p class="text-blue-200 mb-2"><strong>Clasificación:</strong> {{ movie.ageRating || 'No disponible' }}</p>
          <p class="text-blue-200 mb-4"><strong>Descripción:</strong> {{ movie.description }}</p>

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

          <NuxtLink 
            :to="{
              path: `/seleccio-butaques/${movie.id}`,
              query: { title: movie.title, poster: movie.poster_url }
            }"
            class="w-full bg-blue-600 hover:bg-blue-700 py-2 rounded-full transition-transform hover:scale-105 text-center block py-2"
          >
            Comprar entrades
          </NuxtLink>
        </div>
      </div>
    </div>

    <PromoSection class="my-12" />
    <NewsletterSection class="mt-16" />
    <TheFooter />
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import { useRoute } from 'vue-router';
import { useMovieStore } from '@/stores/movies';
import { useSessionStore } from '@/stores/sessions';
import TheHeader from '@/components/layout/TheHeader.vue';
import Breadcrumb from '@/components/layout/Breadcrumb.vue';
import PromoSection from '@/components/layout/PromoSection.vue';
import NewsletterSection from '@/components/sections/NewsletterSection.vue';
import TheFooter from '@/components/layout/TheFooter.vue';

const route = useRoute();
const movieStore = useMovieStore();
const sessionStore = useSessionStore();

const movie = ref(null);
const loading = ref(false);
const error = ref(null);
const sessions = ref([]);

const loadMovieData = async () => {
  loading.value = true;
  error.value = null;

  try {
    const movieId = route.params.id;
    movie.value = movieStore.getMovieById(movieId) || await movieStore.fetchMovieById(movieId);
    await sessionStore.fetchSessions(movieId);
    sessions.value = sessionStore.sessions.filter(session => session.movie_id == movieId);
  } catch (err) {
    error.value = 'No se pudo cargar la película. Inténtalo más tarde.';
    console.error('Error al cargar la película:', err);
  } finally {
    loading.value = false;
  }
};

onMounted(loadMovieData);

watch(() => route.params.id, loadMovieData);
</script>
