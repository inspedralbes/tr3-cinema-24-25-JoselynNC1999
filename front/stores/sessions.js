import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useSessionStore = defineStore('sessions', () => {
  const apiUrl = 'http://127.0.0.1:8000/api' // URL base de la API
  const sessions = ref([])
  const dates = ref([])
  const loading = ref(false)
  const error = ref(null)

  // Obtener todas las sesiones
  const fetchAllSessions = async () => {
    try {
      loading.value = true
      error.value = null

      const response = await fetch(`${apiUrl}/sessions`, {
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

  // Obtener sesiones por ID de película
  const fetchSessions = async (movieId) => {
    try {
      loading.value = true
      error.value = null

      const response = await fetch(`${apiUrl}/sessions?movie_id=${movieId}`, {
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

  // Obtener fechas desde la API
  const fetchDates = async () => {
    try {
      loading.value = true
      error.value = null

      const response = await fetch(`${apiUrl}/dates`, {
        method: 'GET',
        headers: {
          Accept: 'application/json',
        },
      })

      if (!response.ok) throw new Error('Error al cargar las fechas')
      const data = await response.json()

      dates.value = Array.isArray(data) ? data : [] // Asegurar que sea un array

    } catch (err) {
      error.value = 'Error al cargar las fechas. Por favor, intente más tarde.'
      console.error('Error al cargar las fechas:', err)
    } finally {
      loading.value = false
    }
  }

  return {
    apiUrl,
    sessions,
    dates,
    loading,
    error,
    fetchAllSessions,
    fetchSessions,
    fetchDates
  }
})
