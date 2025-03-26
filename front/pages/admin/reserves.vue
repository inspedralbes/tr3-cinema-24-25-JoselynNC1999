<template>
  <div class="p-6 bg-white shadow rounded-lg">
    <h2 class="text-2xl font-bold mb-4">Administrar Precios</h2>
    
    <div class="grid grid-cols-2 gap-4">
      <div v-for="(price, type) in prices" :key="type" class="flex flex-col">
        <label :for="type" class="font-semibold">{{ formatLabel(type) }}</label>
        <input 
          :id="type" 
          v-model.number="prices[type]" 
          type="number" 
          min="0" 
          class="p-2 border rounded" 
        />
      </div>
    </div>
    
    <button @click="updatePrices" class="mt-4 bg-blue-500 text-white p-2 rounded hover:bg-blue-700">
      Guardar Cambios
    </button>
  </div>
</template>

<script>
import { useTheaterStore } from '@/stores/theater';
import { ref } from 'vue';

export default {
  setup() {
    const theaterStore = useTheaterStore();
    const prices = ref({ ...theaterStore.prices });

    const updatePrices = () => {
      theaterStore.prices = { ...prices.value };
      alert('Precios actualizados correctamente');
    };

    const formatLabel = (key) => {
      const labels = {
        normal: 'Precio Normal',
        vip: 'Precio VIP',
        discountNormal: 'Descuento Normal',
        discountVip: 'Descuento VIP',
      };
      return labels[key] || key;
    };

    return { prices, updatePrices, formatLabel };
  },
};
</script>

<style scoped>
  input {
    width: 100%;
  }
</style>