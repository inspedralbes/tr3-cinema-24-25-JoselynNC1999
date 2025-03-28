import { defineStore } from 'pinia'
import { ref } from 'vue'

const API_URL = 'https://cinepolisback.daw.inspedralbes.cat/api'.replace(/\/$/, '') // URL base de la API

export const useSessionStore = defineStore('sessions', () => {
  const sessions = ref([])
  const dates = ref([])
  const loading = ref(false)
  const error = ref(null)

  // Función genérica para realizar fetch
  const fetchData = async (endpoint, targetRef) => {
    try {
      loading.value = true
      error.value = null

      const response = await fetch(`${API_URL}/${endpoint}`.replace(/\/\//g, '/'), {
        method: 'GET',
        headers: {
          Accept: 'application/json',
        },
      })

      if (!response.ok) throw new Error(`Error al cargar ${endpoint}`)
      const data = await response.json()
      
      targetRef.value = Array.isArray(data) ? data : []
    } catch (err) {
      error.value = `Error al cargar ${endpoint}. Por favor, intente más tarde.`
      console.error(`Error al cargar ${endpoint}:`, err)
    } finally {
      loading.value = false
    }
  }

  // Obtener todas las sesiones
  const fetchAllSessions = async () => {
    await fetchData('sessions', sessions)
  }

  // Obtener sesiones por ID de película
  const fetchSessions = async (movieId) => {
    await fetchData(`sessions?movie_id=${movieId}`, sessions)
  }

  // Obtener fechas desde la API
  const fetchDates = async () => {
    await fetchData('dates', dates)
  }

  return {
    sessions,
    dates,
    loading,
    error,
    fetchAllSessions,
    fetchSessions,
    fetchDates
  }
})
