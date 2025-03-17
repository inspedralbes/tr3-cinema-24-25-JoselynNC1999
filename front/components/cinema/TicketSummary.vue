<template>
  <div v-if="selectedSeats.length > 0" class="bg-blue-950/70 p-6 rounded-xl shadow-lg backdrop-blur-sm mt-4">
    <h3 class="text-xl font-bold mb-4">Resum de les teves entrades</h3>
    
    <div class="overflow-hidden bg-blue-900/40 rounded-lg mb-4">
      <table class="min-w-full divide-y divide-blue-800">
        <thead class="bg-blue-900/60">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-blue-300 uppercase tracking-wider">Butaca</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-blue-300 uppercase tracking-wider">Tipus</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-blue-300 uppercase tracking-wider">Preu</th>
            <th class="px-6 py-3 text-right text-xs font-medium text-blue-300 uppercase tracking-wider">Accions</th>
          </tr>
        </thead>
        <tbody class="bg-blue-900/20 divide-y divide-blue-800">
          <tr v-for="(seat, index) in selectedSeats" :key="index">
            <td class="px-6 py-4 whitespace-nowrap text-sm">
              {{ seat.row }}-{{ seat.seat }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm">
              {{ isVipSeat(seat.row) ? 'VIP' : 'Normal' }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm">
              {{ getPriceForSeat(seat.row) }}€
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-right">
              <button 
                @click="removeSeat(seat)"
                class="text-red-400 hover:text-red-300 transition-colors duration-200"
              >
                <span class="sr-only">Eliminar</span>
                ✕
              </button>
            </td>
          </tr>
        </tbody>
        <tfoot class="bg-blue-900/60">
          <tr>
            <td class="px-6 py-3 text-left text-xs font-medium text-blue-300 uppercase tracking-wider" colspan="2">
              Total
            </td>
            <td class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider" colspan="2">
              {{ totalPrice }}€
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
    
    <div class="text-sm text-blue-300">
      <p v-if="isDiscountDay" class="mb-2">
        <span class="text-yellow-400">Dia de l'espectador</span>: Preus reduïts aplicats!
      </p>
      <p>Recorda que només pots comprar un màxim de 10 entrades per sessió.</p>
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
  isVipSeat: {
    type: Function,
    required: true
  },
  getPriceForSeat: {
    type: Function,
    required: true
  },
  totalPrice: {
    type: Number,
    required: true
  }
});

const emit = defineEmits(['remove-seat']);

const removeSeat = (seat) => {
  emit('remove-seat', seat);
};
</script>