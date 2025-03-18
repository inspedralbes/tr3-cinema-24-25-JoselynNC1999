import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useMovieStore = defineStore('movies', () => {
  const movies = ref([])
  const featuredMovies = ref([])
  const regularMovies = ref([])
  const totalPages = ref(1)
  const currentPage = ref(1)
  const loading = ref(false)
  const error = ref(null)

  const fetchMovies = async (page = 1) => {
    try {
      loading.value = true
      error.value = null

      const response = await fetch(`http://localhost:8000/api/movies?page=${page}`, {
        method: "GET",
        headers: {
          Accept: "application/json",
        },
      })

      if (!response.ok) throw new Error("Error loading movies")
      const data = await response.json()

      movies.value = data.map(movie => ({
        ...movie,
        poster_url: movie.poster_url || 'https://via.placeholder.com/300x450?text=No+Image'
      }))

      featuredMovies.value = movies.value.filter(movie => movie.badge === 'ESTRENA')
      regularMovies.value = movies.value.filter(movie => !movie.badge || movie.badge !== 'ESTRENA')

      if (data.meta) {
        totalPages.value = data.meta.last_page
        currentPage.value = data.meta.current_page
      }
    } catch (err) {
      error.value = 'Error loading movies. Please try again later.'
      console.error('Error loading movies:', err)
    } finally {
      loading.value = false
    }
  }

  return { movies, featuredMovies, regularMovies, totalPages, currentPage, loading, error, fetchMovies }
})
