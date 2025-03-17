// stores/theater.js
import { defineStore } from 'pinia';

export const useTheaterStore = defineStore('theater', {
  state: () => ({
    // Configuración de la sala
    rowLetters: ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L'],
    seatsPerRow: 10,
    vipRow: 'F', // Fila 6 (F)
    
    // Precios
    prices: {
      normal: 6,
      vip: 8,
      discountNormal: 4,
      discountVip: 6
    },
    
    // Estado de la sesión
    isDiscountDay: false,
    
    // Datos de la película actual
    currentMovie: {
      id: 1,
      title: 'Aventures Galàctiques',
      genre: 'Ciència Ficció',
      duration: 120,
      rating: 4.0,
      isNew: true
    },
    
    // Datos de la sesión actual
    currentSession: {
      id: 1,
      movieId: 1,
      date: '15 Mar 2025',
      time: '19:30',
      room: 'VIP 3'
    },
    
    // Asientos ocupados (simulación)
    occupiedSeats: [
      { row: 'A', seat: 4 },
      { row: 'A', seat: 5 },
      { row: 'B', seat: 3 },
      { row: 'C', seat: 4 },
      { row: 'D', seat: 7 },
      { row: 'E', seat: 2 },
      { row: 'G', seat: 5 },
      { row: 'H', seat: 9 },
      { row: 'J', seat: 1 },
      { row: 'K', seat: 6 },
    ],
    
    // Asientos seleccionados por el usuario
    selectedSeats: []
  }),
  
  getters: {
    // Precio por asiento según tipo y día
    getPricePerSeat: (state) => (row) => {
      const isVip = row === state.vipRow;
      const price = isVip 
        ? (state.isDiscountDay ? state.prices.discountVip : state.prices.vip)
        : (state.isDiscountDay ? state.prices.discountNormal : state.prices.normal);
      return price;
    },
    
    // Precio total de los asientos seleccionados
    totalPrice: (state) => {
      return state.selectedSeats.reduce((total, seat) => {
        return total + state.getPricePerSeat(seat.row);
      }, 0);
    },
    
    // Verificar si un asiento está ocupado
    isSeatOccupied: (state) => (row, seat) => {
      return state.occupiedSeats.some(s => s.row === row && s.seat === seat);
    },
    
    // Verificar si un asiento está seleccionado
    isSeatSelected: (state) => (row, seat) => {
      return state.selectedSeats.some(s => s.row === row && s.seat === seat);
    },
    
    // Verificar si un asiento es VIP
    isVipSeat: (state) => (row) => {
      return row === state.vipRow;
    },
    
    // Retorna la clase CSS para un asiento
    getSeatClass: (state) => (row, seat) => {
      if (state.isSeatOccupied(row, seat)) return 'bg-gray-500';
      if (state.isSeatSelected(row, seat)) return 'bg-yellow-400';
      if (state.isVipSeat(row)) return 'bg-purple-500';
      return 'bg-blue-400';
    }
  },
  
  actions: {
    // Alternar la selección de un asiento
    toggleSeat(row, seat) {
      if (this.isSeatOccupied(row, seat)) return;
      
      const seatIndex = this.selectedSeats.findIndex(s => s.row === row && s.seat === seat);
      
      if (seatIndex !== -1) {
        // Deseleccionar asiento
        this.selectedSeats.splice(seatIndex, 1);
      } else {
        // Verificar límite de 10 asientos
        if (this.selectedSeats.length >= 10) {
          alert('No puedes seleccionar más de 10 butacas por sessió');
          return;
        }
        
        // Seleccionar asiento
        this.selectedSeats.push({ row, seat });
      }
    },
    
    // Alternar día del espectador
    toggleDiscountDay() {
      this.isDiscountDay = !this.isDiscountDay;
    },
    
    // Confirmar compra
    confirmPurchase() {
      if (this.selectedSeats.length === 0) {
        alert('Debes seleccionar al menos una butaca');
        return;
      }
      
      // Aquí iría la lógica para procesar la compra
      // Por ejemplo, enviar a un API, actualizar base de datos, etc.
      
      // Simulación de compra exitosa
      const seatCount = this.selectedSeats.length;
      const total = this.totalPrice;
      
      alert(`Compra confirmada: ${seatCount} butacas por ${total}€`);
      
      // Actualizar asientos ocupados y limpiar selección
      this.occupiedSeats = [...this.occupiedSeats, ...this.selectedSeats];
      this.selectedSeats = [];
    }
  }
});