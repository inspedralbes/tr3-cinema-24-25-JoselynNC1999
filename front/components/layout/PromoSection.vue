<template>
    <section class="py-16 bg-gradient-to-b from-blue-900 to-purple-900 relative overflow-hidden">
      <div class="container mx-auto px-6 relative z-10">
        <div class="bg-blue-950/70 p-8 md:p-12 rounded-2xl shadow-2xl backdrop-blur-sm">
          <div class="md:flex items-center">
            <div class="md:w-2/3 mb-6 md:mb-0 md:pr-8">
              <h2 class="text-3xl md:text-4xl font-bold mb-4">{{ title }}</h2>
              <p class="text-blue-200 text-lg mb-6">
                {{ description }}
              </p>
              <div class="flex gap-4">
                <a :href="buttonLink" class="bg-yellow-500 hover:bg-yellow-600 text-blue-900 font-bold py-3 px-8 rounded-full transition-transform hover:scale-105 shadow-lg">
                  {{ buttonText }}
                </a>
              </div>
            </div>
            <div class="md:w-1/3 relative">
              <div class="bg-yellow-400 p-6 rounded-xl transform rotate-3 hover:rotate-0 transition-transform">
                <div class="text-center">
                  <span class="text-6xl text-blue-900 font-black">{{ promoText }}</span>
                  <p class="text-blue-900 font-bold text-lg">{{ promoSubtext }}</p>
                  <p class="text-blue-900 text-sm mt-2">{{ promoNote }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Animated elements -->
      <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
        <div class="absolute top-10 left-10 w-20 h-20 bg-blue-400 rounded-full opacity-10 animate-float"></div>
        <div class="absolute bottom-10 right-10 w-32 h-32 bg-purple-400 rounded-full opacity-10 animate-float-delay"></div>
        <div class="absolute top-1/2 left-1/3 w-16 h-16 bg-yellow-400 rounded-full opacity-10 animate-float-delay-long"></div>
      </div>
    </section>
  </template>
  
  <script setup>
  defineProps({
    title: {
      type: String,
      default: 'Promoció especial de dimecres'
    },
    description: {
      type: String,
      default: 'Vine els dimecres i gaudeix de 2x1 en totes les pel·lícules! Porta un amic o familiar i la segona entrada és gratis.'
    },
    buttonText: {
      type: String,
      default: 'Aprofita ara!'
    },
    buttonLink: {
      type: String,
      default: '#'
    },
    promoText: {
      type: String,
      default: '2x1'
    },
    promoSubtext: {
      type: String,
      default: 'TOTS ELS DIMECRES'
    },
    promoNote: {
      type: String,
      default: '*Consulta condicions'
    }
  })
  </script>