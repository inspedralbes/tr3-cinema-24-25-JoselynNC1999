<template>
  <header class="py-4 px-6 bg-blue-950 shadow-lg">
    <div class="container mx-auto flex justify-between items-center">
      <div class="flex items-center">
        <span class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-purple-400 animate-pulse">
          {{ siteName }}
        </span>
      </div>
      <nav class="hidden md:flex items-center space-x-8">
        <NuxtLink
          v-for="(item, index) in navItems"
          :key="index"
          :to="item.url"
          class="hover:text-blue-300 transition-colors duration-300"
        >
          {{ item.title }}
        </NuxtLink>
        
        <!-- Conditional rendering for Login/Logout -->
        <template v-if="isLoggedIn">
          <button 
            @click="logout" 
            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors duration-300"
          >
            Tancar Sessió
          </button>
        </template>
        <template v-else>
          <NuxtLink 
            to="/login" 
            class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-bold rounded-full shadow-lg hover:from-blue-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 animate-pulse"
          >
            Iniciar Sessió
          </NuxtLink>
        </template>
      </nav>
      <button class="md:hidden text-2xl" @click="$emit('toggle-mobile-menu')">
        <i class="fas fa-bars"></i>
      </button>
    </div>
  </header>
</template>

<script setup>
import { ref } from 'vue'

const isLoggedIn = ref(false) // This should be managed by your authentication state

const props = defineProps({
  siteName: {
    type: String,
    default: 'Cinépolis Pedralbes'
  },
  navItems: {
    type: Array,
    default: () => [
      { title: 'Inici', url: '/' },
      { title: 'Cartellera', url: '/cartellera' },
      { title: 'Sobre nosaltres', url: '/sobre' }
    ]
  }
})

const emit = defineEmits(['toggle-mobile-menu', 'logout'])

const logout = () => {
  // Implement logout logic
  emit('logout')
  isLoggedIn.value = false
  // Typically, you'd also:
  // - Clear authentication token
  // - Redirect to home or login page
}

// You might want to add a method to update login state
const updateLoginState = (state) => {
  isLoggedIn.value = state
}

// Expose method to parent component if needed
defineExpose({
  updateLoginState
})
</script>