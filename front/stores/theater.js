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
        const response = await fetch(`/api/movies/${movieId}`);
        if (!response.ok) throw new Error('Error al obtener la película');
        this.currentMovie = await response.json();
      } catch (error) {
        console.error(error);
      }
    },

    async fetchSessionByMovieId(movieId) {
      try {
        const response = await fetch(`/api/sessions?movieId=${movieId}`);
        if (!response.ok) throw new Error('Error al obtener la sesión');
        const sessions = await response.json();
        this.currentSession = sessions[0]; // Supongamos que solo hay una sesión activa
      } catch (error) {
        console.error(error);
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
      await this.fetchMovieById(movieId);
      await this.fetchSessionByMovieId(movieId);
      if (this.currentSession) {
        await this.fetchOccupiedSeats(this.currentSession.id);
      }
    },

    toggleSeat(row, seat) {
      if (this.isSeatOccupied(row, seat)) return;

      const seatIndex = this.selectedSeats.findIndex(s => s.row === row && s.seat === seat);

      if (seatIndex !== -1) {
        this.selectedSeats.splice(seatIndex, 1);
      } else {
        if (this.selectedSeats.length >= 10) {
          alert('No puedes seleccionar más de 10 butacas por sesión');
          return;
        }
        this.selectedSeats.push({ row, seat });
      }
    },

    toggleDiscountDay() {
      this.isDiscountDay = !this.isDiscountDay;
    },

    confirmPurchase() {
      if (this.selectedSeats.length === 0) {
        alert('Debes seleccionar al menos una butaca');
        return;
      }

      const seatCount = this.selectedSeats.length;
      const total = this.totalPrice;

      alert(`Compra confirmada: ${seatCount} butacas por ${total}€`);

      this.occupiedSeats = [...this.occupiedSeats, ...this.selectedSeats];
      this.selectedSeats = [];
    }
  }
});
