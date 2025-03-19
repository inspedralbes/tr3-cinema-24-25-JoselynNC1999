// stores/theater.js
import { defineStore } from 'pinia';

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
        console.log(`Fetching movie with ID: ${movieId}`);
        const response = await fetch(`http://127.0.0.1:8000/api/movies/${movieId}`);
        if (!response.ok) throw new Error('Error al obtener la película');
        const data = await response.json();
        console.log('Movie fetched:', data);
        this.currentMovie = data;
      } catch (error) {
        console.error('Error en fetchMovieById:', error);
      }
    },

    async fetchSessionByMovieId(movieId) {
      try {
        console.log(`Fetching session for movie ID: ${movieId}`);
        const response = await fetch(`http://127.0.0.1:8000/api/sessions?movieId=${movieId}`);
        
        if (!response.ok) throw new Error('Error al obtener la sesión');
        
        const sessions = await response.json();
        console.log('Sessions fetched:', sessions);
        
        // Asigna la primera sesión disponible (o null si no hay sesiones)
        this.currentSession = sessions.length ? sessions[0] : null;
        
        // Si hay sesión, se obtienen los asientos ocupados
        if (this.currentSession) {
          await this.fetchOccupiedSeats(this.currentSession.id);
        }
      } catch (error) {
        console.error('Error en fetchSessionByMovieId:', error);
      }
    },
    

    async fetchOccupiedSeats(sessionId) {
      try {
        console.log(`Fetching occupied seats for session ID: ${sessionId}`);
        const response = await fetch(`/api/seats?sessionId=${sessionId}`);
        if (!response.ok) throw new Error('Error al obtener asientos ocupados');
        const data = await response.json();
        console.log('Occupied seats fetched:', data);
        this.occupiedSeats = data;
      } catch (error) {
        console.error('Error en fetchOccupiedSeats:', error);
      }
    },

    async loadMovieAndSession(movieId) {
      console.log(`Loading movie and session for ID: ${movieId}`);
      await this.fetchMovieById(movieId);
      
      if (this.currentMovie) {
        console.log('Movie successfully set, now fetching session...');
        await this.fetchSessionByMovieId(movieId);
        
        if (this.currentSession) {
          console.log('Session successfully set, now fetching occupied seats...');
          await this.fetchOccupiedSeats(this.currentSession.id);
        } else {
          console.warn('No session found for this movie.');
        }
      } else {
        console.warn('No movie found with this ID.');
      }
    },

    toggleSeat(row, seat) {
      if (this.isSeatOccupied(row, seat)) {
        console.warn(`Seat ${row}${seat} is already occupied!`);
        return;
      }

      const seatIndex = this.selectedSeats.findIndex(s => s.row === row && s.seat === seat);

      if (seatIndex !== -1) {
        console.log(`Deselecting seat: ${row}${seat}`);
        this.selectedSeats.splice(seatIndex, 1);
      } else {
        if (this.selectedSeats.length >= 10) {
          alert('No puedes seleccionar más de 10 butacas por sesión');
          return;
        }
        console.log(`Selecting seat: ${row}${seat}`);
        this.selectedSeats.push({ row, seat });
      }
    },

    toggleDiscountDay() {
      this.isDiscountDay = !this.isDiscountDay;
      console.log(`Discount day toggled: ${this.isDiscountDay}`);
    },

    confirmPurchase() {
      if (this.selectedSeats.length === 0) {
        alert('Debes seleccionar al menos una butaca');
        return;
      }

      const seatCount = this.selectedSeats.length;
      const total = this.totalPrice;

      console.log(`Confirming purchase: ${seatCount} seats, total price: ${total}€`);
      alert(`Compra confirmada: ${seatCount} butacas por ${total}€`);

      this.occupiedSeats = [...this.occupiedSeats, ...this.selectedSeats];
      this.selectedSeats = [];
    }
  }
});
