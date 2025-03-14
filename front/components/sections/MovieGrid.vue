<script setup lang="ts">
import { onMounted } from 'vue'
import { useMovieStore } from '@/stores/movies'
import MovieCard from '@/components/ui/MovieCard.vue'
import PaginationControls from '@/components/ui/PaginationControls.vue'

const movieStore = useMovieStore()

const handlePageChange = (page: number) => {
  movieStore.fetchMovies(page)
}

onMounted(() => {
  movieStore.fetchMovies()
})
</script>

<template>
  <section class="py-12">
    <div class="container mx-auto px-6">
      <div v-if="movieStore.loading" class="text-center py-8">
        Carregant pel·lícules...
      </div>

      <div v-else-if="movieStore.error" class="text-center py-8 text-red-600">
        {{ movieStore.error }}
      </div>

      <template v-else>
        <h2 class="text-2xl font-bold mb-8 flex items-center">
          <span class="bg-blue-600 w-3 h-8 mr-3 rounded-sm"></span>
          Sessió d'avui
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-12">
          <MovieCard
            v-for="movie in movieStore.featuredMovies"
            :key="movie.id"
            v-bind="movie"
          />
        </div>

        <h2 class="text-2xl font-bold mb-8 flex items-center">
          <span class="bg-blue-600 w-3 h-8 mr-3 rounded-sm"></span>
          Properes sessions
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
          <MovieCard
            v-for="movie in movieStore.regularMovies"
            :key="movie.id"
            v-bind="movie"
          />
        </div>

        <PaginationControls 
          v-if="movieStore.totalPages > 1"
          :total-pages="movieStore.totalPages"
          :current-page="movieStore.currentPage"
          @page-change="handlePageChange"
          class="mt-12"
        />
      </template>
    </div>
  </section>
</template>
