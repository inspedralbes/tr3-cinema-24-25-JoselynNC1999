<template>
    <div class="bg-blue-900/40 rounded-lg overflow-hidden shadow-lg hover:shadow-blue-500/50 transition-shadow">
      <div class="relative h-64 bg-blue-800">
        <div class="absolute inset-0 flex items-center justify-center">
          <span class="text-4xl">{{ icon }}</span>
        </div>
        <div v-if="tag" class="absolute top-2 right-2 bg-blue-600 text-xs px-2 py-1 rounded">{{ tag }}</div>
      </div>
      <div class="p-4">
        <h3 class="font-bold text-lg mb-2">{{ title }}</h3>
        <div class="flex mb-2">
          <div class="text-yellow-400 flex">
            <span v-for="n in 5" :key="n">
              <span v-if="n <= Math.floor(rating)">★</span>
              <span v-else class="text-blue-700">★</span>
            </span>
          </div>
          <span class="text-xs ml-2 text-blue-300">{{ rating.toFixed(1) }}/5.0</span>
        </div>
        <p class="text-blue-200 text-sm mb-4">{{ genre }} | {{ duration }} min</p>
        <button class="w-full bg-blue-600 hover:bg-blue-700 py-2 rounded-full transition-transform hover:scale-105">
          {{ buttonText }}
        </button>
      </div>
    </div>
  </template>
  
  <script setup>
  defineProps({
    icon: {
      type: String,
      default: '🎬'
    },
    tag: {
      type: String,
      default: ''
    },
    title: {
      type: String,
      required: true
    },
    rating: {
      type: Number,
      default: 0
    },
    genre: {
      type: String,
      required: true
    },
    duration: {
      type: Number,
      required: true
    },
    buttonText: {
      type: String,
      default: 'Comprar entrades'
    }
  })
  </script>