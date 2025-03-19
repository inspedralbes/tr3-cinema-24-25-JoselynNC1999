import { defineStore } from 'pinia';
import { useAuthStore } from './auth';
import { useRouter } from 'vue-router';

export const useTheaterStore = defineStore('theater', {
  state: () => ({
    rowLetters: ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L'],
    seatsPerRow: 10,
    vipRow: 'F',

    prices: {
      normal: 6,
      vip: 8,
      discountNormal: 4,
      discountVip: 6
    },

    isDiscountDay: false,

    currentMovie: null, // Se cargará dinámicamente
    currentSession: null, // Se cargará dinámicamente
    occupiedSeats: [], // Se cargará dinámicamente
    selectedSeats: []
  }),

  getters: {
    getPricePerSeat: (state) => (row) => {
      const isVip = row === state.vipRow;
      return isVip
        ? (state.isDiscountDay ? state.prices.discountVip : state.prices.vip)
        : (state.isDiscountDay ? state.prices.discountNormal : state.prices.normal);
    },

    totalPrice: (state) => {
      return state.selectedSeats.reduce((total, seat) => {
        return total + state.getPricePerSeat(seat.row);
      }, 0);
    },

    isSeatOccupied: (state) => (row, seat) => {
      return state.occupiedSeats.some(s => s.row === row && s.seat === seat);
    },

    isSeatSelected: (state) => (row, seat) => {
      return state.selectedSeats.some(s => s.row === row && s.seat === seat);
    },

    isVipSeat: (state) => (row) => row === state.vipRow,

    getSeatClass: (state) => (row, seat) => {
      if (state.isSeatOccupied(row, seat)) return 'bg-red-500'; // Ocupada (Rojo)
      if (state.isSeatSelected(row, seat)) return 'bg-green-500'; // Seleccionada (Verde)
      if (state.isVipSeat(row)) return 'bg-purple-500'; // VIP (Morado)
      return 'bg-gray-500'; // Disponible (Gris)
    }
  },

  actions: {
    async fetchMovieById(movieId) {
      try {
        const response = await fetch(`/api/movies/${movieId}`);
        if (!response.ok) throw new Error('Error al obtener la película');
        this.currentMovie = await response.json();
        console.log("Película cargada:", this.currentMovie);
      } catch (error) {
        console.error("Error al cargar la película:", error);
      }
    },

    async fetchSessionByMovieId(movieId) {
      try {
        const response = await fetch(`/api/sessions?movieId=${movieId}`);
        if (!response.ok) throw new Error('Error al obtener la sesión');
        const sessions = await response.json();
        this.currentSession = sessions[0]; // Supongamos que solo hay una sesión activa
        console.log("Sesión cargada:", this.currentSession);
      } catch (error) {
        console.error("Error al cargar la sesión:", error);
      }
    },

    async fetchOccupiedSeats(sessionId) {
      try {
        const response = await fetch(`/api/seats?sessionId=${sessionId}`);
        if (!response.ok) throw new Error('Error al obtener asientos ocupados');
        this.occupiedSeats = await response.json();
      } catch (error) {
        console.error(error);
      }
    },

    async loadMovieAndSession(movieId) {
      console.log("Cargando película y sesión para el ID:", movieId);
    
      await this.fetchMovieById(movieId);
      console.log("Película cargada:", this.currentMovie);
    
      await this.fetchSessionByMovieId(movieId);
      console.log("Sesión cargada:", this.currentSession);
    
      if (this.currentSession) {
        await this.fetchOccupiedSeats(this.currentSession.id);
      }
    },
    

    toggleSeat(row, seat) {
      const authStore = useAuthStore();
      
      if (!authStore.user) {
        alert("Debes iniciar sesión para seleccionar asientos.");
        return;
      }
    
      if (this.isSeatOccupied(row, seat)) return;
    
      const seatIndex = this.selectedSeats.findIndex(s => s.row === row && s.seat === seat);
      if (seatIndex !== -1) {
        this.selectedSeats.splice(seatIndex, 1);
      } else {
        if (this.selectedSeats.length >= 10) {
          alert('No puedes seleccionar más de 10 butacas.');
          return;
        }
        this.selectedSeats.push({ row, seat });
      }
      console.log("Asientos seleccionados ahora:", this.selectedSeats);
    },
    
    toggleDiscountDay() {
      this.isDiscountDay = !this.isDiscountDay;
    },

    async confirmPurchase() {
      const authStore = useAuthStore();
      
      // Verifica si hay una película, sesión y asientos seleccionados
      console.log('Película en theaterStore:', theaterStore.selectedMovie);
      console.log('Sesión en theaterStore:', theaterStore.selectedSession);
console.log('Asientos en theaterStore:', theaterStore.selectedSeats);

    
      if (!this.currentMovie || !this.currentSession || this.selectedSeats.length === 0) {
        alert("Selecciona una película, una sesión y al menos un asiento.");
        return;
      }
    
      // Calculamos el precio total
      const total = this.totalPrice;
      console.log("Total calculado:", total);
    
      // Realiza la reserva
      try {
        const reservationData = {
          user_id: authStore.user.id,
          movie_id: this.currentMovie.id,
          session_id: this.currentSession.id,
          seats: this.selectedSeats.map(seat => ({ row: seat.row, seat: seat.seat })),
          total_price: total,
        };
    
        console.log("Datos enviados para la reserva:", reservationData);
    
        const response = await fetch('http://127.0.0.1:8000/api/reservations', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            Accept: 'application/json',
            Authorization: `Bearer ${authStore.token}`,
          },
          body: JSON.stringify(reservationData),
        });
    
        if (!response.ok) throw new Error('Error al realizar la reserva');
    
        // Limpiar los asientos seleccionados
        this.selectedSeats = [];
        
        // Actualizar los asientos ocupados
        const data = await response.json();
        console.log("Respuesta del backend:", data);
        
        this.occupiedSeats = [...this.occupiedSeats, ...this.selectedSeats];
    
        alert(`Compra confirmada: ${this.selectedSeats.length} butacas por ${total}€`);
    
        // Redirige a una página de confirmación
        this.router.push('/confirmation');  // Asegúrate de tener una ruta '/confirmation' configurada
      } catch (error) {
        console.error("Error al confirmar la compra:", error);
        alert('No se pudo completar la reserva');
      }
    }
  }
});
