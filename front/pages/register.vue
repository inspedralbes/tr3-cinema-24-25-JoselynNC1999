<script setup>
import { useAuth } from '@/composables/useAuth';
import { reactive, ref } from 'vue';
import { useRouter } from 'vue-router';

const { register } = useAuth();
const router = useRouter(); // Instancia del router

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
    // Validación de contraseñas
    if (user.password !== user.confirmPassword) {
      registerError.value = 'Las contraseñas no coinciden';
      return;
    }

    // Validación de términos
    if (!acceptTerms.value) {
      registerError.value = 'Debes aceptar los términos y condiciones';
      return;
    }

    registerError.value = '';
    await register(user);

    // Redirigir a la Landing Page (index.vue)
    router.push('/');
  } catch (error) {
    console.error('Error en el registro', error);
    registerError.value = 'Error al registrar usuario. Por favor, inténtalo de nuevo.';
  }
};

const showLogin = () => {
  router.push('/'); // Redirige al landing page (index.vue)
};
</script>


<template>
  <div class="min-h-screen bg-gradient-to-b from-blue-900 to-blue-800 text-white flex flex-col">
    <!-- Header -->
    <header class="bg-blue-950 shadow-md px-6 py-4">
      <div class="w-full max-w-7xl mx-auto flex justify-between items-center">
        <div>
          <a href="/" class="text-3xl font-bold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">
            Mi Aplicación
          </a>
        </div>
        <nav class="hidden md:flex gap-8">
          <a href="/" class="text-white hover:text-blue-300 transition-colors">Inicio</a>
          <a href="/features" class="text-white hover:text-blue-300 transition-colors">Características</a>
          <a href="/about" class="text-white hover:text-blue-300 transition-colors">Acerca de</a>
          <a href="/contact" class="text-white hover:text-blue-300 transition-colors">Contacto</a>
        </nav>
        <button class="md:hidden text-2xl bg-transparent border-none text-white cursor-pointer">
          <i class="fas fa-bars"></i>
        </button>
      </div>
    </header>

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
          Crear Cuenta
        </h2>
        
        <form @submit.prevent="handleRegister" class="flex flex-col gap-5">
          <div>
            <label for="name" class="block text-blue-300 mb-2">Nombre completo</label>
            <input 
              v-model="user.name"
              type="text" 
              id="name" 
              placeholder="Tu nombre"
              class="w-full px-4 py-3 rounded-full bg-blue-900 border border-blue-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-400"
              required
            >
          </div>
          
          <div>
            <label for="email" class="block text-blue-300 mb-2">Correo electrónico</label>
            <input 
              v-model="user.email"
              type="email" 
              id="email" 
              placeholder="Tu email"
              class="w-full px-4 py-3 rounded-full bg-blue-900 border border-blue-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-400"
              required
            >
          </div>
          
          <div>
            <label for="password" class="block text-blue-300 mb-2">Contraseña</label>
            <input 
              v-model="user.password"
              type="password" 
              id="password" 
              placeholder="Tu contraseña"
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
              placeholder="Confirma tu contraseña"
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
              Acepto los <a href="/terms" class="text-blue-400 hover:text-blue-300">términos y condiciones</a>
            </label>
          </div>
          
          <div v-if="registerError" class="bg-red-900/50 border border-red-500 text-white px-4 py-2 rounded-lg text-sm">
            {{ registerError }}
          </div>
          
          <button 
            type="submit"
            class="w-full bg-purple-600 text-white font-semibold py-3 px-8 rounded-full border-none cursor-pointer transition-all hover:bg-purple-700 hover:scale-105 shadow-md mt-2"
          >
            Crear Cuenta
          </button>
        </form>
        
        <div class="mt-6 relative flex items-center justify-center">
          <div class="absolute top-1/2 left-0 right-0 h-px bg-blue-700"></div>
          <span class="relative px-4 bg-blue-950 text-blue-300">o regístrate con</span>
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
          ¿Ya tienes una cuenta?
          <a @click="showLogin" class="text-blue-400 hover:text-blue-300 transition-colors cursor-pointer font-medium">
            Inicia sesión
          </a>
        </p>
      </div>
    </main>

    <!-- Footer -->
    <footer class="bg-blue-950 py-6 border-t border-blue-800">
      <div class="w-full max-w-7xl mx-auto">
        <div class="text-center text-blue-400 text-sm">
          © {{ new Date().getFullYear() }} Mi Aplicación. Todos los derechos reservados.
        </div>
      </div>
    </footer>
  </div>
</template>