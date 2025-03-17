<template>
  <div class="bg-blue-900/60 p-8 rounded-xl shadow-lg transform hover:-translate-y-2 transition-transform">
    <div class="w-16 h-16 bg-blue-600 rounded-full mb-6 flex items-center justify-center">
      <span class="text-2xl">{{ icon }}</span>
    </div>
    <h3 class="text-xl font-bold mb-4">{{ title }}</h3>
    <p class="text-blue-200">{{ description }}</p>
  </div>
</template>

<script setup>
defineProps({
  icon: {
    type: String,
    required: true
  },
  title: {
    type: String,
    required: true
  },
  description: {
    type: String,
    required: true
  }
})
</script>