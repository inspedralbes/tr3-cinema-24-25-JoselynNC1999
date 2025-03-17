// SalaTeatro.vue - Componente principal
<template>
  <div class="min-h-screen bg-gradient-to-b from-blue-900 to-blue-800 text-white">
    <section class="py-8 px-6 relative overflow-hidden">
      <div class="container mx-auto relative z-10">
        <!-- Breadcrumb Navigation -->
        <BreadcrumbNavigation />

        <!-- Movie Info -->
        <div class="md:flex items-start mb-8">
          <div class="w-full md:w-1/4 mb-6 md:mb-0">
            <MovieCard />
          </div>
          <div class="w-full md:w-3/4 md:pl-8">
            <SessionInfo 
              :selectedSeats="selectedSeats" 
              :isDiscountDay="isDiscountDay" 
              :totalPrice="totalPrice" 
            />
            
            <!-- Legend -->
            <SeatLegend />
          </div>
        </div>
        
        <!-- Seats Selection -->
        <div class="max-w-4xl mx-auto">
          <!-- Screen -->
          <PantallaTeatro />
          
          <!-- Seats Grid -->
          <div class="py-8">
            <div v-for="row in rows" :key="row" class="flex justify-center mb-4">
              <div class="w-8 flex items-center justify-center text-blue-300 font-semibold">{{ row }}</div>
              <div class="flex gap-2">
                <button 
                  v-for="seat in 10" 
                  :key="`${row}-${seat}`"
                  :class="[
                    'w-8 h-8 rounded-t-lg transition-all transform hover:scale-110',
                    getSeatClass(row, seat)
                  ]"
                  @click="toggleSeat(row, seat)"
                ></button>
              </div>
              <div class="w-8 flex items-center justify-center text-blue-300 font-semibold">{{ row }}</div>
            </div>
          </div>
          
          <!-- Confirmación -->
          <div class="mt-8 text-center">
            <button 
              class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-all disabled:opacity-50"
              :disabled="selectedSeats.length === 0"
              @click="confirmPurchase"
            >
              Confirmar Compraaaaa
            </button>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';

// Definimos las filas de A a L (12 filas)
const rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L'];

// Estado para butacas
const occupiedSeats = ref([
  { row: 'A', seat: 4 },
  { row: 'A', seat: 5 },
  { row: 'B', seat: 3 },
  { row: 'C', seat: 4 },
  // Puedes añadir más asientos ocupados aquí
]);

const selectedSeats = ref([]);
const isDiscountDay = ref(false); // Día del espectador

// Comprobar si es VIP (fila F, que es la 6)
const isVipSeat = (row) => row === 'F';

// Obtener el precio por asiento
const getPricePerSeat = (row) => {
  const basePrice = isVipSeat(row) ? 8 : 6;
  return isDiscountDay.value ? basePrice - 2 : basePrice;
};

// Calcular el precio total
const totalPrice = computed(() => {
  return selectedSeats.value.reduce((total, seat) => {
    return total + getPricePerSeat(seat.row);
  }, 0);
});

// Comprobar si el asiento está ocupado
const isSeatOccupied = (row, seat) => {
  return occupiedSeats.value.some(s => s.row === row && s.seat === seat);
};

// Comprobar si el asiento está seleccionado
const isSeatSelected = (row, seat) => {
  return selectedSeats.value.some(s => s.row === row && s.seat === seat);
};

// Obtener la clase CSS para el asiento
const getSeatClass = (row, seat) => {
  if (isSeatOccupied(row, seat)) return 'bg-gray-500';
  if (isSeatSelected(row, seat)) return 'bg-yellow-400';
  if (isVipSeat(row)) return 'bg-purple-500';
  return 'bg-blue-400';
};

