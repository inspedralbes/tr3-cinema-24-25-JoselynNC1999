import { defineStore } from 'pinia';
import { useCookie } from '#app';
import { useTheaterStore } from './theater';  // Asegúrate de importar el store de theater


export const useAuthStore = defineStore('auth', {
  state: () => ({
    token: useCookie('token'), // Guardar el token en la cookie
    user: null,
    selectedMovie: null,
    selectedSession: null,
    selectedSeats: [],
  }),

  getters: {
    // Verificar si el usuario está autenticado comprobando la existencia del token
    isAuthenticated: (state) => !!state.token,
  },

  actions: {
    // Registro de usuario
    async register(user) {
      try {
        const response = await $fetch('http://127.0.0.1:8000/api/register', {
          method: 'POST',
          body: user,
        });
        this.token = response.token;
        this.user = response.user;
      } catch (error) {
        console.error(error);
        throw error;
      }
    },

    // Login de usuario
    async login(credentials) {
      try {
        const response = await $fetch('http://127.0.0.1:8000/api/login', {
          method: 'POST',
          body: credentials,
        });

        this.token = response.token;
        this.user = response.user;
        console.log("Token guardado:", this.token);
        console.log("Usuario autenticado:", JSON.parse(JSON.stringify(this.user)));

        // Sincronizar con theaterStore los valores anteriores de la película, sesión y asientos
        const theaterStore = useTheaterStore();
        if (theaterStore.selectedMovie) this.selectedMovie = theaterStore.selectedMovie;
        if (theaterStore.selectedSession) this.selectedSession = theaterStore.selectedSession;
        if (theaterStore.selectedSeats.length > 0) this.selectedSeats = [...theaterStore.selectedSeats];

      } catch (error) {
        console.error("Error en el login", error);
        throw error;
      }
    },

    // Logout de usuario
    async logout() {
      try {
        await $fetch('http://127.0.0.1:8000/api/logout', {
          method: 'POST',
          headers: { Authorization: `Bearer ${this.token}` },
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

    // Selección de película
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


    // Realizar compra de entradas
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
            seats: this.selectedSeats,
          },
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
