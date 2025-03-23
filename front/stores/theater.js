// stores/theater.js
import { defineStore } from 'pinia';
import { useAuthStore } from './auth'; 

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
    selectedSeats: [],
    allSeats: []
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

    async fetchSeats(sessionId) {
      try {
        const response = await fetch(`http://127.0.0.1:8000/api/sessions/${sessionId}/seats`);  
        if (!response.ok) throw new Error('Error al obtener los asientos');
    
        let seats = await response.json();
        console.log('Seats response:', seats);
    
        // Convertir a array si el backend devolvió un solo objeto
        if (!Array.isArray(seats)) {
          console.warn('El backend devolvió un objeto en lugar de un array:', seats);
          seats = [seats];
        }
    
        // Guardar todos los asientos para poder obtener los IDs
        this.allSeats = seats;
        
        // Filtrar los ocupados
        this.occupiedSeats = seats.filter(seat => seat.status === true);
      } catch (error) {
        console.error('Error en fetchSeats:', error);
      }
    },
  
    
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

    async fetchMovieDetails(movieId) {
      try {
        console.log(`Fetching movie details for movie ID: ${movieId}`);
        const response = await fetch(`http://127.0.0.1:8000/api/movies/${movieId}`);
        
        if (!response.ok) throw new Error('Error al obtener la película');
        
        const movie = await response.json();
        console.log('Movie details fetched:', movie);
        
        this.movieDetails = movie; // Guarda los detalles de la película en una propiedad de tu estado
      } catch (error) {
        console.error('Error en fetchMovieDetails:', error);
      }
    },
    
    

    async fetchOccupiedSeats(sessionId) {
      try {
        const response = await fetch(`http://127.0.0.1:8000/api/sessions/${sessionId}/occupied-seats`);
        if (!response.ok) throw new Error("Error al obtener asientos ocupados");
    
        let seats = await response.json();
        console.log("Seats response:", seats);
    
        // 🔥 Asegurar que `seats` siempre sea un array
        if (!Array.isArray(seats)) {
          console.warn("El backend devolvió un objeto en lugar de un array:", seats);
          seats = [seats]; // Convertimos el objeto en un array
        }
    
        // 🔥 Convertimos `seats` al formato correcto
        this.occupiedSeats = seats.map(seat => ({
          id: seat.id,
          row: seat.row,
          seat: seat.number, // Usar `number`, no `seat`
          status: seat.status
        }));
    
        console.log("Asientos ocupados cargados correctamente:", this.occupiedSeats);
      } catch (error) {
        console.error("Error en fetchOccupiedSeats:", error);
        this.occupiedSeats = []; // Para evitar que sea undefined
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
        // Filtrar los asientos que tengan ID
        const seatIds = this.selectedSeats.map(seat => seat.id).filter(id => id);
    
        // Verificar que haya IDs para reservar
        if (seatIds.length === 0) {
          console.error("No se encontraron IDs para los asientos seleccionados:", this.selectedSeats);
          alert("Error: No se encontraron IDs válidos para reservar. Por favor, actualiza la página e intenta de nuevo.");
          return;
        }
    
        console.log("Reservando asientos con IDs:", seatIds);
    
        const response = await fetch("http://127.0.0.1:8000/api/reserve-seats", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({
            user_id: authStore.user.id,
            session_id: this.currentSession.id,
            seat_ids: seatIds,
          }),
        });
    
        const data = await response.json();
        console.log("Reserva response:", data);
    
        if (!response.ok) throw new Error(data.message || "Error al reservar butacas");
    
        //alert("Reserva exitosa");
        this.selectedSeats = [];
        await this.fetchSeats(this.currentSession.id);
        
      } catch (error) {
        console.error("Error al reservar butacas:", error);
        //alert(`Error al reservar: ${error.message}`);
      }
    },
    
    
    toggleSeat(row, seat) {
      console.log(`Clic en asiento: ${row}${seat}`);
    
      // Buscar en occupiedSeats
      const isOccupied = this.occupiedSeats.some(s => s.row === row && s.seat == seat);
    
      if (isOccupied) {
        console.warn(`El asiento ${row}${seat} ya está ocupado!`);
        return;
      }
    
      // Buscar en selectedSeats
      const seatIndex = this.selectedSeats.findIndex(s => s.row === row && s.seat == seat);
    
      if (seatIndex !== -1) {
        console.log(`Deselecting seat: ${row}${seat}`);
        this.selectedSeats.splice(seatIndex, 1);
      } else {
        if (this.selectedSeats.length >= 10) {
          alert("No puedes seleccionar más de 10 butacas por sesión");
          return;
        }
        
        // Buscar el ID del asiento en todos los asientos disponibles
        const seatId = this.getAvailableSeatId(row, seat);
        
        console.log(`Selecting seat: ${row}${seat} with ID: ${seatId}`);
        this.selectedSeats.push({ id: seatId, row, seat });
      }
    },
    getAvailableSeatId(row, seat) {
      // Primero, intentar encontrar el asiento en los asientos disponibles
      const availableSeat = this.allSeats?.find(s => s.row === row && s.number == seat);
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
