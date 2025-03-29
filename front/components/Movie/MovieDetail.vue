<template>
    <section class="py-8 relative overflow-hidden">
      <div class="container mx-auto px-6 relative z-10">
        <div class="flex flex-col lg:flex-row gap-8">
          <!-- Poster i informació ràpida -->
          <div class="w-full lg:w-1/3">
            <div class="relative aspect-[2/3] rounded-xl overflow-hidden bg-blue-900 shadow-xl">
              <div class="absolute inset-0 flex items-center justify-center bg-blue-800 text-8xl">
                {{ movie.emoji }}
              </div>
              <div class="absolute inset-0 bg-gradient-to-t from-blue-900 via-transparent to-transparent"></div>
              <!-- Badges -->
              <div class="absolute top-4 right-4 flex flex-col space-y-2">
                <div v-if="movie.isNew" class="bg-red-600 text-xs px-2 py-1 rounded">ESTRENA</div>
                <div v-if="movie.is3D" class="bg-purple-600 text-xs px-2 py-1 rounded">3D</div>
                <div v-if="movie.isVIP" class="bg-yellow-600 text-xs px-2 py-1 rounded">VIP</div>
              </div>
              <!-- Valoració -->
              <div class="absolute bottom-4 left-4 flex space-x-2">
                <span class="bg-blue-950/80 text-xs px-2 py-1 rounded backdrop-blur-sm">{{ movie.rating }}</span>
                <span v-if="movie.isVOSE" class="bg-blue-950/80 text-xs px-2 py-1 rounded backdrop-blur-sm">VOSE</span>
              </div>
            </div>
            <!-- Informació ràpida -->
            <div class="mt-6 bg-blue-900/40 rounded-lg p-4">
              <h3 class="text-lg font-bold mb-4 border-b border-blue-800 pb-2">Informació</h3>
              <div class="space-y-3">
                <div class="flex justify-between">
                  <span class="text-blue-300">Gènere:</span>
                  <span>{{ movie.genre }}</span>
                </div>
                <div class="flex justify-between">
                  <span class="text-blue-300">Duració:</span>
                  <span>{{ movie.duration }} min</span>
                </div>
                <div class="flex justify-between">
                  <span class="text-blue-300">Director:</span>
                  <span>{{ movie.director }}</span>
                </div>
                <div class="flex justify-between">
                  <span class="text-blue-300">Any:</span>
                  <span>{{ movie.year }}</span>
                </div>
                <div class="flex justify-between">
                  <span class="text-blue-300">Valoració:</span>
                  <div class="flex text-yellow-400">
                    <span v-for="i in 5" :key="i" :class="i <= movie.stars ? '' : 'text-blue-700'">★</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Detalls de la pel·lícula -->
          <div class="w-full lg:w-2/3">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
              <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-purple-500">
                {{ movie.title }}
              </span>
              <span v-if="movie.isVOSE" class="ml-3 text-sm bg-blue-700 px-2 py-1 rounded align-middle">V.O. Subtitulada</span>
            </h1>
            <!-- Sinopsi -->
            <div class="mb-8">
              <h2 class="text-xl font-bold mb-4 text-blue-200">Sinopsi</h2>
              <p class="text-blue-100 leading-relaxed">{{ movie.synopsis }}</p>
              <p class="mt-4 text-blue-100 leading-relaxed">{{ movie.extendedSynopsis }}</p>
            </div>
            <!-- Tràiler -->
            <div class="mb-8">
              <h2 class="text-xl font-bold mb-4 text-blue-200">Tràiler</h2>
              <div class="aspect-video bg-blue-950 rounded-lg flex items-center justify-center">
                <div class="text-center">
                  <div class="text-5xl mb-2">🎬</div>
                  <p class="text-blue-300">Tràiler no disponible en aquesta vista</p>
                  <button class="mt-4 bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-full transition-transform hover:scale-105">
                    Veure tràiler
                  </button>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
      <!-- Elements d'animació de fons -->
      <div class="absolute top-20 left-10 w-8 h-8 bg-blue-400 rounded-full opacity-20 animate-float"></div>
      <div class="absolute bottom-20 right-20 w-12 h-12 bg-purple-400 rounded-full opacity-20 animate-float-delay"></div>
      <div class="absolute top-40 right-40 w-6 h-6 bg-yellow-400 rounded-full opacity-20 animate-float-delay-long"></div>
    </section>
  </template>
  
  <script setup>
  defineProps({
    movie: {
      type: Object,
      required: true
    }
  });
  </script>
  