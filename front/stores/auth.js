import { defineStore } from 'pinia';
import { useCookie } from '#app';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    token: useCookie('token'),
    user: null,
    selectedMovie: null,
    selectedSession: null,
    selectedSeats: []
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

        this.token = response.token;
        this.user = response.user;
        console.log("Token guardado:", this.token);
        console.log("Usuario autenticado:", JSON.parse(JSON.stringify(this.user)));
        // 🔥 Recuperar la película, sesión y asientos si ya fueron seleccionados antes de hacer login
    const theaterStore = useTheaterStore();
    if (theaterStore.selectedMovie) this.selectedMovie = theaterStore.selectedMovie;
    if (theaterStore.selectedSession) this.selectedSession = theaterStore.selectedSession;
    if (theaterStore.selectedSeats.length > 0) this.selectedSeats = [...theaterStore.selectedSeats];

      } catch (error) {
        console.error("Error en el login", error);
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

    selectMovie(movie) {
      this.selectedMovie = movie;
      const theaterStore = useTheaterStore();
      theaterStore.currentMovie = movie; // Sincronizar con theaterStore
    },

    selectSession(session) {
      this.selectedSession = session;
      const theaterStore = useTheaterStore();
      theaterStore.currentSession = session; // Sincronizar con theaterStore
    },
    
    selectSeats(seats) {
      this.selectedSeats = seats;
      const theaterStore = useTheaterStore();
      theaterStore.selectedSeats = seats; // Sincronizar con theaterStore
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
        const response = await $fetch('http://127.0.0.1:8000/api/purchase', {
          method: 'POST',
          headers: { Authorization: `Bearer ${this.token}` },
          body: {
            user_id: this.user.id,
            movie_id: this.selectedMovie.id,
            session_id: this.selectedSession.id,
            seats: this.selectedSeats
          }
        });

        alert('Compra realizada con éxito');
        this.selectedMovie = null;
        this.selectedSession = null;
        this.selectedSeats = [];
      } catch (error) {
        console.error('Error en la compra', error);
        alert('Hubo un problema con la compra.');
      }
    }
  }
});
