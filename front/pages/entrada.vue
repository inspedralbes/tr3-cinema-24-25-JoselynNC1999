<template>
  <div class="min-h-screen bg-gradient-to-b from-blue-900 to-blue-800 text-white">
    <TheHeader />
    
    <section class="py-16 px-6 relative overflow-hidden">
      <div class="container mx-auto relative z-10">
        <!-- Breadcrumb Navigation -->
        <div class="flex items-center text-blue-300 mb-6">
          <router-link to="/" class="hover:text-white transition-colors">Inici</router-link>
          <span class="mx-2">/</span>
          <router-link to="/cartellera" class="hover:text-white transition-colors">Cartellera</router-link>
          <span class="mx-2">/</span>
          <router-link :to="`/pelicula/${movieId}`" class="hover:text-white transition-colors">{{ movieTitle }}</router-link>
          <span class="mx-2">/</span>
          <router-link :to="`/seleccio-butaques/${movieId}`" class="hover:text-white transition-colors">Selecció Butaques</router-link>
          <span class="mx-2">/</span>
          <span class="text-white">Confirmació de Compra</span>
        </div>
        
        <!-- Purchase Confirmation -->
        <div class="max-w-4xl mx-auto">
          <div class="bg-blue-950/70 rounded-2xl shadow-2xl overflow-hidden backdrop-blur-sm">
            <!-- Header with success message -->
            <div class="bg-blue-900 p-6 border-b border-blue-800">
              <div class="flex items-center">
                <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mr-4">
                  <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                  </svg>
                </div>
                <div>
                  <h2 class="text-2xl font-bold">Compra realitzada amb èxit!</h2>
                  <p class="text-blue-300">Referència: #{{ orderCode }}</p>
                </div>
              </div>
            </div>
            
            <!-- Purchase details -->
            <div class="p-6 md:p-8">
              <div class="md:flex gap-6">
                <!-- Movie poster and info -->
                <div class="md:w-1/3 mb-6 md:mb-0">
                  <div class="bg-blue-800 rounded-lg overflow-hidden mb-4">
                    <div class="aspect-[2/3] flex items-center justify-center relative">
                      <img v-if="theaterStore.currentMovie?.poster" :src="theaterStore.currentMovie.poster" 
                           alt="Movie poster" class="object-cover w-full h-full" />
                      <span v-else class="text-4xl">🎬</span>
                      <div class="absolute inset-0 bg-gradient-to-t from-blue-900/70 to-transparent"></div>
                    </div>
                  </div>
                  <h3 class="text-xl font-bold mb-2">{{ movieTitle }}</h3>
                  <p class="text-blue-300 mb-1">{{ movieGenre }} | {{ movieDuration }}</p>
                  <div class="flex mb-2">
                    <div class="text-yellow-400 flex">
                      <span v-for="star in 5" :key="star" 
                            :class="star <= (theaterStore.currentMovie?.rating || 0) ? '' : 'text-blue-700'">★</span>
                    </div>
                    <span class="text-xs ml-2 text-blue-300">{{ theaterStore.currentMovie?.rating || 0 }}/5.0</span>
                  </div>
                </div>
                
                <!-- Tickets and session info -->
                <div class="md:w-2/3">
                  <div class="bg-blue-900/50 rounded-xl p-6 mb-6">
                    <h3 class="text-lg font-semibold mb-4 border-b border-blue-800 pb-2">Detalls de la sessió</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                      <div>
                        <p class="text-blue-300 text-sm">Data</p>
                        <p class="font-semibold">{{ sessionDate }}</p>
                      </div>
                      <div>
                        <p class="text-blue-300 text-sm">Hora</p>
                        <p class="font-semibold">{{ sessionTime }}</p>
                      </div>
                      <div>
                        <p class="text-blue-300 text-sm">Sala</p>
                        <p class="font-semibold">{{ theaterRoom }}</p>
                      </div>
                      <div>
                        <p class="text-blue-300 text-sm">Format</p>
                        <p class="font-semibold">{{ theaterStore.currentMovie?.format || 'Digital 2D' }}</p>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Tickets list -->
                  <div class="bg-blue-900/50 rounded-xl p-6 mb-6">
                    <h3 class="text-lg font-semibold mb-4 border-b border-blue-800 pb-2">Les teves entrades</h3>
                    
                    <div class="space-y-3 mb-4">
                      <div v-for="(seat, index) in theaterStore.selectedSeats" :key="index" class="flex justify-between items-center">
                        <div class="flex items-center">
                          <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-2"
                            :class="theaterStore.isVipSeat(seat.row, seat.seat) ? 'bg-purple-600' : 'bg-blue-600'">
                            <span class="font-bold text-sm">{{ seat.row }}{{ seat.seat }}</span>
                          </div>
                          <span>Butaca {{ theaterStore.isVipSeat(seat.row, seat.seat) ? 'VIP' : 'Estàndard' }}</span>
                        </div>
                        <div class="text-right">
                          <span class="font-bold">{{ formatPrice(theaterStore.getPricePerSeat(seat.row, seat.seat)) }}</span>
                          <span class="text-xs text-blue-300 block" v-if="theaterStore.isDiscountDay">Amb descompte 2x1</span>
                        </div>
                      </div>
                    </div>
                    
                    <!-- Total -->
                    <div class="border-t border-blue-800 pt-4 mt-4">
                      <div class="flex justify-between items-center">
                        <span class="text-lg">Total</span>
                        <span class="text-2xl font-bold">{{ formatPrice(theaterStore.totalPrice) }}</span>
                      </div>
                      <p class="text-xs text-blue-300 text-right mt-1">IVA inclòs</p>
                    </div>
                  </div>
                  
                  <!-- Actions -->
                  <div class="flex flex-col sm:flex-row gap-4">
                    <button class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-all">
                      <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                      </svg>
                      Descarregar entrades
                    </button>
                    <button class="flex-1 border-2 border-blue-400 hover:bg-blue-800 text-white px-6 py-3 rounded-lg font-semibold transition-all">
                      <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                      </svg>
                      Enviar per email
                    </button>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Additional information -->
            <div class="bg-blue-950 p-6 border-t border-blue-800">
              <div class="max-w-2xl mx-auto">
                <h4 class="font-semibold mb-3">Informació important</h4>
                <ul class="text-blue-300 text-sm space-y-2">
                  <li>• Has de presentar el codi QR a l'entrada del cinema.</li>
                  <li>• Arriba almenys 15 minuts abans per evitar aglomeracions.</li>
                  <li>• Pots cancel·lar les teves entrades fins a 2 hores abans de la sessió.</li>
                  <li>• Per qualsevol dubte, contacta amb nosaltres al 93 123 45 67.</li>
                </ul>
              </div>
            </div>
          </div>
          
          <!-- Return to home -->
          <div class="mt-8 text-center">
            <router-link to="/" class="inline-block bg-transparent border-2 border-blue-400 hover:bg-blue-800 text-white font-semibold py-2 px-8 rounded-full transition transform hover:scale-105">
              Tornar a l'inici
            </router-link>
          </div>
        </div>
      </div>
      
      <!-- Animated background elements -->
      <div class="absolute top-20 left-10 w-8 h-8 bg-blue-400 rounded-full opacity-20 animate-float"></div>
      <div class="absolute bottom-20 right-20 w-12 h-12 bg-purple-400 rounded-full opacity-20 animate-float-delay"></div>
      <div class="absolute top-40 right-40 w-6 h-6 bg-yellow-400 rounded-full opacity-20 animate-float-delay-long"></div>
    </section>
    
    <PromoSection class="my-12" />
    <NewsletterSection class="mt-16" />
    <TheFooter />
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { useTheaterStore } from '@/stores/theater';
import TheHeader from '@/components/layout/TheHeader.vue';
import PromoSection from '@/components/layout/PromoSection.vue';
import NewsletterSection from '@/components/sections/NewsletterSection.vue';
import TheFooter from '@/components/layout/TheFooter.vue';

