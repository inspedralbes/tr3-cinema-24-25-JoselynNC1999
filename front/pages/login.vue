<script setup>
import { ref, reactive, watch } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from '@/stores/auth'; // Importamos la store de autenticación

const authStore = useAuthStore();
const router = useRouter();

const credentials = reactive({
  email: '',
  password: ''
});
const rememberMe = ref(false);
const loginError = ref('');

// Escuchar cambios en el usuario logueado y mostrarlo en consola
watch(() => authStore.user, (newUser) => {
  if (newUser) {
    console.log('Usuario logueado:', newUser);
  }
});

const handleLogin = async () => {
  try {
    loginError.value = '';
    await authStore.login(credentials); // Llamar al método de autenticación de Pinia

    console.log('Usuario autenticado:', authStore.user); // Ver usuario en consola

    // Redirigir al landing page (index.vue)
    router.push('/');
  } catch (error) {
    console.error('Error en el login', error);
    loginError.value = 'Error al iniciar sesión. Verifica tus credenciales.';
  }
};

const showRegister = () => {
  router.push('/register'); // Redirige a la página de registro
};
</script>

<template>
  <div class="min-h-screen bg-gradient-to-b from-blue-900 to-blue-800 text-white flex flex-col">
    <!-- Header -->
    <header class="bg-blue-950 shadow-md px-6 py-4">
      <div class="w-full max-w-7xl mx-auto flex justify-between items-center">
        <a href="/" class="text-3xl font-bold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">
          Mi Aplicación
        </a>
        <nav class="hidden md:flex gap-8">
          <a href="/" class="text-white hover:text-blue-300 transition-colors">Inicio</a>
          <a href="/features" class="text-white hover:text-blue-300 transition-colors">Características</a>
          <a href="/about" class="text-white hover:text-blue-300 transition-colors">Acerca de</a>
          <a href="/contact" class="text-white hover:text-blue-300 transition-colors">Contacto</a>
        </nav>
      </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center p-6 md:p-12 relative">
      <div class="bg-blue-950/80 p-8 rounded-2xl shadow-2xl backdrop-blur-sm w-full max-w-md">
        <h2 class="text-3xl font-bold mb-6 text-center bg-gradient-to-r from-blue-400 to-purple-500 bg-clip-text text-transparent">
          Iniciar Sesión
        </h2>

        <form @submit.prevent="handleLogin" class="flex flex-col gap-6">
          <div>
            <label for="email" class="block text-blue-300 mb-2">Correo electrónico</label>
            <input 
              v-model="credentials.email"
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
              v-model="credentials.password"
              type="password" 
              id="password" 
              placeholder="Tu contraseña"
              class="w-full px-4 py-3 rounded-full bg-blue-900 border border-blue-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-400"
              required
            >
          </div>
          
          <div class="flex justify-between items-center">
            <div class="flex items-center">
              <input v-model="rememberMe" type="checkbox" id="remember" class="mr-2">
              <label for="remember" class="text-blue-300">Recuérdame</label>
            </div>
            <a href="/recuperar-password" class="text-blue-400 hover:text-blue-300 transition-colors">
              ¿Olvidaste tu contraseña?
            </a>
          </div>

          <div v-if="loginError" class="bg-red-900/50 border border-red-500 text-white px-4 py-2 rounded-lg text-sm">
            {{ loginError }}
          </div>

          <button 
            type="submit"
            class="w-full bg-blue-600 text-white font-semibold py-3 px-8 rounded-full transition-all hover:bg-blue-700 hover:scale-105 shadow-md"
          >
            Iniciar Sesión
          </button>
        </form>

        <p class="mt-8 text-center text-blue-300">
          ¿No tienes una cuenta?
          <a @click="showRegister" class="text-blue-400 hover:text-blue-300 transition-colors cursor-pointer font-medium">
            Regístrate ahora
          </a>
        </p>
      </div>
    </main>

    <!-- Footer -->
    <footer class="bg-blue-950 py-6 border-t border-blue-800 text-center text-blue-400 text-sm">
      © {{ new Date().getFullYear() }} Mi Aplicación. Todos los derechos reservados.
    </footer>
  </div>
</template>
