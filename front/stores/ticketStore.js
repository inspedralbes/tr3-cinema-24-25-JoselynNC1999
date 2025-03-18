import { defineStore } from 'pinia';
import { useTheaterStore } from './theater';

export const useTicketStore = defineStore('ticket', {
  state: () => ({
    user: null
  }),

  actions: {
    setUser(user) {
      this.user = user;
    },

    async confirmPurchase() {
      const theaterStore = useTheaterStore();

      if (!this.user) {
        alert("Debes iniciar sesión para realizar la compra.");
        return;
      }

      await theaterStore.confirmPurchase(this.user.id, this.user.token);
    }
  }
});
