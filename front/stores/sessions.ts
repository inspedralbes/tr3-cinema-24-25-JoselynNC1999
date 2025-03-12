import { defineStore } from 'pinia';
import { ref } from 'vue';

interface Session {
  id: number;
  movie_id: number;
  date: string;
  time: string;
  availableSeats: number;
}

export const useSessionStore = defineStore('sessions', () => {
  const sessions = ref<Session[]>([]);
  const loading = ref(false);
  const error = ref<string | null>(null);

  const fetchSessions = async (movieId: number) => {
    try {
      loading.value = true;
      error.value = null;

      const response = await fetch(`http://127.0.0.1:8000/api/sessions?movie_id=${movieId}`, {
        method: 'GET',
        headers: {
          Accept: 'application/json',
        },
      });

      if (!response.ok) throw new Error('Error al cargar las sesiones');
      const data = await response.json();
      sessions.value = data; // Asigna las sesiones a la variable

    } catch (err) {
      error.value = 'Error al cargar las sesiones. Por favor, intente más tarde.';
      console.error('Error al cargar las sesiones:', err);
    } finally {
      loading.value = false;
    }
  };

  return {
    sessions,
    loading,
    error,
    fetchSessions,
  };
});
