<template>
    <section class="py-16">
      <div class="container mx-auto px-6">
        <h2 class="text-3xl md:text-4xl font-bold mb-2 text-center">{{ title }}</h2>
        <p class="text-blue-300 text-center mb-12">{{ subtitle }}</p>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
          <MovieCard
            v-for="(movie, index) in movies"
            :key="index"
            :icon="movie.icon"
            :tag="movie.tag"
            :title="movie.title"
            :rating="movie.rating"
            :genre="movie.genre"
            :duration="movie.duration"
            :buttonText="buttonText"
          />
        </div>
        
        <div v-if="showAllLink" class="text-center mt-10">
          <a :href="showAllLink" class="inline-block border-2 border-blue-400 hover:bg-blue-800 text-white font-semibold py-2 px-8 rounded-full transition-transform hover:scale-105">
            {{ showAllText }}
          </a>
        </div>
      </div>
    </section>
  </template>
  
  <script setup>
  import MovieCard from './MovieCard.vue'
  
  defineProps({
    title: {
      type: String,
      default: 'En cartellera'
    },
    subtitle: {
      type: String,
      default: 'Les millors estrenes i pel·lícules del moment'
    },
    movies: {
      type: Array,
      default: () => [
        {
          icon: '🎬',
          tag: 'ESTRENA',
          title: 'Aventures Galàctiques',
          rating: 4.0,
          genre: 'Ciència Ficció',
          duration: 120
        },
        {
          icon: '🎭',
          title: 'Somnis d\'Estiu',
          rating: 5.0,
          genre: 'Drama',
          duration: 105
        },
        {
          icon: '🤣',
          title: 'Comèdia Salvatge',
          rating: 3.0,
          genre: 'Comèdia',
          duration: 95
        },
        {
          icon: '👻',
          tag: '3D',
          title: 'Misteri a la Mansió',
          rating: 4.2,
          genre: 'Terror',
          duration: 110
        }
      ]
    },
    buttonText: {
      type: String,
      default: 'Comprar entrades'
    },
    showAllLink: {
      type: String,
      default: '#'
    },
    showAllText: {
      type: String,
      default: 'Veure tota la cartellera'
    }
  })
  </script>
  