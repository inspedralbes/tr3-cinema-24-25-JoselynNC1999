<template>
    <div class="container mx-auto px-6 py-4">
      <div class="flex items-center text-sm text-blue-300">
        <NuxtLink to="/" class="hover:text-blue-200">Inici</NuxtLink>
        <span class="mx-2">›</span>
        <NuxtLink to="/cartellera" class="hover:text-blue-200">Cartellera</NuxtLink>
        <span class="mx-2">›</span>
        <span class="text-blue-100">{{ currentTitle }}</span>
      </div>
    </div>
  </template>
  
  <script setup>
  defineProps({
    currentTitle: {
      type: String,
      required: true
    }
  });
  </script>
  