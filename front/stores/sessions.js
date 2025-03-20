import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useSessionStore = defineStore('sessions', () => {
  const sessions = ref([])
  const loading = ref(false)
  const error = ref(null)

  const fetchSessions = async (movieId) => {
    try {
      loading.value = true
      error.value = null

      const response = await fetch(`http://127.0.0.1:8000/api/sessions?movie_id=${movieId}`, {
        method: 'GET',
        headers: {
          Accept: 'application/json',
        },
      })

      if (!response.ok) throw new Error('Error al cargar las sesiones')
      const data = await response.json()

      sessions.value = Array.isArray(data) ? data : [] // Asegurar que sea un array

    } catch (err) {
      error.value = 'Error al cargar las sesiones. Por favor, intente más tarde.'
      console.error('Error al cargar las sesiones:', err)
    } finally {
      loading.value = false
    }
  }
  const fetchAllSessions = async () => {
    try {
      loading.value = true
      error.value = null

      const response = await fetch(`http://127.0.0.1:8000/api/sessions`, {
        method: 'GET',
        headers: {
          Accept: 'application/json',
        },
      })

      if (!response.ok) throw new Error('Error al cargar las sesiones')
      const data = await response.json()

      sessions.value = Array.isArray(data) ? data : [] // Asegurar que sea un array

    } catch (err) {
      error.value = 'Error al cargar las sesiones. Por favor, intente más tarde.'
      console.error('Error al cargar las sesiones:', err)
    } finally {
      loading.value = false
    }
  }

  return {
    sessions,
    loading,
    error,
    fetchAllSessions,
    fetchSessions
  }

  
})