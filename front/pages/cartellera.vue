<template>
    <div class="min-h-screen bg-gradient-to-b from-blue-900 to-blue-800 text-white">
      <TheHeader />
      <HeroSection 
        title="Cartellera"
        subtitle="Descobreix totes les pel·lícules disponibles al nostre cinema i gaudeix de la millor experiència audiovisual."
      />
      <MovieFilters />
      <MovieGrid />
      <PaginationControls/>
      <NewsletterSection />
      <TheFooter class="mt-auto" />
    </div>
  </template>
  
  <script setup>
  import TheHeader from '@/components/layout/TheHeader.vue'
  import HeroSection from '@/components/sections/HeroSection.vue'
  import MovieFilters from '@/components/sections/MovieFilters.vue'
  import MovieGrid from '@/components/sections/MovieGrid.vue'
  import PaginationControls from '@/components/ui/PaginationControls.vue'
  import NewsletterSection from '@/components/sections/NewsletterSection.vue'
  import TheFooter from '@/components/layout/TheFooter.vue'
  </script>
  