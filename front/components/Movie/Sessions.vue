<template>
    <section class="py-12 bg-blue-950/80">
      <div class="container mx-auto px-6">
        <h2 class="text-2xl font-bold mb-8 flex items-center">
          <span class="bg-blue-600 w-3 h-8 mr-3 rounded-sm"></span>
          Sessions disponibles per a avui
        </h2>
        <!-- Selector de dies -->
        <div class="flex overflow-x-auto pb-4 mb-8 gap-2">
          <div v-for="(day, index) in upcomingDays" :key="index" 
               :class="`flex-shrink-0 px-4 py-2 rounded-full cursor-pointer transition-colors ${selectedDay === index ? 'bg-blue-600' : 'bg-blue-900 hover:bg-blue-800'}`"
               @click="$emit('update:selectedDay', index)">
            <div class="text-center">
              <div class="text-xs text-blue-300">{{ day.dayName }}</div>
              <div class="font-bold">{{ day.date }}</div>
            </div>
          </div>
        </div>
        <!-- Tipus de sessions -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
          <!-- Sessions estàndard -->
          <div class="bg-blue-900/40 rounded-lg overflow-hidden">
            <div class="bg-blue-800 py-3 px-4">
              <h3 class="font-bold">Estàndard</h3>
            </div>
            <div class="p-6">
              <div class="flex flex-wrap gap-3 mb-6">
                <div v-for="time in movie.sessions.standard" :key="time"
                     class="w-24 text-center py-2 px-3 bg-blue-800/70 rounded-md hover:bg-blue-700 cursor-pointer transition-transform hover:scale-105">
                  {{ time }}
                </div>
              </div>
              <div class="text-sm text-blue-300 mb-4">
                <div class="flex justify-between mb-2">
                  <span>Preu normal:</span>
                  <span>9,50 €</span>
                </div>
                <div class="flex justify-between">
                  <span>Dia de l'espectador (dimecres):</span>
                  <span>6,90 €</span>
                </div>
              </div>
            </div>
          </div>
          <!-- Sessions 3D -->
          <div v-if="movie.is3D" class="bg-blue-900/40 rounded-lg overflow-hidden">
            <div class="bg-purple-800 py-3 px-4">
              <h3 class="font-bold">3D</h3>
            </div>
            <div class="p-6">
              <div class="flex flex-wrap gap-3 mb-6">
                <div v-for="time in movie.sessions.threeD" :key="time"
                     class="w-24 text-center py-2 px-3 bg-blue-800/70 rounded-md hover:bg-blue-700 cursor-pointer transition-transform hover:scale-105">
                  {{ time }}
                </div>
              </div>
              <div class="text-sm text-blue-300 mb-4">
                <div class="flex justify-between mb-2">
                  <span>Preu normal:</span>
                  <span>12,50 €</span>
                </div>
                <div class="flex justify-between">
                  <span>Dia de l'espectador:</span>
                  <span>9,90 €</span>
                </div>
              </div>
              <div class="text-xs text-blue-400">
                * Inclou ulleres 3D
              </div>
            </div>
          </div>
          <!-- Sessions VIP -->
          <div v-if="movie.isVIP" class="bg-blue-900/40 rounded-lg overflow-hidden">
            <div class="bg-yellow-700 py-3 px-4">
              <h3 class="font-bold">VIP</h3>
            </div>
            <div class="p-6">
              <div class="flex flex-wrap gap-3 mb-6">
                <div v-for="time in movie.sessions.vip" :key="time"
                     class="w-24 text-center py-2 px-3 bg-blue-800/70 rounded-md hover:bg-blue-700 cursor-pointer transition-transform hover:scale-105">
                  {{ time }}
                </div>
              </div>
              <div class="text-sm text-blue-300 mb-4">
                <div class="flex justify-between mb-2">
                  <span>Preu normal:</span>
                  <span>15,90 €</span>
                </div>
              </div>
              <div class="text-xs text-blue-400">
                * Inclou seients reclinables, servei a la butaca i copa de benvinguda
              </div>
            </div>
          </div>
        </div>
        <!-- Crida a l'acció per comprar entrades -->
        <div class="bg-blue-900/60 rounded-lg p-6 mb-12">
          <div class="flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
              <h3 class="text-xl font-bold mb-2">Reserva les teves entrades ara!</h3>
              <p class="text-blue-300">Tria la millor ubicació i evita cues. Reserva online i rep el 10% de descompte en menjar i beguda.</p>
            </div>
            <button class="bg-blue-600 hover:bg-blue-700 px-8 py-3 rounded-full text-lg font-bold transition-transform hover:scale-105 whitespace-nowrap">
              Comprar entrades
            </button>
          </div>
        </div>
      </div>
    </section>
  </template>
  
  <script setup>
  const emit = defineEmits(['update:selectedDay']);
  defineProps({
    movie: {
      type: Object,
      required: true
    },
    upcomingDays: {
      type: Array,
      required: true
    },
    selectedDay: {
      type: Number,
      required: true
    }
  });
  </script>
  