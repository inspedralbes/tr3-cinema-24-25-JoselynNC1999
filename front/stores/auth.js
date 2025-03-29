import { defineStore } from 'pinia';
import { useTheaterStore } from './theater';
import { useRuntimeConfig } from 'vue';

// Define base API URL directly
const config = useRuntimeConfig()
const API_URL = config.public.apiBase.replace(/\/$/, ''); // URL base de la API

export const useAuthStore = defineStore('auth', {
  state: () => ({
    token: process.client ? localStorage.getItem('token') || null : null,
    user: process.client ? JSON.parse(localStorage.getItem('user')) || null : null,
    selectedMovie: null,
    selectedSession: null,
    selectedSeats: [],
  }),

  getters: {
    isAuthenticated: (state) => !!state.token,
  },

  actions: {
    // Registro de usuario
    async register(user) {
      try {
        const response = await $fetch(`${API_URL}/register`.replace(/\/\//g, '/'), {
          method: 'POST',
          body: user,
          redirect: 'follow',
        });

        this.token = response.token;
        this.user = response.user;

        if (process.client) {
          localStorage.setItem('token', response.token);
          localStorage.setItem('user', JSON.stringify(JSON.parse(JSON.stringify(response.user))));
        }

        console.log('✅ Registro exitoso:', this.user);
        console.log('🔑 Token guardado:', this.token);

      } catch (error) {
        console.error('❌ Error en el registro:', error);
        throw error;
      }
    },

    // Login de usuario
    async login(credentials) {
      try {
        const response = await $fetch(`${API_URL}/login`.replace(/\/\//g, '/'), {
          method: 'POST',
          body: credentials,
          redirect: 'follow',
        });

        this.token = response.token;
        this.user = response.user;

        if (process.client) {
          localStorage.setItem('token', response.token);
          localStorage.setItem('user', JSON.stringify(JSON.parse(JSON.stringify(response.user))));
        }

        // Convertir la cadena JSON de 'user' en un objeto JavaScript
        const user = JSON.parse(localStorage.getItem('user'));

        console.log(user);
        console.log(user.name);

        console.log('✅ Usuario autenticado:', this.user);
        console.log('🔑 Token guardado:', this.token);

        const theaterStore = useTheaterStore();
        if (theaterStore.selectedMovie) this.selectedMovie = theaterStore.selectedMovie;
        if (theaterStore.selectedSession) this.selectedSession = theaterStore.selectedSession;
        if (theaterStore.selectedSeats.length > 0) this.selectedSeats = [...theaterStore.selectedSeats];

      } catch (error) {
        console.error('❌ Error en el login:', error);
        throw error;
      }
    },

    // Logout de usuario
    async logout() {
      try {
        await $fetch(`${API_URL}/logout`.replace(/\/\//g, '/'), {
          method: 'POST',
          headers: { Authorization: `Bearer ${this.token}` },
          redirect: 'follow',
        });

        this.token = null;
        this.user = null;
        this.selectedMovie = null;
        this.selectedSession = null;
        this.selectedSeats = [];

        if (process.client) {
          localStorage.setItem('token', null);
          localStorage.setItem('user', null);
        }

        console.log('🔴 Usuario desconectado. Token eliminado.');

      } catch (error) {
        console.error('❌ Error en el logout:', error);
      }
    },

    async sendTicketEmail(reservationData) {
      try {
        // Ensure user is authenticated
        if (!this.isAuthenticated) {
          throw new Error('Usuario no autenticado');
        }

        // Add user's email to reservation data if not already present
        if (!reservationData.email && this.user?.email) {
          reservationData.email = this.user.email;
        }

        const response = await $fetch(`${API_URL}/send-ticket-email`.replace(/\/\//g, '/'), {
          method: 'POST',
          headers: { 
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${this.token}`
          },
          body: reservationData,
          redirect: 'follow',
        });

        // Return the response from the server
        return response;

      } catch (error) {
        console.error('❌ Error enviando correo de entradas:', error);
        throw error;
      }
    },
    selectMovie(movie) {
      console.log('Película seleccionada:', movie);
      this.selectedMovie = movie;  // Solo modificar el valor en el store de auth
      console.log('Película guardada en selectedMovie:', this.selectedMovie);  // Verificar que la película se guardó correctamente

      // Sincronizar la película seleccionada con el store de theater
      const theaterStore = useTheaterStore();
      theaterStore.currentMovie = movie;  // Asegúrate de sincronizarlo con el store de theater
    },

    selectSession(session) {
      this.selectedSession = session;
      const theaterStore = useTheaterStore();
      theaterStore.currentSession = session;  // Sincronizar con theaterStore
    },

    selectSeats(seats) {
      this.selectedSeats = seats;
      const theaterStore = useTheaterStore();
      theaterStore.selectedSeats = seats;  // Sincronizar con theaterStore
    },
    async fetchUsers() {
      try {
        const response = await $fetch(`${API_URL}/users`.replace(/\/\//g, '/'), {
          method: 'GET',
          headers: {
            'Authorization': `Bearer ${this.token}`,
            'Content-Type': 'application/json'
          },
          redirect: 'follow'
        });
    
        if (response) {
          console.log('Usuarios cargados:', response);
          return response.map(user => ({
            id: user.id,
            name: user.name,
            email: user.email,
            status: 'Actiu',
            statusClass: 'status-active'
          }));
        }
      } catch (error) {
        console.error('Error al obtener usuarios:', error);
        return [];
      }
    },

    async purchaseTickets() {
      if (!this.user) {
        alert('Debes iniciar sesión para comprar entradas.');
        return;
      }

      if (!this.selectedMovie || !this.selectedSession || this.selectedSeats.length === 0) {
        alert('Selecciona una película, una sesión y al menos un asiento.');
        return;
      }

    
      try {
        const response = await $fetch(`${API_URL}/purchase`.replace(/\/\//g, '/'), {
          method: 'POST',
          headers: { Authorization: `Bearer ${this.token}` },
          body: {
            user_id: this.user.id,
            movie_id: this.selectedMovie.id,
            session_id: this.selectedSession.id,
            seats: this.selectedSeats,
          },
          redirect: 'follow'
        });

        alert('Compra realizada con éxito');
        this.selectedMovie = null;
        this.selectedSession = null;
        this.selectedSeats = [];
      } catch (error) {
        console.error('Error en la compra', error);
        alert('Hubo un problema con la compra.');
      }
    },
  },
});