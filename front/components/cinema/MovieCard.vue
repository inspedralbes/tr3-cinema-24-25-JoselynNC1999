<template>
    <div class="bg-blue-900/40 rounded-lg overflow-hidden shadow-lg">
      <div class="relative h-64 bg-blue-800">
        <div class="absolute inset-0 flex items-center justify-center">
          <span class="text-4xl">🎬</span>
        </div>
        <div v-if="movie.isNew" class="absolute top-2 right-2 bg-blue-600 text-xs px-2 py-1 rounded">ESTRENA</div>
      </div>
      <div class="p-4">
        <h3 class="font-bold text-lg mb-2">{{ movie.title }}</h3>
        <div class="flex mb-2">
          <div class="text-yellow-400 flex">
            <span v-for="star in 5" :key="star" :class="star <= Math.floor(movie.rating) ? 'text-yellow-400' : 'text-blue-700'">★</span>
          </div>
          <span class="text-xs ml-2 text-blue-300">{{ movie.rating }}/5.0</span>
        </div>
        <p class="text-blue-200 text-sm">{{ movie.genre }} | {{ movie.duration }} min</p>
      </div>
    </div>
  </template>
  
  <script setup>
  defineProps({
    movie: {
      type: Object,
      required: true
    }
  });
  </script>