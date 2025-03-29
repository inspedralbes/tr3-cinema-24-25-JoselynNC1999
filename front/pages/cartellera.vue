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