const route = useRoute();
const theaterStore = useTheaterStore();

// Generate a random order code
const orderCode = ref('CINP' + Math.floor(Math.random() * 10000).toString().padStart(4, '0'));

// Get movie ID from the store or route
const movieId = computed(() => {
  return theaterStore.currentMovie?.id || route.params.id || '';
});

// Computed properties based on theaterStore data
const movieTitle = computed(() => theaterStore.currentMovie?.title || 'Película');
const movieGenre = computed(() => theaterStore.currentMovie?.genre || 'Género');
const movieDuration = computed(() => theaterStore.currentMovie?.duration || '0 min');

// Session information
const sessionDate = computed(() => {
  if (!theaterStore.currentSession?.date) return 'Fecha no disponible';
  // Format the date
  const date = new Date(theaterStore.currentSession.date);
  return date.toLocaleDateString('ca-ES', { day: 'numeric', month: 'long', year: 'numeric' });
});

const sessionTime = computed(() => {
  if (!theaterStore.currentSession?.time) return 'Hora no disponible';
  return theaterStore.currentSession.time + 'h';
});

const theaterRoom = computed(() => {
  return theaterStore.currentSession?.room || 'Sala no disponible';
});

// Format price to EUR
const formatPrice = (price) => {
  return new Intl.NumberFormat('ca-ES', { style: 'currency', currency: 'EUR' }).format(price);
};

onMounted(() => {
  // If current movie isn't loaded, try to load it from the route params
  if (!theaterStore.currentMovie && route.params.id) {
    theaterStore.loadMovieAndSession(route.params.id);
  }
});
</script>

<style scoped>
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