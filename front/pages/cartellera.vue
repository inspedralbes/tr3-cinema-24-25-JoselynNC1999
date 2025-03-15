<template>
  <div class="min-h-screen bg-gradient-to-b from-blue-900 to-blue-800 text-white">
    <TheHeader />
    
    <HeroSection 
      title="Cartellera"
      accentTitle="Completa"
      quote="Descobreix totes les pel·lícules disponibles al nostre cinema i viu una experiència única"
    />
    
    <MovieFilters />
    
    <MovieListSection 
      title="En cartellera"
      subtitle="Les millors estrenes i pel·lícules del moment"
      :movies="movies"
    />
    <MovieGrid />
    <PromoSection />
    
    <TheFooter />
  </div>
</template>

<script setup>
import TheFooter from '@/components/layout/TheFooter.vue';
import TheHeader from '@/components/layout/TheHeader.vue';
import PromoSection from '@/components/layout/PromoSection.vue'
import MovieFilters from '@/components/sections/MovieFilters.vue';
import MovieGrid from '@/components/sections/MovieGrid.vue';



// Datos de películas (en una aplicación real, estos datos vendrían de una API)
const movies = ref([
  {
    id: 1,
    title: 'Barbie',
    duration: '1h 54m',
    date: 'dv., 14 de març',
    description: 'La icónica muñeca cobra vida en una aventura mágica.',
    time: '16:00',
    image: '/api/placeholder/400/600',
    tags: []
  },
  {
    id: 2,
    title: 'Dune: Part One',
    duration: '2h 35m',
    date: 'ds., 15 de març',
    description: 'Un joven noble enfrenta su destino en un planeta desértico.',
    time: '16:00',
    image: '/api/placeholder/400/600',
    tags: ['AVUI']
  },
  {
    id: 3,
    title: 'Mickey 17',
    duration: '2h 10m',
    date: 'dg., 16 de març',
    description: 'Un thriller de ciencia ficción sobre clones en una misión espacial.',
    time: '16:00',
    image: '/api/placeholder/400/600',
    tags: []
  },
  {
    id: 4,
    title: 'Avengers: Endgame',
    duration: '3h 1m',
    date: 'dll., 17 de març',
    description: 'Un épico final para los Vengadores.',
    time: '16:00',
    image: '/api/placeholder/400/600',
    tags: ['ESPECIAL']
  }
]);
</script>

<style>
@keyframes float {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-15px); }
}
@keyframes float-delay {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-15px); }
}
@keyframes float-delay-long {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-15px); }
}

.animate-float { animation: float 5s ease-in-out infinite; }
.animate-float-delay { animation: float-delay 7s ease-in-out infinite; }
.animate-float-delay-long { animation: float-delay-long 9s ease-in-out infinite; }
</style>