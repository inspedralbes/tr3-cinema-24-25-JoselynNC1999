import { defineStore } from 'pinia';
import { useCookie } from '#app';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    token: useCookie('token'), // Guardamos el token en una cookie
    user: null, // Usuario autenticado
    selectedMovie: null, // Película seleccionada
    selectedSession: null, // Sesión elegida
    selectedSeats: [] // Lista de asientos seleccionados
  }),

  actions: {
    async register(user) {
      try {
        const response = await $fetch('http://127.0.0.1:8000/api/register', {
          method: 'POST',
          body: user
        });
        this.token = response.token;
        this.user = response.user;
      } catch (error) {
        console.error(error);
        throw error;
      }
    },

    async login(credentials) {
      try {
        const response = await $fetch('http://127.0.0.1:8000/api/login', {
          method: 'POST',
          body: credentials
        });
        console.log('Usuario autenticado:', this.user);
        console.log('Token guardado:', this.token);

        this.token = response.token;
        this.user = response.user;
        console.log('Usuario autenticado:', this.user);
      } catch (error) {
        console.error(error);
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
        this.selectedMovie = null;
        this.selectedSession = null;
        this.selectedSeats = [];
      } catch (error) {
        console.error(error);
      }
    },

    // Nueva función para guardar la selección de la película
    selectMovie(movie) {
      this.selectedMovie = movie;
      console.log('Película seleccionada:', this.selectedMovie);
    },

    // Nueva función para guardar la sesión elegida
    selectSession(session) {
      this.selectedSession = session;
      console.log('Sesión seleccionada:', this.selectedSession);
    },

    // Nueva función para guardar los asientos seleccionados
    selectSeats(seats) {
      this.selectedSeats = seats;
      console.log('Asientos seleccionados:', this.selectedSeats);
    }
  }
});
