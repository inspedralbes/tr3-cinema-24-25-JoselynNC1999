import { defineStore } from 'pinia';
import { useAuthStore } from './auth'; 
import { useRuntimeConfig } from '#app'

// Define base API URL directly
const config = useRuntimeConfig()
const API_URL = config.public.apiBase.replace(/\/$/, '');

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

    currentMovie: null,
    currentSession: null,
    occupiedSeats: [],
    selectedSeats: [],
    allSeats: []
  }),

  getters: {
    getPricePerSeat: (state) => (row) => {
      if (!row) return 0;
      const isVip = row === state.vipRow;
      return isVip
        ? (state.isDiscountDay ? state.prices.discountVip : state.prices.vip)
        : (state.isDiscountDay ? state.prices.discountNormal : state.prices.normal);
    },

    totalPrice(state) {
      return state.selectedSeats.reduce((total, seat) => {
        return total + state.getPricePerSeat(seat.row);
      }, 0);
    },

    isSeatOccupied: (state) => (row, seat) => {
      return state.occupiedSeats.some(s => s.row === row && (s.seat == seat || s.number == seat));
    },

    isSeatSelected: (state) => (row, seat) => {
      return state.selectedSeats.some(s => s.row === row && s.seat === seat);
    },

    isVipSeat: (state) => (row) => row === state.vipRow,

    getSeatClass: (state) => (row, seat) => {
      if (state.isSeatOccupied(row, seat)) return 'bg-red-500 cursor-not-allowed';
      if (state.isSeatSelected(row, seat)) return 'bg-green-500';
      if (state.isVipSeat(row)) return 'bg-purple-500';
      return 'bg-gray-500';
    },
  },

  actions: {
    async fetchSeats(sessionId) {
      try {
        const url = new URL(`${API_URL.replace(/\/$/, '')}/sessions/${sessionId}/seats`);
        const response = await $fetch(url.toString(), {
          method: 'GET',
          headers: {
            Accept: 'application/json',
          },
          redirect: 'follow'
        });
        if (response.length <= 0) throw new Error('Error al obtener los asientos');
    
        let seats = response
        console.log('Seats response:', seats);
    
        if (!Array.isArray(seats)) seats = [seats];
    
        this.allSeats = seats;
        
        await this.fetchOccupiedSeats(sessionId);
        
      } catch (error) {
        console.error('Error en fetchSeats:', error);
      }
    },
    
    async fetchMovieById(movieId) {
      try {
        console.log(`Fetching movie with ID: ${movieId}`);
        const url = new URL(`${API_URL.replace(/\/$/, '')}/movies/${movieId}`);
        const response = await $fetch(url.toString(), {
          method: 'GET',
          headers: {
            Accept: 'application/json',
          },
          redirect: 'follow'
        });
        if (response.length <= 0) throw new Error('Error al obtener la película');
        const data = response;
        console.log('Movie fetched:', data);
        this.currentMovie = data;
      } catch (error) {
        console.error('Error en fetchMovieById:', error);
      }
    },

    async fetchSessionByMovieId(movieId) {
      try {
        console.log(`Fetching session for movie ID: ${movieId}`);
        const url = new URL(`${API_URL.replace(/\/$/, '')}/sessions?movieId=${movieId}`);
        const response = await $fetch(url.toString(), {
          method: 'GET',
          headers: {
            Accept: 'application/json',
          },
          redirect: 'follow'
        });
        
        if (response.length <= 0) throw new Error('Error al obtener la sesión');
        
        const sessions = response;
        console.log('Sessions fetched:', sessions);
        
        this.currentSession = sessions.length ? sessions[0] : null;
        
        if (this.currentSession) {
          await this.fetchOccupiedSeats(this.currentSession.id);
        }
      } catch (error) {
        console.error('Error en fetchSessionByMovieId:', error);
      }
    },

    async fetchMovieDetails(movieId) {
      try {
        console.log(`Fetching movie details for movie ID: ${movieId}`);
        const url = new URL(`${API_URL.replace(/\/$/, '')}/movies/${movieId}`);
        const response = await $fetch(url.toString(), {
          method: 'GET',
          headers: {
            Accept: 'application/json',
          },
          redirect: 'follow'
        });
        
        if (response.length <= 0) throw new Error('Error al obtener la película');
        
        const movie = response;
        console.log('Movie details fetched:', movie);
        
        this.movieDetails = movie;
      } catch (error) {
        console.error('Error en fetchMovieDetails:', error);
      }
    },
    
    async fetchOccupiedSeats(sessionId) {
      try {
        const url = new URL(`${API_URL.replace(/\/$/, '')}/sessions/${sessionId}/occupied-seats`);
        const response = await $fetch(url.toString(), {
          method: 'GET',
          headers: {
            Accept: 'application/json',
          },
          redirect: 'follow'
        });
        if (response.length <= 0) throw new Error("Error al obtener asientos ocupados");
    
        let seats = response;
        console.log("Occupied seats response:", seats);
    
        if (!Array.isArray(seats)) seats = [seats];
    
        this.occupiedSeats = seats.map(seat => ({
          id: seat.id,
          row: seat.row,
          seat: seat.number, 
          status: seat.status
        }));
    
        console.log("Asientos ocupados actualizados:", this.occupiedSeats);
      } catch (error) {
        console.error("Error en fetchOccupiedSeats:", error);
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

    async reserveSeats() {
      if (!this.selectedSeats.length) {
        alert("Debes seleccionar al menos una butaca");
        return;
      }
    
      const authStore = useAuthStore();
      if (!authStore.user) {
        alert("Debes iniciar sesión para reservar");
        return;
      }
    
      try {
        const seatIds = this.selectedSeats.map(seat => seat.id).filter(id => id);
        if (seatIds.length === 0) {
          alert("Error: No se encontraron IDs válidos para reservar.");
          return;
        }
    
        console.log("Reservando asientos con IDs:", seatIds);
    
        const url = new URL(`${API_URL.replace(/\/$/, '')}/reserve-seats`);
        const response = await $fetch(url.toString(), {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({
            user_id: authStore.user.id,
            session_id: this.currentSession.id,
            seat_ids: seatIds,
          }),
          redirect: "follow"
        });
    
        const data = response;
        if (response.length <= 0) throw new Error(data.message || "Error al reservar butacas");
        setTimeout(() => {
          this.selectedSeats = [];
          this.fetchSeats(this.currentSession.id);
        }, 120000); 
      } catch (error) {
        console.error("Error al reservar butacas:", error);
      }
    },
    
    toggleSeat(row, seat) {
      console.log(`Clic en asiento: ${row}${seat}`);
    
      if (this.isSeatOccupied(row, seat)) {
        console.warn(`El asiento ${row}${seat} ya está ocupado!`);
        return;
      }
      const seatIndex = this.selectedSeats.findIndex(s => s.row === row && (s.seat == seat || s.number == seat));

      if (seatIndex !== -1) {
        console.log(`Deselecting seat: ${row}${seat}`);
        this.selectedSeats.splice(seatIndex, 1);
      } else {
        if (this.selectedSeats.length >= 10) {
          this.showPopup("No pots seleccionar més de 10 butaques per sessió");
          return;
        }
        
        const seatId = this.getAvailableSeatId(row, seat);
        
        console.log(`Selecting seat: ${row}${seat} with ID: ${seatId}`);
        this.selectedSeats.push({ id: seatId, row, seat, number: seat });
      }
    },
    
    showPopup(message) {
      let popup = document.createElement("div");
      popup.innerText = message;
      popup.style.position = "fixed";
      popup.style.top = "50%";
      popup.style.left = "50%";
      popup.style.transform = "translate(-50%, -50%)";
      popup.style.background = "rgba(0,0,0,0.8)";
      popup.style.color = "white";
      popup.style.padding = "15px";
      popup.style.borderRadius = "5px";
      popup.style.zIndex = "1000";
      
      document.body.appendChild(popup);

      setTimeout(() => {
        popup.remove();
      }, 3000);
    },
        
    getAvailableSeatId(row, seat) {
      const availableSeat = this.allSeats?.find(s => 
        s.row === row && (s.number == seat || s.seat == seat)
      );
      
      if (availableSeat) {
        console.log(`Found seat ID ${availableSeat.id} for ${row}${seat}`);
      } else {
        console.warn(`No se encontró ID para el asiento ${row}${seat}`);
      }
      
      return availableSeat?.id || null;
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
