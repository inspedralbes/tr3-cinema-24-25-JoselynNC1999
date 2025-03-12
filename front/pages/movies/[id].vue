<template>
  <div class="min-h-screen bg-gradient-to-b from-blue-900 to-blue-800 text-white">
    <TheHeader />
    <div class="container mx-auto px-4 py-8">
      <div v-if="movie" class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Poster -->
        <div class="md:col-span-1 flex justify-center">
          <img :src="movie.poster_url" :alt="movie.title" class="rounded-lg shadow-lg w-full max-w-sm">
        </div>
        
        <!-- Movie Info -->
        <div class="md:col-span-2">
          <h1 class="text-3xl font-bold mb-4">{{ movie.title }}</h1>
          <p class="text-blue-200 mb-2"><strong>Género:</strong> {{ movie.genre || 'No especificado' }}</p>
          <p class="text-blue-200 mb-2"><strong>Duración:</strong> {{ movie.duration }} min</p>
          <p class="text-blue-200 mb-2"><strong>Clasificación:</strong> {{ movie.ageRating || 'No disponible' }}</p>
          <p class="text-blue-200 mb-4"><strong>Descripción:</strong> {{ movie.description }}</p>
          
          <div class="grid grid-cols-3 gap-2 mb-4">
            <div v-for="(time, index) in movie.showtimes || []" :key="index" class="text-center py-1 px-2 bg-blue-800/50 rounded-md hover:bg-blue-700/50 cursor-pointer">
              {{ time }}
            </div>
          </div>
          
          <button class="w-full bg-blue-600 hover:bg-blue-700 py-2 rounded-full transition-transform hover:scale-105">
            Comprar entrades
          </button>
        </div>
      </div>
      
      <div v-else class="text-center py-16">
        <p class="text-xl">Carregant informació de la pel·lícula...</p>
      </div>
    </div>
    <TheFooter />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import TheHeader from '@/components/layout/TheHeader.vue';
import Breadcrumb from '@/components/layout/Breadcrumb.vue';
import MovieDetail from '~/components/Movie/MovieDetail.vue';
import Sessions from '~/components/Movie/Sessions.vue';
import RelatedMovies from '~/components/Movie/RelatedMovies.vue';
import PromoSection from '~/components/layout/PromoSection.vue';
import Comments from '~/components/Movie/Comments.vue';
import NewsletterSection from '@/components/sections/NewsletterSection.vue';
import TheFooter from '@/components/layout/TheFooter.vue';

const route = useRoute();
const movie = ref(null);

onMounted(async () => {
  try {
    const response = await fetch(`http://127.0.0.1:8000/api/movies/${route.params.id}`);
    if (!response.ok) throw new Error('Error al cargar la película');
    movie.value = await response.json();
  } catch (error) {
    console.error(error);
  }
});
</script>
