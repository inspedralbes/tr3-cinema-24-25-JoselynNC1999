import { defineStore } from 'pinia'
import { ref } from 'vue';
import { useRuntimeConfig } from '#app'

// Define base API URL directly
const config = useRuntimeConfig();
const API_URL = config.public.apiBase // URL base de la API

export const useMovieStore = defineStore('movies', () => {
  // State
  const movies = ref([])
  const featuredMovies = ref([])
  const regularMovies = ref([])
  const totalPages = ref(1)
  const currentPage = ref(1)
  const loading = ref(false)
  const error = ref(null)

  // Función genérica para realizar fetch
  const fetchData = async (endpoint, targetRef, transform = null) => {
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
      })

      if (response.length <= 0) throw new Error(`Error en la API (${response.status})`)
      const data = response;

      targetRef.value = transform ? transform(data) : data
    } catch (err) {
      error.value = `Error al cargar ${endpoint}. Inténtalo más tarde.`
      console.error(`Error al cargar ${endpoint}:`, err)
    } finally {
      loading.value = false
    }
  }

  // ✅ Cargar todas las películas (con paginación)
  const fetchMovies = async (page = 1) => {
    await fetchData(`movies?page=${page}`, movies, (data) => {
      const processedMovies = data.map(movie => ({
        ...movie,
        poster_url: movie.poster_url || 'https://via.placeholder.com/300x450?text=No+Image'
      }))

      featuredMovies.value = processedMovies.filter(movie => movie.badge === 'ESTRENA')
      regularMovies.value = processedMovies.filter(movie => !movie.badge || movie.badge !== 'ESTRENA')

      if (data.meta) {
        totalPages.value = data.meta.last_page
        currentPage.value = data.meta.current_page
      }
      return processedMovies
    })
  }

  // ✅ Obtener película desde el store (si ya ha sido cargada)
  const getMovieById = (id) => {
    return movies.value.find(movie => movie.id == id) || null
  }

  // ✅ Obtener película directamente desde la API si no está en el store
  const fetchMovieById = async (id) => {
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
      })

      if (response.length <= 0) throw new Error(`Error en la API (${response.status})`)
      const movie = response

      if (!getMovieById(id)) {
        movies.value.push(movie)
      }

      return movie
    } catch (err) {
      error.value = 'Error al cargar la película. Inténtalo más tarde.'
      console.error(`Error en fetchMovieById(${id}):`, err)
      return null
    } finally {
      loading.value = false
    }
  }

  return { 
    movies, 
    featuredMovies, 
    regularMovies, 
    totalPages, 
    currentPage, 
    loading, 
    error, 
    fetchMovies, 
    getMovieById, 
    fetchMovieById 
  }
})
