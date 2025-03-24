<template>
  <div class="min-h-screen bg-gradient-to-b from-blue-900 to-blue-800 text-white">
    <TheHeader />
    
      <section class="py-8 px-6 relative overflow-hidden">
        <div class="container mx-auto relative z-10">
          <!-- Breadcrumb Navigation -->
          <BreadcrumbNavigation />

          <!-- Movie Info -->
          <div class="md:flex items-start mb-8">
            
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
  @click="!theaterStore.isSeatOccupied(row, seat) && theaterStore.toggleSeat(row, seat)"
  :disabled="theaterStore.isSeatOccupied(row, seat)"
></button>

                </div>
                <div class="w-8 flex items-center justify-center text-blue-300 font-semibold">{{ row }}</div>
              </div>
            </div>
            
            <!-- Confirmación -->
            <div class="mt-8 text-center">
              <NuxtLink 
                v-if="theaterStore.selectedSeats.length > 0"
                @click.prevent="reserveSeats" 
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
    
    
    <PromoSection class="my-12" />
    <NewsletterSection class="mt-16" />
    <TheFooter />
  </div>
</template>

<script setup>
import { onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { useTheaterStore } from '@/stores/theater';
import { useAuthStore } from '@/stores/auth'; // Si necesitas comprobar si el usuario está autenticado

import BreadcrumbNavigation from '@/components/cinema/BreadcrumbNavigation.vue';
import SessionInfo from '@/components/cinema/SessionInfo.vue';
import SeatLegend from '@/components/cinema/SeatLegend.vue';
import PantallaTeatro from '@/components/cinema/PantallaTeatro.vue';
import TheHeader from '@/components/layout/TheHeader.vue';
import PromoSection from '@/components/layout/PromoSection.vue';
import NewsletterSection from '@/components/sections/NewsletterSection.vue';
import TheFooter from '@/components/layout/TheFooter.vue';
import TicketSummary from '@/components/cinema/TicketSummary.vue';

const theaterStore = useTheaterStore();
const authStore = useAuthStore(); // Si usas un store de autenticación
const route = useRoute();

// Obtener el ID de la película de la URL y cargar los datos al montar la página
onMounted(async () => {
  try {
    const movieId = route.params.id;
    console.log('Página montada, ID de película:', movieId);
    
    if (movieId) {
      // Cargar datos de película y sesión primero
      await theaterStore.loadMovieAndSession(movieId);
      
      // Luego buscar asientos si tenemos una sesión
      if (theaterStore.currentSession?.id) {
        console.log('Buscando asientos para la sesión ID:', theaterStore.currentSession.id);
        await theaterStore.fetchSeats(theaterStore.currentSession.id);
        console.log("Asientos ocupados:", theaterStore.occupiedSeats);
      } else {
        console.warn('No hay ID de sesión disponible para buscar asientos');
      }
    }
  } catch (error) {
    console.error('Error al cargar datos del teatro:', error);
  }
});

// Función para remover un asiento desde el resumen
const removeSeat = (seat) => {
  theaterStore.toggleSeat(seat.row, seat.seat);
};

// Función para reservar los asientos
const reserveSeats = async () => {
  if (authStore.user) {
    await theaterStore.reserveSeats();
  } else {
    alert('Debes iniciar sesión para reservar');
  }
};
</script>
