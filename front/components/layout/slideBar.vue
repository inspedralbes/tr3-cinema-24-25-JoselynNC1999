<!-- components/layouts/Sidebar.vue -->
<template>
    <aside class="w-64 bg-blue-900 text-white p-5">
      <div class="text-2xl font-bold text-center mb-6">CINÉPOLIS PEDRALBES</div>
      <ul class="space-y-2">
        <li><NuxtLink to="/admin" class="block p-3 rounded bg-white bg-opacity-20">Dashboard</NuxtLink></li>
        <li><NuxtLink to="/admin/sessions" class="block p-3 rounded hover:bg-white hover:bg-opacity-20">Gestió de Sessions</NuxtLink></li>
        <li><NuxtLink to="/admin/movies" class="block p-3 rounded hover:bg-white hover:bg-opacity-20">Pel·lícules</NuxtLink></li>
        <li><NuxtLink to="/admin/reserves" class="block p-3 rounded hover:bg-white hover:bg-opacity-20">Reserves</NuxtLink></li>
        <li><NuxtLink to="/admin/users" class="block p-3 rounded hover:bg-white hover:bg-opacity-20">Usuaris</NuxtLink></li>
        <li><NuxtLink to="/admin/ocupacio" class="block p-3 rounded hover:bg-white hover:bg-opacity-20">Ocupació</NuxtLink></li>
        <li><NuxtLink to="/admin/reportes" class="block p-3 rounded hover:bg-white hover:bg-opacity-20">Reportes</NuxtLink></li>
        <li><NuxtLink to="/admin/settings" class="block p-3 rounded hover:bg-white hover:bg-opacity-20">Configuració</NuxtLink></li>
      </ul>
    </aside>
  </template>
  
  <script setup>
  </script>
  
  <style scoped>
  </style>
  