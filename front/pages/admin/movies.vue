<template>
    <div class="admin-layout">
      <!-- Sidebar -->
      <div class="sidebar">
        <div class="sidebar-logo">CINÉPOLIS PEDRALBES</div>
        <ul class="sidebar-menu">
          <li><NuxtLink to="/admin" class="block p-3 rounded">Dashboard</NuxtLink></li>
          <li><NuxtLink to="/admin/sessions" class="block p-3 rounded">Gestió de Sessions</NuxtLink></li>
          <li><NuxtLink to="/admin/movies" class="block p-3 rounded active">Pel·lícules</NuxtLink></li>
          <li><NuxtLink to="/admin/tickets" class="block p-3 rounded">Entrades</NuxtLink></li>
          <li><NuxtLink to="/admin/users" class="block p-3 rounded">Usuaris</NuxtLink></li>
          <li><NuxtLink to="/admin/settings" class="block p-3 rounded">Configuració</NuxtLink></li>
        </ul>
      </div>
  
      <!-- Main Content -->
      <div class="main-content">
        <div class="header">
          <div class="header-title">Gestió de Pel·lícules</div>
          <button class="button-primary" @click="openAddMovieModal">Afegir Nova Pel·lícula</button>
        </div>
  
        <div class="search-bar">
          <input v-model="searchQuery" type="text" placeholder="Cerca pel·lícules per títol, any o gènere" />
          <button class="button-primary" @click="searchMovies">Cercar</button>
        </div>
  
        <div class="movies-grid">
          <div v-for="movie in filteredMovies" :key="movie.id" class="movie-card">
            <div class="movie-poster">
              <img :src="movie.poster_url" alt="Poster" />
            </div>
            <div class="movie-details">
              <div class="movie-title">{{ movie.title }}</div>
              <div class="movie-info">{{ movie.year }} | {{ movie.genre }}</div>
              <div class="movie-actions">
                <button class="action-button" @click="editMovie(movie)">Editar</button>
                <button class="action-button" @click="deleteMovie(movie)">Eliminar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { useMovieStore } from '@/stores/movies'
  import { computed, ref, onMounted } from 'vue'
  
  export default {
    setup() {
      const movieStore = useMovieStore();
      const searchQuery = ref('');
  
      onMounted(() => {
        movieStore.fetchMovies();
      });
  
      const filteredMovies = computed(() => {
        return movieStore.movies.filter(movie => {
          return (
            movie.title.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
            movie.year.toString().includes(searchQuery.value) ||
            movie.genre.toLowerCase().includes(searchQuery.value.toLowerCase())
          );
        });
      });
  
      return {
        searchQuery,
        filteredMovies,
        openAddMovieModal: () => {},
        editMovie: () => {},
        deleteMovie: () => {},
      };
    }
  }
  </script>
  
  <style scoped>
  /* Reusing the styles from the previous code, adjusted for this component */
  
  .admin-layout {
    display: flex;
    height: 100vh;
  }
  
  .sidebar {
    width: 250px;
    background-color: #0a4b96;
    color: white;
    padding: 20px;
  }
  
  .sidebar-logo {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 30px;
    text-align: center;
  }
  
  .sidebar-menu {
    list-style: none;
  }
  
  .sidebar-menu li {
    margin-bottom: 10px;
  }
  
  .sidebar-menu a {
    color: white;
    text-decoration: none;
    display: block;
    padding: 10px 15px;
    border-radius: 5px;
    transition: background-color 0.3s;
  }
  
  .sidebar-menu a:hover,
  .sidebar-menu a.active {
    background-color: rgba(255, 255, 255, 0.2);
  }
  
  .main-content {
    flex-grow: 1;
    padding: 20px;
    background-color: #f4f4f4;
    overflow-y: auto;
  }
  
  .header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
  }
  
  .header-title {
    font-size: 24px;
    font-weight: bold;
  }
  
  .button-primary {
    background-color: #0a4b96;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
  }
  
  .search-bar {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
  }
  
  .search-bar input {
    flex-grow: 1;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
  }
  
  .movies-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 20px;
  }
  
  .movie-card {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
  }
  
  .movie-poster {
    background-color: #e0e0e0;
    height: 300px;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  
  .movie-details {
    padding: 15px;
  }
  
  .movie-title {
    font-weight: bold;
    margin-bottom: 5px;
  }
  
  .movie-info {
    color: #666;
    margin-bottom: 10px;
  }
  
  .movie-actions {
    display: flex;
    justify-content: space-between;
  }
  
  .action-button {
    background-color: #0a4b96;
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
  }
  
  .modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
  }
  
  .modal-content {
    background-color: white;
    border-radius: 8px;
    width: 500px;
    padding: 20px;
    max-height: 80%;
    overflow-y: auto;
  }
  
  .modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
  }
  
  .close-button {
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
  }
  </style>