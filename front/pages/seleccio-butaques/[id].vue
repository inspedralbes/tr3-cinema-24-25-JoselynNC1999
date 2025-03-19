<template>
  <div class="min-h-screen bg-gradient-to-b from-blue-900 to-blue-800 text-white">
    <TheHeader />
    
    <div class="min-h-screen bg-gradient-to-b from-blue-900 to-blue-800 text-white">
      <section class="py-8 px-6 relative overflow-hidden">
        <div class="container mx-auto relative z-10">
          <!-- Breadcrumb Navigation -->
          <BreadcrumbNavigation />

          <!-- Movie Info -->
          <div class="md:flex items-start mb-8">
            <div class="w-full md:w-1/4 mb-6 md:mb-0">
              <MovieGrid :movie="theaterStore.currentMovie" v-if="theaterStore.currentMovie" />
            </div>
            <div class="w-full md:w-3/4 md:pl-8">
              <SessionInfo 
                v-if="theaterStore.currentSession"
                :session="theaterStore.currentSession"
                :selectedSeats="theaterStore.selectedSeats" 
                :isDiscountDay="theaterStore.isDiscountDay" 
                :totalPrice="theaterStore.totalPrice" 
                @toggle-discount="theaterStore.toggleDiscountDay()"
              />
              
              <!-- Legend -->
              <SeatLegend :prices="theaterStore.prices" :isDiscountDay="theaterStore.isDiscountDay" />
              
              <!-- Ticket Summary -->
              <TicketSummary 
                v-if="theaterStore.selectedSeats.length > 0"
                :selectedSeats="theaterStore.selectedSeats"
                :isDiscountDay="theaterStore.isDiscountDay"
                :isVipSeat="theaterStore.isVipSeat"
                :getPriceForSeat="theaterStore.getPricePerSeat"
                :totalPrice="theaterStore.totalPrice"
                @remove-seat="removeSeat"
              />
            </div>
          </div>
          
          <!-- Seats Selection -->
          <div class="max-w-5xl mx-auto">
            <!-- Screen -->
            <PantallaTeatro />
            
            <!-- Seats Grid -->
            <div class="py-8">
              <div v-for="row in theaterStore.rowLetters" :key="row" class="flex justify-center mb-4">
                <div class="w-8 flex items-center justify-center text-blue-300 font-semibold">{{ row }}</div>
                <div class="flex gap-2">
                  <button 
                    v-for="seat in theaterStore.seatsPerRow" 
                    :key="`${row}-${seat}`"
                    :class="[ 
                      'w-8 h-8 rounded-t-lg transition-all transform hover:scale-110',
                      theaterStore.getSeatClass(row, seat)
                    ]"
                    @click="theaterStore.toggleSeat(row, seat)"
                  ></button>
                </div>
                <div class="w-8 flex items-center justify-center text-blue-300 font-semibold">{{ row }}</div>
              </div>
            </div>
            
            <!-- Confirmación -->
            <div class="mt-8 text-center">
              <NuxtLink 
              v-if="theaterStore.selectedSeats.length > 0"
              :to="`/entrada/${route.params.id}`"
              class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-all"
            >
              Confirmar Compra
            </NuxtLink>

            </div>
            
            <!-- Info adicional -->
            <div class="mt-6 text-center text-blue-300 text-sm">
              <p>Al confirmar la compra, acceptes les condicions del servei.</p>
              <p>Recorda: Un usuari només pot tenir entrades per a una sessió futura alhora.</p>
            </div>
          </div>
        </div>
      </section>
    </div>
    
    <PromoSection class="my-12" />
    <NewsletterSection class="mt-16" />
    <TheFooter />
  </div>
</template>

<script setup>
import { onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { useTheaterStore } from '@/stores/theater';

import BreadcrumbNavigation from '@/components/cinema/BreadcrumbNavigation.vue';
import MovieGrid from '@/components/sections/MovieGrid.vue';
import SessionInfo from '@/components/cinema/SessionInfo.vue';
import SeatLegend from '@/components/cinema/SeatLegend.vue';
import PantallaTeatro from '@/components/cinema/PantallaTeatro.vue';
import TheHeader from '@/components/layout/TheHeader.vue';
import PromoSection from '@/components/layout/PromoSection.vue';
import NewsletterSection from '@/components/sections/NewsletterSection.vue';
import TheFooter from '@/components/layout/TheFooter.vue';
import TicketSummary from '@/components/cinema/TicketSummary.vue';

const theaterStore = useTheaterStore();
const route = useRoute();

// Obtener el ID de la película de la URL y cargar los datos al montar la página
onMounted(() => {
  const movieId = route.params.id;  // Obtiene el ID de la película de la URL
  if (movieId) {
    theaterStore.loadMovieAndSession(movieId);
  }
});


// Función para remover un asiento desde el resumen
const removeSeat = (seat) => {
  theaterStore.toggleSeat(seat.row, seat.seat);
};
</script>
