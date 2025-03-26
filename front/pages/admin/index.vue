<template>
  <div v-if="isLoading" class="flex items-center justify-center h-screen text-white">
    <p>Cargando...</p>
  </div>

  <div v-else-if="isAuthorized" class="flex h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-blue-900 text-white p-5">
      <div class="text-2xl font-bold text-center mb-6">CINÉPOLIS PEDRALBES</div>
      <ul class="space-y-2">
        <li><NuxtLink to="/admin" class="block p-3 rounded bg-white bg-opacity-20">Dashboard</NuxtLink></li>
        <li><NuxtLink to="/admin/sessions" class="block p-3 rounded hover:bg-white hover:bg-opacity-20">Gestió de Sessions</NuxtLink></li>
        <li><NuxtLink to="/admin/movies" class="block p-3 rounded hover:bg-white hover:bg-opacity-20">Pel·lícules</NuxtLink></li>
        <li><NuxtLink to="/admin/tickets" class="block p-3 rounded hover:bg-white hover:bg-opacity-20">Entrades</NuxtLink></li>
        <li><NuxtLink to="/admin/users" class="block p-3 rounded hover:bg-white hover:bg-opacity-20">Usuaris</NuxtLink></li>
        <li><NuxtLink to="/admin/settings" class="block p-3 rounded hover:bg-white hover:bg-opacity-20">Configuració</NuxtLink></li>
      </ul>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 bg-gray-100 overflow-y-auto">
      <header class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Dashboard</h1>
        <button class="bg-blue-900 text-white px-4 py-2 rounded">Informe Setmanal</button>
      </header>

      <!-- Dashboard Grid -->
      <div class="grid grid-cols-2 gap-6">
        <!-- Resumen de ventas -->
        <div class="bg-white p-6 rounded shadow">
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold">Resum de Vendes</h2>
            <button class="bg-blue-900 text-white px-4 py-2 rounded">Detalls</button>
          </div>
          <div class="grid grid-cols-2 gap-4">
            <div class="p-4 bg-gray-200 text-center rounded">
              <p class="text-xl font-bold text-blue-900">3.245€</p>
              <p class="text-sm text-gray-600">Ingressos Totals</p>
            </div>
            <div class="p-4 bg-gray-200 text-center rounded">
              <p class="text-xl font-bold text-blue-900">642</p>
              <p class="text-sm text-gray-600">Entrades Venudes</p>
            </div>
            <div class="p-4 bg-gray-200 text-center rounded">
              <p class="text-xl font-bold text-blue-900">18</p>
              <p class="text-sm text-gray-600">Sessions Avui</p>
            </div>
            <div class="p-4 bg-gray-200 text-center rounded">
              <p class="text-xl font-bold text-blue-900">35%</p>
              <p class="text-sm text-gray-600">Ocupació Mitja</p>
            </div>
          </div>
        </div>

        <!-- Gráfico de ingresos -->
        <div class="bg-white p-6 rounded shadow flex items-center justify-center">
          <p class="text-gray-600">Gràfic d'Ingressos (Placeholder)</p>
        </div>

        <!-- Películas más populares -->
        <div class="bg-white p-6 rounded shadow">
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold">Pel·lícules Més Populars</h2>
            <button class="bg-blue-900 text-white px-4 py-2 rounded">Veure Totes</button>
          </div>
          <div class="grid grid-cols-2 gap-4">
            <div class="p-4 bg-gray-200 text-center rounded">
              <p class="text-lg font-bold">Interstellar</p>
              <p class="text-sm text-gray-600">305 Entrades</p>
            </div>
            <div class="p-4 bg-gray-200 text-center rounded">
              <p class="text-lg font-bold">Dune</p>
              <p class="text-sm text-gray-600">276 Entrades</p>
            </div>
            <div class="p-4 bg-gray-200 text-center rounded">
              <p class="text-lg font-bold">Avatar</p>
              <p class="text-sm text-gray-600">248 Entrades</p>
            </div>
            <div class="p-4 bg-gray-200 text-center rounded">
              <p class="text-lg font-bold">Oppenheimer</p>
              <p class="text-sm text-gray-600">221 Entrades</p>
            </div>
          </div>
        </div>

        <!-- Estado de sesiones -->
        <div class="bg-white p-6 rounded shadow">
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold">Estat de Sessions</h2>
            <button class="bg-blue-900 text-white px-4 py-2 rounded">Gestionar</button>
          </div>
          <div class="grid grid-cols-2 gap-4">
            <div class="p-4 bg-gray-200 text-center rounded">
              <p class="text-xl font-bold text-blue-900">42</p>
              <p class="text-sm text-gray-600">Sessions Programades</p>
            </div>
            <div class="p-4 bg-gray-200 text-center rounded">
              <p class="text-xl font-bold text-blue-900">35</p>
              <p class="text-sm text-gray-600">Sessions Avui</p>
            </div>
            <div class="p-4 bg-gray-200 text-center rounded">
              <p class="text-xl font-bold text-blue-900">7</p>
              <p class="text-sm text-gray-600">Sessions Cancel·lades</p>
            </div>
            <div class="p-4 bg-gray-200 text-center rounded">
              <p class="text-xl font-bold text-blue-900">98%</p>
              <p class="text-sm text-gray-600">Taxa d'Execució</p>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth'
import { ref, watchEffect } from 'vue'
import { toRaw } from 'vue'

const authStore = useAuthStore()
const router = useRouter()
const isLoading = ref(true)
const isAuthorized = ref(false)

watchEffect(() => {
  // Verificar que `authStore.user` esté definido
  const user = toRaw(authStore.user)  // Usar `toRaw` para deshacer el proxy
  
  if (!user) {
    router.push('/login')  // Si no está autenticado, redirigir al login
  } else if (user.is_admin !== 1) {
    router.push('/')  // Si no es admin, mandarlo al home
  } else {
    isAuthorized.value = true
  }

  // Desactivar el cargador
  isLoading.value = false
})
</script>

<style scoped>
/* Estilos adicionales si es necesario */
</style>
