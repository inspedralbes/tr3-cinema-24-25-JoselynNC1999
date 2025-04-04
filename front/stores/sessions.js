import { defineStore } from 'pinia'
import { ref } from 'vue'
import { useRuntimeConfig } from '#app'

// Define base API URL directly
const config = useRuntimeConfig()
const API_URL = config.public.apiBase.replace(/\/$/, '') // URL base de la API

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
      const url = new URL(`${API_URL.replace(/\/$/, '')}/${endpoint.replace(/^\//, '')}`);
      const response = await $fetch(url.toString(), {
        method: 'GET',
        headers: {
          Accept: 'application/json',
        },
        redirect: 'follow'
      });

      if (response.length <= 0) throw new Error(`Error al cargar ${endpoint}`)
      const data = response;
      
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
