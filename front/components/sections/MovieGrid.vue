<template>
    <section class="py-12">
      <div class="container mx-auto px-6">
        <!-- Estrenos destacados -->
        <h2 class="text-2xl font-bold mb-8 flex items-center">
          <span class="bg-blue-600 w-3 h-8 mr-3 rounded-sm"></span>
          Estrenes destacades
        </h2>
          
        <!-- Grid de Pel·lícules (Estrenes) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-12">
          <MovieCard
            v-for="movie in featuredMovies"
            :key="movie.id"
            v-bind="movie"
          />
        </div>
          
        <!-- Títol Secció Regular -->
        <h2 class="text-2xl font-bold mb-8 flex items-center">
          <span class="bg-blue-600 w-3 h-8 mr-3 rounded-sm"></span>
          Cartellera regular
        </h2>
          
        <!-- Grid de Pel·lícules (Regular) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
          <MovieCard
            v-for="movie in regularMovies"
            :key="movie.id"
            v-bind="movie"
          />
        </div>
          
        <!-- Paginació -->
        <PaginationControls :total-pages="8" :current-page="1" class="mt-12" />
      </div>
    </section>
  </template>
  
  <script setup>
  import MovieCard from '~/components/ui/MovieCard.vue'
  import PaginationControls from '~/components/ui/PaginationControls.vue'
  
  // Datos de muestra - En un proyecto real esto podría venir de una API o Pinia/Vuex
  const featuredMovies = [
    {
      id: 1,
      title: 'La Gran Aventura',
      description: "Un grup d'exploradors s'endinsa en un món desconegut ple de misteris i perills.",
      genre: 'Aventura',
      duration: 135,
      rating: 4,
      ageRating: '12A',
      emoji: '🎬',
      badge: 'ESTRENA',
      isVOSE: true,
      showtimes: ['16:30', '19:15', '22:00']
    },
    {
      id: 2,
      title: 'Cosmos Infinit',
      description: "Un viatge fascinant a través de l'univers que canviarà la nostra percepció del cosmos.",
      genre: 'Ciència Ficció',
      duration: 145,
      rating: 5,
      ageRating: 'TP',
      emoji: '🌌',
      badge3d: '3D',
      showtimes: ['15:45', '18:30', '21:15']
    },
    {
      id: 3,
      title: 'Comèdia Total',
      description: "Una família normal es troba en situacions hilarants quan decideixen fer un canvi radical a les seves vides.",
      genre: 'Comèdia',
      duration: 95,
      rating: 4,
      ageRating: '7A',
      emoji: '🤣',
      badge: 'ESTRENA',
      showtimes: ['17:00', '19:30', '22:30']
    },
    {
      id: 4,
      title: 'Ànimes Perdudes',
      description: "Una història commovedora sobre la recerca de la identitat i el sentit de la vida.",
      genre: 'Drama',
      duration: 128,
      rating: 4,
      ageRating: '16A',
      emoji: '🎭',
      isVOSE: true,
      showtimes: ['16:15', '19:00', '21:45']
    }
  ]
  
  const regularMovies = [
    {
      id: 5,
      title: 'Misteri a la Mansió',
      description: "Els nous propietaris d'una mansió descobreixen que no estan sols a la casa.",
      genre: 'Terror',
      duration: 110,
      rating: 4,
      ageRating: '18A',
      emoji: '👻',
      showtimes: ['17:30', '20:15', '23:00']
    },
    {
      id: 6,
      title: 'Campions',
      description: "La història d'un equip que supera tots els obstacles per arribar a la victòria.",
      genre: 'Esports/Drama',
      duration: 118,
      rating: 5,
      ageRating: '7A',
      emoji: '🏆',
      badgeVip: 'VIP',
      showtimes: ['16:00', '18:45', '21:30']
    },
    {
      id: 7,
      title: "L'Increïble Món Màgic",
      description: "Una aventura màgica per a tota la família en un món fantàstic ple de criatures extraordinàries.",
      genre: 'Animació',
      duration: 92,
      rating: 4,
      ageRating: 'TP',
      emoji: '🌈',
      showtimes: ['15:30', '17:45', '19:45']
    },
    {
      id: 8,
      title: 'El Codi Secret',
      description: "Un detectiu intenta resoldre un misteri que podria canviar el curs de la història.",
      genre: 'Thriller',
      duration: 132,
      rating: 4,
      ageRating: '12A',
      emoji: '🔍',
      badgeVip: 'VIP',
      isVOSE: true,
      showtimes: ['17:15', '20:00', '22:45']
    }
  ]
  </script>