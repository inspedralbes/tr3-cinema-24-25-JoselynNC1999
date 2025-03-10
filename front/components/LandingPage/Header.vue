<template>
    <header class="py-4 px-6 bg-blue-950 shadow-lg">
      <div class="container mx-auto flex justify-between items-center">
        <div class="flex items-center">
          <span class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-purple-400 animate-pulse">{{ siteName }}</span>
        </div>
        <nav class="hidden md:flex space-x-8">
          <a v-for="(item, index) in navItems" :key="index" :href="item.url" class="hover:text-blue-300 transition-colors duration-300">{{ item.title }}</a>
        </nav>
        <button class="md:hidden text-2xl" @click="$emit('toggle-mobile-menu')">
          <i class="fas fa-bars"></i>
        </button>
      </div>
    </header>
  </template>
  
  <script setup>
  defineProps({
    siteName: {
      type: String,
      default: 'Cinépolis Pedralbes'
    },
    navItems: {
      type: Array,
      default: () => [
        { title: 'Inici', url: '#' },
        { title: 'Cartellera', url: '#' },
        { title: 'Promocions', url: '#' },
        { title: 'Sobre nosaltres', url: '#' },
        { title: 'Contacte', url: '#' }
      ]
    }
  })
  
  defineEmits(['toggle-mobile-menu'])
  </script>
  