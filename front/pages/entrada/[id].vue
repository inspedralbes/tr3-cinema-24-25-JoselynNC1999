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
                      <img v-if="theaterStore.currentMovie?.poster_url" 
                           :src="theaterStore.currentMovie.poster_url" 
                           alt="Movie poster" 
                           class="object-cover w-full h-full" />
                      <img v-else 
                           src="https://via.placeholder.com/500x750" 
                           alt="Placeholder poster" 
                           class="object-cover w-full h-full" />
                      <div class="absolute inset-0 bg-gradient-to-t from-blue-900/70 to-transparent"></div>
                    </div>
                  </div>
                  <h3 class="text-xl font-bold mb-2">{{ theaterStore.currentMovie?.title }}</h3>
                  <p class="text-blue-300 mb-1">{{ theaterStore.currentMovie?.genre }} | {{ theaterStore.currentMovie?.duration }} min</p>
               
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
    <div 
      v-for="(seat, index) in theaterStore.selectedSeats" 
      :key="index" 
      class="flex justify-between items-center"
    >
      <!-- Butaca info -->
      <div class="flex items-center">
        <div 
          class="w-8 h-8 rounded-lg flex items-center justify-center mr-2"
          :class="theaterStore.isVipSeat(seat.row, seat.seat) ? 'bg-purple-600' : 'bg-blue-600'"
        >
          <span class="font-bold text-sm">{{ seat.row }}{{ seat.seat }}</span>
        </div>
        <span>
          Butaca 
          <strong>{{ theaterStore.isVipSeat(seat.row, seat.seat) ? 'VIP' : 'Estàndard' }}</strong>
        </span>
      </div>

      <!-- Precio -->
      <div class="text-right">
        <span class="font-bold">
          {{ theaterStore.getPricePerSeat(seat.row) }}€
        </span>                        
        <span v-if="theaterStore.isDiscountDay" class="text-xs text-blue-300 block">
          Amb descompte 2x1
        </span>
      </div>
    </div>
  </div>

  <!-- Total Price (siempre visible) -->
  <div class="text-right border-t border-blue-800 pt-3">
    <span class="text-lg font-bold">
      Total: {{ theaterStore.totalPrice }}€
    </span>
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
                    <button @click="sendEmail" :disabled="isSendingEmail" 
  class="flex-1 border-2 border-blue-400 hover:bg-blue-800 text-white px-6 py-3 rounded-lg font-semibold transition-all">
  <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
  </svg>
  {{ isSendingEmail ? 'Enviant...' : 'Enviar per email' }}
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
import { useAuthStore } from '~/stores/auth'
import { nextTick } from "vue";
import QRCode from 'qrcode'; // Make sure to install this package

const totalPrice = computed(() => theaterStore.totalPrice);
const route = useRoute();
const theaterStore = useTheaterStore();
const movieId = ref(route.params.id);
const isSendingEmail = ref(false);
const ticketsWithQRs = ref([]);