// Toggle selección de asiento
const toggleSeat = (row, seat) => {
  if (isSeatOccupied(row, seat)) return;
  
  const seatIndex = selectedSeats.value.findIndex(s => s.row === row && s.seat === seat);
  
  if (seatIndex !== -1) {
    // Deseleccionar asiento
    selectedSeats.value.splice(seatIndex, 1);
  } else {
    // Seleccionar asiento si no se ha alcanzado el límite
    if (selectedSeats.value.length < 10) {
      selectedSeats.value.push({ row, seat });
    } else {
      alert('No puedes seleccionar más de 10 butacas por sesión');
    }
  }
};

// Confirmar compra
const confirmPurchase = () => {
  // Aquí iría la lógica de compra
  alert(`Compra confirmada: ${selectedSeats.value.length} butacas por ${totalPrice.value}€`);
};
</script>

// BreadcrumbNavigation.vue
<template>
  <div class="flex items-center mb-6 text-blue-300 text-sm">
    <a href="#" class="hover:text-white transition-colors">Inici</a>
    <span class="mx-2">/</span>
    <a href="#" class="hover:text-white transition-colors">Cartellera</a>
    <span class="mx-2">/</span>
    <span class="mx-2">/</span>
    <span class="text-white">Selecció de butaques</span>
  </div>
</template>

// MovieCard.vue
<template>
  <div class="bg-blue-900/40 rounded-lg overflow-hidden shadow-lg">
    <div class="relative h-64 bg-blue-800">
      <div class="absolute inset-0 flex items-center justify-center">
        <span class="text-4xl">🎬</span>
      </div>
      <div class="absolute top-2 right-2 bg-blue-600 text-xs px-2 py-1 rounded">ESTRENA</div>
    </div>
    <div class="p-4">
      <div class="flex mb-2">
        <div class="text-yellow-400 flex">
          <span>★</span><span>★</span><span>★</span><span>★</span><span class="text-blue-700">★</span>
        </div>
        <span class="text-xs ml-2 text-blue-300">4.0/5.0</span>
      </div>
      <p class="text-blue-200 text-sm">Ciència Ficció | 120 min</p>
    </div>
  </div>
</template>

// SessionInfo.vue
<template>
  <div class="bg-blue-950/70 p-6 rounded-xl shadow-lg backdrop-blur-sm mb-6">
    <div class="flex flex-wrap gap-4 items-center mb-4">
      <div class="bg-blue-900/60 px-4 py-2 rounded-full">
        <span class="text-blue-300 text-sm">Data:</span>
        <span class="ml-2 font-semibold">15 Mar 2025</span>
      </div>
      <div class="bg-blue-900/60 px-4 py-2 rounded-full">
        <span class="text-blue-300 text-sm">Hora:</span>
        <span class="ml-2 font-semibold">19:30</span>
      </div>
      <div class="bg-blue-900/60 px-4 py-2 rounded-full">
        <span class="text-blue-300 text-sm">Sala:</span>
        <span class="ml-2 font-semibold">VIP 3</span>
      </div>
      <div v-if="isDiscountDay" class="bg-yellow-600/60 px-4 py-2 rounded-full">
        <span class="font-semibold">Dia de l'espectador!</span>
      </div>
    </div>
    <div class="flex items-center justify-between">
      <div>
        <h2 class="text-2xl font-bold mb-2">Selecció de butaques</h2>
        <p class="text-blue-300">Selecciona fins a 10 butaques per la teva sessió</p>
      </div>
      <div class="text-right">
        <div class="text-yellow-400 font-bold text-lg">
          Butaques: <span>{{ selectedSeats.length }}/10</span>
        </div>
        <div class="text-blue-300">
          Total: {{ totalPrice }}€
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  selectedSeats: {
    type: Array,
    required: true
  },
  isDiscountDay: {
    type: Boolean,
    default: false
  },
  totalPrice: {
    type: Number,
    required: true
  }
});
</script>
// PantallaTeatro.vue
<template>
  <div class="relative mb-12">
    <div class="h-6 bg-blue-400/30 rounded-t-full mx-auto w-4/5 mb-1"></div>
    <div class="h-2 bg-blue-400/20 rounded-t-full mx-auto w-full"></div>
    <p class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 text-blue-300 text-sm font-medium">PANTALLA</p>
  </div>
</template>