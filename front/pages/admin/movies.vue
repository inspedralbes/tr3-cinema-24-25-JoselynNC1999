<template>
    <div class="admin-layout">
      <!-- Sidebar -->
      <div class="sidebar">
        <div class="sidebar-logo">CINEMA PEDRALBES</div>
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
            <div class="movie-poster">{{ movie.title }}</div>
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
  
        <!-- Modal for Adding/Editing Movie -->
        <div v-if="isModalOpen" class="modal">
          <div class="modal-content">
            <div class="modal-header">
              <h2>{{ modalTitle }}</h2>
              <button class="close-button" @click="closeAddMovieModal">&times;</button>
            </div>
            <form @submit.prevent="saveMovie">
              <div style="display: flex; flex-direction: column; gap: 15px;">
                <input v-model="movieForm.title" type="text" placeholder="Títol de la Pel·lícula" required />
                <input v-model="movieForm.year" type="text" placeholder="Any" required />
                <input v-model="movieForm.genre" type="text" placeholder="Gènere" required />
                <input v-model="movieForm.director" type="text" placeholder="Director" required />
                <input v-model="movieForm.duration" type="number" placeholder="Durada (minuts)" required />
                <textarea v-model="movieForm.synopsis" placeholder="Sinopsi" required></textarea>
                <button type="submit" class="button-primary">Guardar Pel·lícula</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        searchQuery: '',
        isModalOpen: false,
        modalTitle: 'Afegir Nova Pel·lícula',
        movieForm: {
          title: '',
          year: '',
          genre: '',
          director: '',
          duration: '',
          synopsis: ''
        },
        movies: [
          { id: 1, title: 'Interstellar', year: 2014, genre: 'Ciència-ficció', director: 'Christopher Nolan', duration: 169, synopsis: 'Un grup d\'exploradors viatgen a través d\'un forat de cuc per salvar la humanitat.' },
          { id: 2, title: 'Dune', year: 2021, genre: 'Ciència-ficció', director: 'Denis Villeneuve', duration: 155, synopsis: 'En un futur llunyà, un jove ha de lluitar per sobreviure en un món ple de perills.' },
          { id: 3, title: 'Oppenheimer', year: 2023, genre: 'Biografia, Drama', director: 'Christopher Nolan', duration: 180, synopsis: 'La història del científic J. Robert Oppenheimer i el desenvolupament de la bomba atòmica.' },
          { id: 4, title: 'Avatar', year: 2009, genre: 'Ciència-ficció', director: 'James Cameron', duration: 162, synopsis: 'Un ex-marine es converteix en part d\'una tribu indígena en un planeta llunyà.' }
        ]
      };
    },
    computed: {
      filteredMovies() {
        return this.movies.filter(movie => {
          return (
            movie.title.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
            movie.year.toString().includes(this.searchQuery) ||
            movie.genre.toLowerCase().includes(this.searchQuery.toLowerCase())
          );
        });
      }
    },
    methods: {
      openAddMovieModal() {
        this.isModalOpen = true;
        this.modalTitle = 'Afegir Nova Pel·lícula';
        this.movieForm = { title: '', year: '', genre: '', director: '', duration: '', synopsis: '' };
      },
      closeAddMovieModal() {
        this.isModalOpen = false;
      },
      saveMovie() {
        if (this.movieForm.title && this.movieForm.year && this.movieForm.genre) {
          this.movies.push({
            ...this.movieForm,
            id: this.movies.length + 1
          });
          this.closeAddMovieModal();
        }
      },
      editMovie(movie) {
        this.isModalOpen = true;
        this.modalTitle = 'Editar Pel·lícula';
        this.movieForm = { ...movie };
      },
      deleteMovie(movie) {
        const index = this.movies.findIndex(m => m.id === movie.id);
        if (index !== -1) {
          this.movies.splice(index, 1);
        }
      },
      searchMovies() {
        // You can implement a more advanced search logic if necessary
      }
    }
  };
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