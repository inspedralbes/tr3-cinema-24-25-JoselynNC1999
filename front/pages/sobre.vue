<template>
     <TheHeader />
     <section class="py-16 bg-gradient-to-b from-blue-900 to-blue-800 text-white">
      <div class="container mx-auto px-6">
        <!-- Title Section -->
        <div class="text-center mb-12">
          <h1 class="text-4xl md:text-5xl font-bold mb-4">
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-purple-500">
              Sobre Nosaltres
            </span>
          </h1>
          <p class="text-blue-200 max-w-3xl mx-auto text-lg">
            Una experiència de cinema que va més enllà de la pantalla gran
          </p>
        </div>
  
        <!-- History and Values Section -->
        <div class="grid md:grid-cols-2 gap-12 items-center">
          <!-- Our History -->
          <div>
            <h2 class="text-3xl font-bold mb-6 text-blue-200">La Nostra Història</h2>
            <p class="text-blue-300 mb-4">
              Fundat l'any 2025 al cor de Barcelona, Cinépolis Pedralbes va néixer amb una visió: transformar l'experiència de cinema en un moment únic i memorable.
            </p>
            <p class="text-blue-300 mb-4">
              Més que un cinema, som un espai de connexió, emoció i cultura. Cada detall del nostre projecte ha estat dissenyat pensant en el confort i la passió dels nostres espectadors.
            </p>
            <p class="text-blue-300">
              Des de sales tecnològicament avançades fins a un servei personalitzat, volem que cada visita sigui una experiència extraordinària.
            </p>
          </div>
  
          <!-- Our Values -->
          <div class="relative">
            <div class="bg-blue-900/60 p-8 rounded-xl shadow-lg">
              <div class="flex items-center mb-6">
                <div class="w-16 h-16 bg-blue-600 rounded-full mr-4 flex items-center justify-center">
                  <span class="text-2xl">🎬</span>
                </div>
                <h3 class="text-2xl font-bold text-blue-200">Els Nostres Valors</h3>
              </div>
              <ul class="space-y-4">
                <li 
                  v-for="(value, index) in values" 
                  :key="index" 
                  class="flex items-start"
                >
                  <span class="mr-3 text-blue-400 text-xl">{{ value.icon }}</span>
                  <span class="text-blue-300">{{ value.text }}</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
  
        <!-- Our Team Section -->
        <div class="mt-16 text-center">
          <h2 class="text-3xl font-bold mb-6 text-blue-200">El Nostre Equip</h2>
          <p class="text-blue-300 max-w-2xl mx-auto mb-12">
            Un grup de professionals apassionats units per crear moments màgics i transformar cada sessió de cinema en una experiència única.
          </p>
  
          <div class="grid md:grid-cols-3 gap-8">
            <div 
              v-for="(member, index) in teamMembers" 
              :key="index" 
              class="bg-blue-900/60 p-6 rounded-xl shadow-lg transform hover:-translate-y-2 transition-transform"
            >
              <div class="w-24 h-24 bg-blue-700 rounded-full mx-auto mb-4 flex items-center justify-center text-4xl">
                {{ member.emoji }}
              </div>
              <h3 class="text-xl font-bold mb-2 text-blue-200">{{ member.name }}</h3>
              <p class="text-blue-300 text-sm">{{ member.role }}</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <TheFooter />
  </template>
  
  <script setup>
  import TheFooter from '@/components/layout/TheFooter.vue';
  import TheHeader from '@/components/layout/TheHeader.vue';
  const values = [
    { icon: '✨', text: 'Passió per l\'art cinematogràfic' },
    { icon: '🤝', text: 'Compromís amb el millor servei' },
    { icon: '🌈', text: 'Diversitat i inclusió' },
    { icon: '🌍', text: 'Responsabilitat social i mediambiental' }
  ]
  
  const teamMembers = [
    { 
      name: 'Joselyn Ninahuaman', 
      role: 'Directora General', 
      emoji: '👩‍💼' 
    },
    { 
      name: 'Elvira Calcina', 
      role: 'Director d\'Operacions', 
      emoji: '👨‍💻' 
    },
    { 
      name: 'Aaron Garcia', 
      role: 'Directora d\'Experiència al Client', 
      emoji: '👩‍🎨' 
    }
  ]
  </script>