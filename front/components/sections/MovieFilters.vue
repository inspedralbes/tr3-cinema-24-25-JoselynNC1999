<template>
  <section class="pb-8 pt-4 bg-blue-950/80">
    <div class="container mx-auto px-6">
      <div class="flex flex-wrap items-center justify-between gap-4">
        <div class="flex flex-wrap gap-2">
          <button 
            v-for="(date, index) in dates" 
            :key="index"
            :class="[
              'px-4 py-2 rounded-full text-sm font-medium transition',
              selectedDate === index 
                ? 'bg-blue-600 text-white' 
                : 'bg-blue-900/60 text-blue-300 hover:bg-blue-800'
            ]"
            @click="selectedDate = index"
          >
            {{ date }}
          </button>
        </div>
        <div class="flex gap-2">
          <select 
            v-model="selectedGenre"
            class="bg-blue-900/60 text-blue-300 px-4 py-2 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
          >
            <option value="">Tots els gèneres</option>
            <option v-for="genre in genres" :key="genre.value" :value="genre.value">
              {{ genre.label }}
            </option>
          </select>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
const selectedDate = ref(0);
const selectedGenre = ref('');

const dates = [
  'Avui',
  'Demà',
  'dium., 17',
  'dill., 18',
  'Totes les dates'
];

const genres = [
  { value: 'action', label: 'Acció' },
  { value: 'comedy', label: 'Comèdia' },
  { value: 'drama', label: 'Drama' },
  { value: 'scifi', label: 'Ciència ficció' }
];
</script>