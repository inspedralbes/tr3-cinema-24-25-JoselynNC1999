<template>
    <div class="flex flex-wrap items-center justify-center gap-6 mb-6">
      <div class="flex items-center">
        <div class="w-6 h-6 rounded bg-blue-400 mr-2"></div>
        <span class="text-sm">Disponible ({{ isDiscountDay ? prices.discountNormal : prices.normal }}€)</span>
      </div>
      <div class="flex items-center">
        <div class="w-6 h-6 rounded bg-yellow-400 mr-2"></div>
        <span class="text-sm">Seleccionada</span>
      </div>
      <div class="flex items-center">
        <div class="w-6 h-6 rounded bg-gray-500 mr-2"></div>
        <span class="text-sm">Ocupada</span>
      </div>
      <div class="flex items-center">
        <div class="w-6 h-6 rounded bg-purple-500 mr-2"></div>
        <span class="text-sm">VIP ({{ isDiscountDay ? prices.discountVip : prices.vip }}€)</span>
      </div>
    </div>
  </template>
  
  <script setup>
  defineProps({
    prices: {
      type: Object,
      required: true
    },
    isDiscountDay: {
      type: Boolean,
      default: false
    }
  });
  </script>