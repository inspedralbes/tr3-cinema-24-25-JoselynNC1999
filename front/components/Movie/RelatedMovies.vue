<template>
    <section class="py-12">
      <div class="container mx-auto px-6">
        <h2 class="text-2xl font-bold mb-8 flex items-center">
          <span class="bg-blue-600 w-3 h-8 mr-3 rounded-sm"></span>
          També et pot interessar
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
          <div v-for="(relatedMovie, index) in relatedMovies" :key="index" 
               class="bg-blue-900/40 rounded-lg overflow-hidden shadow-lg hover:shadow-blue-500/50 transition-all hover:-translate-y-2 group">
            <div class="relative h-60 overflow-hidden">
              <div class="absolute inset-0 bg-gradient-to-t from-blue-900 via-transparent to-transparent z-10"></div>
              <div class="absolute inset-0 flex items-center justify-center bg-blue-800">
                <span class="text-5xl">{{ relatedMovie.emoji }}</span>
              </div>
              <div v-if="relatedMovie.badge" class="absolute top-2 right-2 bg-red-600 text-xs px-2 py-1 rounded z-20">
                {{ relatedMovie.badge }}
              </div>
            </div>
            <div class="p-4">
              <h3 class="font-bold text-lg mb-1">{{ relatedMovie.title }}</h3>
              <p class="text-blue-200 text-sm mb-3">{{ relatedMovie.genre }} | {{ relatedMovie.duration }} min</p>
              <button class="w-full bg-blue-600 hover:bg-blue-700 py-2 rounded-full transition-transform hover:scale-105">
                Veure detalls
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>
  </template>
  
  <script setup>
  defineProps({
    relatedMovies: {
      type: Array,
      required: true
    }
  });
  </script>
  