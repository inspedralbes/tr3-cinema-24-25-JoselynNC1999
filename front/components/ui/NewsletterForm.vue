<template>
    <div class="flex flex-col sm:flex-row gap-4 max-w-lg mx-auto">
      <input
        v-model="email"
        type="email"
        placeholder="El teu email"
        class="flex-grow py-3 px-4 rounded-full bg-blue-900 border border-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400"
      >
      <button 
        class="bg-blue-600 hover:bg-blue-700 py-3 px-6 rounded-full transition-transform hover:scale-105"
        @click="subscribe"
      >
        Subscriure'm
      </button>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  
  const email = ref('')
  
  const subscribe = () => {
    // Aquí implementarías la lógica para suscribir al newsletter
    console.log('Suscrito:', email.value)
    // Reset el campo después de enviar
    email.value = ''
    // Mostrar mensaje de éxito, etc.
  }
  </script>