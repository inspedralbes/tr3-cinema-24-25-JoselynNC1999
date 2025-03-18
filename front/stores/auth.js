import { defineStore } from 'pinia';
import { useCookie } from '#app';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    token: useCookie('token'),
    user: null
  }),

  actions: {
    async login(credentials) {
      try {
        const response = await $fetch('http://127.0.0.1:8000/api/login', {
          method: 'POST',
          body: credentials
        });

        console.log('Respuesta del backend:', response);

        this.token = response.token;
        this.user = response.user;

        console.log('Usuario guardado en Pinia:', this.user);
      } catch (error) {
        console.error('Error en el login:', error);
        throw error;
      }
    },

    async logout() {
      try {
        await $fetch('http://127.0.0.1:8000/api/logout', {
          method: 'POST',
          headers: { Authorization: `Bearer ${this.token}` }
        });

        this.token = null;
        this.user = null;
      } catch (error) {
        console.error(error);
      }
    }
  }
});
