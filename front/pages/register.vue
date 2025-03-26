<script setup>
import { ref, reactive } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from '@/stores/auth';
import TheFooter from '@/components/layout/TheFooter.vue';
import TheHeader from '@/components/layout/TheHeader.vue';

const authStore = useAuthStore();
const router = useRouter();

const user = reactive({
  name: '',
  email: '',
  password: '',
  confirmPassword: ''
});
const registerError = ref('');
const acceptTerms = ref(false);

const handleRegister = async () => {
  try {
    if (user.password !== user.confirmPassword) {
      registerError.value = 'Las contraseñas no coinciden';
      return;
    }

    if (!acceptTerms.value) {
      registerError.value = 'Debes aceptar los términos y condiciones';
      return;
    }

    registerError.value = '';
    await authStore.register(user); // Usar la store de autenticación

    console.log('✅ Usuario registrado:', JSON.parse(JSON.stringify(authStore.user)));

    router.push('/login'); // Redirigir a la página principal después del registro
  } catch (error) {
    console.error('Error en el registro', error);
    registerError.value = 'Error al registrar usuario. Por favor, inténtalo de nuevo.';
  }
};

const showLogin = () => {
  router.push('/login'); 
};
</script>


<template>
  <div class="min-h-screen bg-gradient-to-b from-blue-900 to-blue-800 text-white flex flex-col">
    <TheHeader />


    <!-- Main content -->
    <main class="flex-grow flex items-center justify-center p-6 md:p-12 relative">
      <!-- Animated background elements -->
      <div class="absolute top-20 left-10 w-8 h-8 rounded-full bg-blue-400 opacity-20 animate-pulse"></div>
      <div class="absolute bottom-20 right-20 w-12 h-12 rounded-full bg-purple-400 opacity-20 animate-bounce"></div>
      <div class="absolute top-40 right-40 w-6 h-6 rounded-full bg-yellow-400 opacity-20 animate-ping"></div>
      
      <!-- Register Form -->
      <div class="bg-blue-950/80 p-8 rounded-2xl shadow-2xl backdrop-blur-sm w-full max-w-md relative">
        <div class="absolute -top-4 -left-4 w-16 h-16 bg-purple-400 rounded-full animate-ping opacity-70"></div>
        
        <h2 class="text-3xl font-bold mb-6 text-center bg-gradient-to-r from-blue-400 to-purple-500 bg-clip-text text-transparent">
          Crear compte
        </h2>
        
        <form @submit.prevent="handleRegister" class="flex flex-col gap-5">
          <div>
            <label for="name" class="block text-blue-300 mb-2">Nom complet</label>
            <input 
              v-model="user.name"
              type="text" 
              id="name" 
              placeholder="El teu nom"
              class="w-full px-4 py-3 rounded-full bg-blue-900 border border-blue-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-400"
              required
            >
          </div>
          
          <div>
            <label for="email" class="block text-blue-300 mb-2">Correu electrònic</label>
            <input 
              v-model="user.email"
              type="email" 
              id="email" 
              placeholder="El teu email"
              class="w-full px-4 py-3 rounded-full bg-blue-900 border border-blue-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-400"
              required
            >
          </div>
          
          <div>
            <label for="password" class="block text-blue-300 mb-2">Contrasenya</label>
            <input 
              v-model="user.password"
              type="password" 
              id="password" 
              placeholder="La teva contrasenya"
              class="w-full px-4 py-3 rounded-full bg-blue-900 border border-blue-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-400"
              required
            >
          </div>
          
          <div>
            <label for="confirmPassword" class="block text-blue-300 mb-2">Confirmar contraseña</label>
            <input 
              v-model="user.confirmPassword"
              type="password" 
              id="confirmPassword" 
              placeholder="Confirma la teva contrasenya"
              class="w-full px-4 py-3 rounded-full bg-blue-900 border border-blue-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-400"
              required
            >
          </div>
          
          <div class="flex items-center mt-2">
            <input 
              v-model="acceptTerms"
              type="checkbox" 
              id="terms" 
              class="mr-2"
              required
            >
            <label for="terms" class="text-blue-300">
              Accepto els <a href="/terms" class="text-blue-400 hover:text-blue-300">termes i condicions</a>
            </label>
          </div>
          
          <div v-if="registerError" class="bg-red-900/50 border border-red-500 text-white px-4 py-2 rounded-lg text-sm">
            {{ registerError }}
          </div>
          
          <button 
            type="submit"
            class="w-full bg-purple-600 text-white font-semibold py-3 px-8 rounded-full border-none cursor-pointer transition-all hover:bg-purple-700 hover:scale-105 shadow-md mt-2"
          >
          Crear compte
          </button>
        </form>
        
        <div class="mt-6 relative flex items-center justify-center">
          <div class="absolute top-1/2 left-0 right-0 h-px bg-blue-700"></div>
          <span class="relative px-4 bg-blue-950 text-blue-300">o registra't amb</span>
        </div>
        
        <div class="mt-6 grid grid-cols-2 gap-3">
          <button class="flex justify-center items-center py-2 px-4 border border-blue-700 rounded-full bg-transparent text-white cursor-pointer hover:bg-blue-800 transition-colors">
            <i class="fab fa-google mr-2"></i> Google
          </button>
          
          <button class="flex justify-center items-center py-2 px-4 border border-blue-700 rounded-full bg-transparent text-white cursor-pointer hover:bg-blue-800 transition-colors">
            <i class="fab fa-facebook mr-2"></i> Facebook
          </button>
        </div>
        
        <p class="mt-8 text-center text-blue-300">
          Ja tens un compte?
          <a @click="showLogin" class="text-blue-400 hover:text-blue-300 transition-colors cursor-pointer font-medium">
            Iniciar Sessió
          </a>
        </p>
      </div>
    </main>
    <TheFooter />
  </div>
</template>