// QR Code Generation Function
const generateTicketQRs = async (reservationData) => {
  const generateQRForSeat = async (seat, index) => {
    // Create a unique ticket identifier
    const ticketId = `${reservationData.movie_title}-${reservationData.date}-${reservationData.time}-${seat.row}-${seat.number}-${index}`;
    
    try {
      // Generate QR code as a data URL
      const qrCodeDataUrl = await QRCode.toDataURL(ticketId, {
        errorCorrectionLevel: 'H',
        width: 200, // Adjust size as needed
        margin: 2
      });
      return {
        ...seat,
        qrCode: qrCodeDataUrl,
        ticketId: ticketId
      };
    } catch (error) {
      console.error('Error generating QR code:', error);
      return {
        ...seat,
        qrCode: null,
        ticketId: ticketId
      };
    }
  };

  // Generate QR codes for all seats
  const seatsWithQRs = await Promise.all(
    reservationData.seats.map((seat, index) => generateQRForSeat(seat, index))
  );

  // Update the reactive ref to display QRs in the template
  ticketsWithQRs.value = seatsWithQRs;

  // Return updated reservation data with QR codes
  return {
    ...reservationData,
    seats: seatsWithQRs
  };
};
const sendEmail = async () => {
  const authStore = useAuthStore();
  isSendingEmail.value = true;

  // Existing date and time formatting functions
  const formatDate = (dateValue) => {
    if (dateValue instanceof Date && !isNaN(dateValue)) {
      return dateValue.toISOString().split('T')[0];
    }
    if (typeof dateValue === 'string') {
      const parsedDate = new Date(dateValue);
      if (!isNaN(parsedDate)) {
        return parsedDate.toISOString().split('T')[0];
      }
    }
    return new Date().toISOString().split('T')[0];
  };

  const formatTime = (timeValue) => {
    if (/^\d{2}:\d{2}$/.test(timeValue)) {
      return timeValue;
    }
    let cleanTime = timeValue.replace('h', '').trim();
    return cleanTime.length === 5 ? cleanTime : '16:00';
  };

  try {
    // Validate user email
    const userEmail = authStore.user?.email;
    if (!userEmail) {
      throw new Error('No s\'ha trobat un correu electrònic per a l\'usuari');
    }

    // Prepare reservation data
    const basicReservationData = {
      user_id: authStore.user?.id || 1, 
      session_id: theaterStore.currentSession?.id || 123, 
      movie_title: theaterStore.currentMovie?.title || 'Pel·lícula',
      date: formatDate(sessionDate.value), 
      time: formatTime(sessionTime.value), 
      room: theaterRoom.value || 'Sala 1', 
      seats: theaterStore.selectedSeats.map(seat => ({
        row: seat.row,
        number: seat.seat,
        type: theaterStore.isVipSeat(seat.row, seat.seat) ? 'VIP' : 'Estàndard',
        price: theaterStore.getPricePerSeat(seat.row)
      })),
      total_price: theaterStore.totalPrice,
      email: userEmail,
    };

    // Generate QR codes for tickets
    const reservationDataWithQRs = await generateTicketQRs(basicReservationData);

    // Use the new sendTicketEmail method from the auth store
    const response = await authStore.sendTicketEmail(reservationDataWithQRs);

    // Show success popup
    showPopup('📩 Correu enviat amb èxit!', 'success');

  } catch (error) {
    console.error('Error complet:', error);
    showPopup(`❌ No s'ha pogut enviar el correu: ${error.message}`, 'error');
  } finally {
    isSendingEmail.value = false;
  }
};

function showPopup(message, type = 'info') {
  let popup = document.createElement("div");
  popup.innerText = message;
  popup.style.position = "fixed";
  popup.style.top = "50%";
  popup.style.left = "50%";
  popup.style.transform = "translate(-50%, -50%)";
  popup.style.background = type === 'success' ? "green" : "red";
  popup.style.color = "white";
  popup.style.padding = "15px";
  popup.style.borderRadius = "5px";
  popup.style.zIndex = "1000";
  popup.style.fontSize = "16px";
  popup.style.boxShadow = "0 4px 8px rgba(0, 0, 0, 0.2)";
  
  document.body.appendChild(popup);

  setTimeout(() => {
    popup.remove();
  }, 3000);
}

// Generate a random order code
const orderCode = ref('CINP' + Math.floor(Math.random() * 10000).toString().padStart(4, '0'));

// Get movie ID from the store or route


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
  return theaterStore.currentSession?.room || 'Sala 1';
});

// Format price to EUR
const formatPrice = (price) => {
  return new Intl.NumberFormat('ca-ES', { style: 'currency', currency: 'EUR' }).format(price);
};

onMounted(async () => {
  if (movieId.value) {
    await theaterStore.loadMovieAndSession(movieId.value);
    await theaterStore.fetchMovieDetails(movieId.value);
    await nextTick(); // Espera a que la UI se actualice completamente
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


