<template>
  <aside 
    :class="{
      'w-64': isSidebarVisible, 
      'w-16': !isSidebarVisible,
      'transition-all': true
    }" 
    class="bg-blue-900 text-white p-5">
    
    <div class="flex items-center justify-between mb-6">
      <!-- Título y botón de toggle -->
      <div v-if="isSidebarVisible" class="text-2xl font-bold text-center">CINÉPOLIS PEDRALBES</div>
      <button @click="toggleSidebar" class="text-white focus:outline-none">
        <svg v-if="isSidebarVisible" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
        <svg v-if="!isSidebarVisible" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>
    </div>

    <!-- Enlaces del Sidebar -->
    <ul class="space-y-2">
      <li><NuxtLink to="/admin" class="block p-3 rounded bg-white bg-opacity-20">Dashboard</NuxtLink></li>
      <li><NuxtLink to="/admin/sessions" class="block p-3 rounded hover:bg-white hover:bg-opacity-20">Gestió de Sessions</NuxtLink></li>
      <li><NuxtLink to="/admin/movies" class="block p-3 rounded hover:bg-white hover:bg-opacity-20">Pel·lícules</NuxtLink></li>
      <li><NuxtLink to="/admin/reserves" class="block p-3 rounded hover:bg-white hover:bg-opacity-20">Reserves</NuxtLink></li>
      <li><NuxtLink to="/admin/users" class="block p-3 rounded hover:bg-white hover:bg-opacity-20">Usuaris</NuxtLink></li>
      <li><NuxtLink to="/admin/ocupacio" class="block p-3 rounded hover:bg-white hover:bg-opacity-20">Ocupació</NuxtLink></li>
      <li><NuxtLink to="/admin/settings" class="block p-3 rounded hover:bg-white hover:bg-opacity-20">Configuració</NuxtLink></li>
    </ul>
  </aside>
</template>

<script setup>
import { ref } from 'vue'

const isSidebarVisible = ref(true) // Estado que controla la visibilidad del sidebar

// Función para alternar la visibilidad del sidebar
const toggleSidebar = () => {
  isSidebarVisible.value = !isSidebarVisible.value
}
</script>

<style scoped>
/* Puedes agregar estilos para animaciones suaves si lo deseas */
.transition-all {
  transition: width 0.3s ease;
}
</style>
