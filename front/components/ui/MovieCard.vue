<template>
  <div class="bg-blue-900/40 rounded-lg overflow-hidden shadow-lg hover:shadow-blue-500/50 transition-all hover:-translate-y-2 group">
    <div class="relative h-80 overflow-hidden">
      <img :src="poster_url" :alt="title" class="absolute inset-0 w-full h-full object-cover" />

      <!-- Otros elementos -->
    </div>

    <div class="p-4">
      <div class="flex justify-between items-start mb-2">
        <h3 class="font-bold text-lg">{{ title }}</h3>
        <div class="flex text-yellow-400 text-sm">
          <span v-for="n in rating" :key="n">★</span>
          <span v-for="n in 5 - rating" :key="`empty-${n}`" class="text-blue-700">★</span>
        </div>
      </div>
      <p class="text-blue-200 text-sm mb-2">{{ genre }} | {{ duration }} min</p>
      <p class="text-blue-300 text-sm mb-4 line-clamp-2">{{ description }}</p>

      <div class="grid grid-cols-3 gap-2 mb-4">
        <div v-for="(time, index) in showtimes" :key="index" class="text-center py-1 px-2 bg-blue-800/50 rounded-md hover:bg-blue-700/50 cursor-pointer">
          {{ time }}
        </div>
      </div>

      <!-- Button to navigate to selection page -->
      <NuxtLink :to="`/movies/${id}`" class="w-full bg-blue-600 hover:bg-blue-700 py-2 rounded-full transition-transform hover:scale-105" @click="handleSelectMovie">
        Comprar entradas
      </NuxtLink>
    </div>
  </div>
</template>

<script setup>
import { useTheaterStore } from '@/stores/theater'; // Importar el store de teatro
import { useRouter } from 'vue-router'; // Usar Vue Router para la navegación

defineProps({
  title: String,
  description: String,
  genre: String,
  duration: Number,
  rating: {
    type: Number,
    default: 4
  },
  ageRating: {
    type: String,
    default: 'TP'
  },
  badge: String,
  badge3d: String,
  badgeVip: String,
  isVOSE: {
    type: Boolean,
    default: false
  },
  showtimes: {
    type: Array,
    default: () => ['16:30', '19:15', '22:00']
  },
  poster_url: String,
  id: {
    type: Number,
    required: true
  }
});

// Usar el store de teatro
const theaterStore = useTheaterStore();
const router = useRouter();

// Función para manejar la selección de la película
const handleSelectMovie = () => {
  console.log("Película seleccionada:", id); // Asegurarte de que el ID esté llegando correctamente
  theaterStore.currentMovie = {
    id,
    title,
    description,
    genre,
    duration,
    rating,
    ageRating,
    poster_url
  };
  console.log("Película guardada en el store:", theaterStore.currentMovie);

  // Redirigir al usuario a la página de selección de asientos
  router.push(`/movies/${id}`);
};
</script>
