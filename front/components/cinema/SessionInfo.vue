<template>
    <div class="bg-blue-950/70 p-6 rounded-xl shadow-lg backdrop-blur-sm mb-6">
      <div class="flex flex-wrap gap-4 items-center mb-4">
        <div class="bg-blue-900/60 px-4 py-2 rounded-full">
          <span class="text-blue-300 text-sm">Data:</span>
          <span class="ml-2 font-semibold">{{ session.date }}</span>
        </div>
        <div class="bg-blue-900/60 px-4 py-2 rounded-full">
          <span class="text-blue-300 text-sm">Hora:</span>
          <span class="ml-2 font-semibold">{{ session.time }}</span>
        </div>
        <div class="bg-blue-900/60 px-4 py-2 rounded-full">
          <span class="text-blue-300 text-sm">Sala:</span>
          <span class="ml-2 font-semibold">{{ session.room }}</span>
        </div>
        <div 
          :class="isDiscountDay ? 'bg-yellow-600/60' : 'bg-blue-900/60'" 
          class="px-4 py-2 rounded-full cursor-pointer" 
          @click="$emit('toggle-discount')"
        >
          <span class="font-semibold">
            {{ isDiscountDay ? 'Dia de l\'espectador!' : 'Dia normal' }}
          </span>
        </div>
      </div>
      <div class="flex items-center justify-between">
        <div>
          <h2 class="text-2xl font-bold mb-2">Selecció de butaques</h2>
          <p class="text-blue-300">Selecciona fins a 10 butaques per la teva sessió</p>
          <p class="text-xs text-blue-300 mt-2">Un usuari només pot tenir entrades per a una sessió futura alhora</p>
        </div>
        <div class="text-right">
          <div class="text-yellow-400 font-bold text-lg">
            Butaques: <span>{{ selectedSeats.length }}/10</span>
          </div>
          <div class="text-blue-300">
            Total: {{ totalPrice }}€
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  defineProps({
    session: {
      type: Object,
      required: true
    },
    selectedSeats: {
      type: Array,
      required: true
    },
    isDiscountDay: {
      type: Boolean,
      default: false
    },
    totalPrice: {
      type: Number,
      required: true
    }
  });
  
  defineEmits(['toggle-discount']);
  </script>