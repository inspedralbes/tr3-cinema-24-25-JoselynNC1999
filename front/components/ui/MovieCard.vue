<template>
  <div class="bg-blue-900/40 rounded-lg overflow-hidden shadow-lg hover:shadow-blue-500/50 transition-all hover:-translate-y-2 group">
    <div class="relative h-80 overflow-hidden">
      <img :src="poster_url" :alt="title" class="absolute inset-0 w-full h-full object-cover" />

      <div class="absolute inset-0 bg-gradient-to-t from-blue-900 via-transparent to-transparent z-10"></div>

      <div v-if="badge" class="absolute top-2 right-2 bg-red-600 text-xs px-2 py-1 rounded z-20">{{ badge }}</div>
      <div v-if="badge3d" class="absolute top-2 right-2 bg-purple-600 text-xs px-2 py-1 rounded z-20">{{ badge3d }}</div>
      <div v-if="badgeVip" class="absolute top-2 right-2 bg-yellow-600 text-xs px-2 py-1 rounded z-20">{{ badgeVip }}</div>

      <div class="absolute bottom-0 left-0 w-full p-4 z-20">
        <div class="flex gap-2 mb-2">
          <span class="bg-blue-950/80 text-xs px-2 py-1 rounded backdrop-blur-sm">{{ ageRating }}</span>
          <span v-if="isVOSE" class="bg-blue-950/80 text-xs px-2 py-1 rounded backdrop-blur-sm">VOSE</span>
        </div>
      </div>
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
      
      <NuxtLink :to="`/movies/${id}`" class="w-full bg-blue-600 hover:bg-blue-700 py-2 rounded-full transition-transform hover:scale-105">
        Comprar entrades
      </NuxtLink>

    </div>
  </div>
</template>

<script setup>
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
</script>
