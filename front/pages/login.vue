<script setup>
import { ref, reactive, watch } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from '@/stores/auth'; // Importamos la store de autenticación
import { toRaw } from 'vue'; // Asegúrate de importar toRaw
import TheFooter from '@/components/layout/TheFooter.vue';
import TheHeader from '@/components/layout/TheHeader.vue';

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
    console.log('🟢 Usuario logueado (watch en Login.vue):', JSON.parse(JSON.stringify(newUser)));
  }
}, { immediate: true }); // Esto hará que el watch se ejecute de inmediato si ya hay un usuario

const handleLogin = async () => {
  try {
    loginError.value = '';
    await authStore.login(credentials);

    // Esperar a que Pinia actualice `authStore.user`
    await new Promise((resolve) => setTimeout(resolve, 100));

    // Desenlazar el Proxy para trabajar con el objeto real
    const rawUser = toRaw(authStore.user);

    console.log('✅ Usuario autenticado:', rawUser);

    // Verificar el rol del usuario (usando rawUser en lugar de authStore.user)
    if (rawUser && rawUser.is_admin === 1) {
      console.log('🔑 Usuario Admin detectado');
      router.push('/admin');
      return;
    }

    if (authStore.selectedMovie) {
      const movieId = authStore.selectedMovie.id;
      authStore.selectedMovie = null;
      router.push(`/movies/${movieId}`);
    } else {
      router.push('/');
    }
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
    <TheHeader />


    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center p-6 md:p-12 relative">
      <div class="bg-blue-950/80 p-8 rounded-2xl shadow-2xl backdrop-blur-sm w-full max-w-md">
        <h2 class="text-3xl font-bold mb-6 text-center bg-gradient-to-r from-blue-400 to-purple-500 bg-clip-text text-transparent">
          Iniciar Sessió
        </h2>

        <form @submit.prevent="handleLogin" class="flex flex-col gap-6">
          <div>
            <label for="email" class="block text-blue-300 mb-2">Correu electrònic</label>
            <input 
              v-model="credentials.email"
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
              v-model="credentials.password"
              type="password" 
              id="password" 
              placeholder="La teva contrasenya"
              class="w-full px-4 py-3 rounded-full bg-blue-900 border border-blue-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-400"
              required
            >
          </div>
          
          <div class="flex justify-between items-center">
            <div class="flex items-center">
              <input v-model="rememberMe" type="checkbox" id="remember" class="mr-2">
              <label for="remember" class="text-blue-300">Recorda'm</label>
            </div>
            <a href="/recuperar-password" class="text-blue-400 hover:text-blue-300 transition-colors">
              Has oblidat la contrasenya?
            </a>
          </div>

          <div v-if="loginError" class="bg-red-900/50 border border-red-500 text-white px-4 py-2 rounded-lg text-sm">
            {{ loginError }}
          </div>

          <button 
            type="submit"
            class="w-full bg-blue-600 text-white font-semibold py-3 px-8 rounded-full transition-all hover:bg-blue-700 hover:scale-105 shadow-md"
          >
            Iniciar Sessió
          </button>
        </form>

        <p class="mt-8 text-center text-blue-300">
          No tens un compte?
          <a @click="showRegister" class="text-blue-400 hover:text-blue-300 transition-colors cursor-pointer font-medium">
            Registra't ara
          </a>
        </p>
      </div>
    </main>

    <TheFooter />
  </div>
</template>
