<template>
  <section class="py-12">
    <div class="container mx-auto px-6">
      <!-- Loading state -->
      <div v-if="loading" class="text-center py-8">
        Carregant pel·licules...
      </div>

      <!-- Error state -->
      <div v-else-if="error" class="text-center py-8 text-red-600">
        {{ error }}
      </div>

      <template v-else>
        <!-- Estrenos destacados -->
        <h2 class="text-2xl font-bold mb-8 flex items-center">
          <span class="bg-blue-600 w-3 h-8 mr-3 rounded-sm"></span>
          Estrenes destacades
        </h2>
          
        <!-- Grid de Pel·lícules (Estrenes) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-12">
          <MovieCard
            v-for="movie in featuredMovies"
            :key="movie.id"
            v-bind="movie"
          />
        </div>
          
        <!-- Títol Secció Regular -->
        <h2 class="text-2xl font-bold mb-8 flex items-center">
          <span class="bg-blue-600 w-3 h-8 mr-3 rounded-sm"></span>
          Cartellera 
        </h2>
          
        <!-- Grid de Pel·lícules (Regular) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
          <MovieCard
            v-for="movie in regularMovies"
            :key="movie.id"
            v-bind="movie"
          />
        </div>
          
        <!-- Paginació -->
        <PaginationControls 
          v-if="totalPages > 1"
          :total-pages="totalPages" 
          :current-page="currentPage" 
          @page-change="handlePageChange"
          class="mt-12" 
        />
      </template>
    </div>
  </section>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import MovieCard from '@/components/ui/MovieCard.vue';
import PaginationControls from '@/components/ui/PaginationControls.vue';

interface Movie {
  id: number;
  title: string;
  badge?: 'ESTRENA' | string;
  // Add other movie properties as needed
}

const featuredMovies = ref<Movie[]>([]);
const regularMovies = ref<Movie[]>([]);
const currentPage = ref(1);
const totalPages = ref(1);
const loading = ref(false);
const error = ref<string | null>(null);

const fetchMovies = async (page = 1) => {
  try {
    loading.value = true;
    error.value = null;
    
    const response = await fetch(`http://localhost:8000/api/movies?page=${page}`, {
      method: "GET",
      headers: {
        Accept: "application/json",
      },
    });

    if (!response.ok) throw new Error("Error loading movies");
    const data = await response.json();
    
    // Filter featured and regular movies
    featuredMovies.value = data.filter((movie: Movie) => movie.badge === 'ESTRENA');
    regularMovies.value = data.filter((movie: Movie) => !movie.badge || movie.badge !== 'ESTRENA');
    
    // Update pagination if meta data is available
    if (data.meta) {
      totalPages.value = data.meta.last_page;
      currentPage.value = data.meta.current_page;
    }
  } catch (err) {
    error.value = 'Error loading movies. Please try again later.';
    console.error('Error loading movies:', err);
  } finally {
    loading.value = false;
  }
};

const handlePageChange = (page: number) => {
  currentPage.value = page;
  fetchMovies(page);
};

onMounted(() => {
  fetchMovies();
});
</script>