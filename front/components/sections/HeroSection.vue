<template>
    <section class="py-12 relative overflow-hidden">
      <div class="container mx-auto px-6 relative z-10">
        <h1 class="text-4xl md:text-5xl font-bold mb-4 text-center">
          <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-purple-500">
            {{ title }}
          </span>
        </h1>
        <p class="text-xl text-blue-200 text-center mb-8 max-w-3xl mx-auto">
          {{ subtitle }}
        </p>
      </div>
        
      <!-- Animated background elements -->
      <div class="absolute top-20 left-10 w-8 h-8 bg-blue-400 rounded-full opacity-20 animate-float"></div>
      <div class="absolute bottom-20 right-20 w-12 h-12 bg-purple-400 rounded-full opacity-20 animate-float-delay"></div>
      <div class="absolute top-40 right-40 w-6 h-6 bg-yellow-400 rounded-full opacity-20 animate-float-delay-long"></div>
    </section>
  </template>
  
  <script setup>
  defineProps({
    title: {
      type: String,
      required: true,
      default: 'Cartellera'
    },
    subtitle: {
      type: String,
      required: true,
      default: 'Descobreix totes les pel·lícules disponibles al nostre cinema i gaudeix de la millor experiència audiovisual.'
    }
  })
  </script>
  
  <style scoped>
  @keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
  }
  
  .animate-float {
    animation: float 6s ease-in-out infinite;
  }
  
  .animate-float-delay {
    animation: float 8s ease-in-out 1s infinite;
  }
  
  .animate-float-delay-long {
    animation: float 10s ease-in-out 2s infinite;
  }
  </style>