<template>
    <section class="py-16 relative overflow-hidden">
      <div class="container mx-auto px-6 relative z-10">
        <div class="md:flex items-center">
          <div class="md:w-1/2 mb-10 md:mb-0">
            <h1 class="text-4xl md:text-6xl font-bold mb-4 leading-tight">
              {{ title }}
              <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-purple-500">
                {{ highlightedTitle }}
              </span>
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-blue-200 italic">
              "{{ tagline }}"
            </p>
            <div class="flex flex-wrap gap-4">
              <a v-for="(button, index) in buttons" :key="index" 
                 :href="button.url" 
                 :class="[
                   button.primary ? 'bg-blue-600 hover:bg-blue-700 text-white' : 'bg-transparent border-2 border-blue-400 hover:bg-blue-800 text-white',
                   'font-semibold py-3 px-8 rounded-full transition-transform hover:scale-105 shadow-lg'
                 ]">
                {{ button.text }}
              </a>
            </div>
          </div>
          <div class="md:w-1/2 relative">
            <div class="w-full h-64 md:h-96 bg-blue-700 rounded-xl shadow-xl overflow-hidden relative transform hover:scale-105 transition-transform duration-500">
              <div class="absolute inset-0 bg-gradient-to-br from-blue-600/50 to-purple-900/70"></div>
              <div class="absolute inset-0 flex items-center justify-center">
                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-lg hover:bg-blue-100 transition cursor-pointer">
                  <div class="ml-1 w-0 h-0 border-t-8 border-b-8 border-l-12 border-t-transparent border-b-transparent border-l-blue-700"></div>
                </div>
              </div>
            </div>
            <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-yellow-400 rounded-full animate-bounce opacity-70"></div>
            <div class="absolute -top-4 -left-4 w-16 h-16 bg-blue-400 rounded-full animate-ping opacity-70"></div>
          </div>
        </div>
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
      default: 'Benvinguts a'
    },
    highlightedTitle: {
      type: String,
      default: 'Cinépolis Pedralbes'
    },
    tagline: {
      type: String,
      default: 'Perquè cada sessió ha de ser especial, t\'oferim el millor confort i qualitat per viure el cinema com mai abans.'
    },
    buttons: {
      type: Array,
      default: () => [
        { text: 'Veure cartellera', url: '#', primary: true },
        { text: 'Comprar entrades', url: '#', primary: false }
      ]
    }
  })
  </script>
  