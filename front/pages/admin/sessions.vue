<template>
  <div class="admin-layout">
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="sidebar-logo">CINEMA PEDRALBES</div>
      <ul class="sidebar-menu">
        <li><NuxtLink to="/admin" class="block p-3 rounded">Dashboard</NuxtLink></li>
        <li><NuxtLink to="/admin/sessions" class="block p-3 rounded active">Gestió de Sessions</NuxtLink></li>
        <li><NuxtLink to="/admin/movies" class="block p-3 rounded">Pel·lícules</NuxtLink></li>
        <li><NuxtLink to="/admin/tickets" class="block p-3 rounded">Entrades</NuxtLink></li>
        <li><NuxtLink to="/admin/users" class="block p-3 rounded">Usuaris</NuxtLink></li>
        <li><NuxtLink to="/admin/settings" class="block p-3 rounded">Configuració</NuxtLink></li>
      </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      <div class="header">
        <div class="header-title">Gestió de Sessions</div>
        <button class="button-primary" @click="createSession">Nova Sessió</button>
      </div>

      <!-- Filter and Table -->
      <div class="filter-bar">
        <input v-model="searchQuery" type="text" placeholder="Cerca per pel·lícula o data" />
        <button class="button-primary" @click="filterSessions">Filtrar</button>
      </div>

      <div class="sessions-table">
        <table>
          <thead>
            <tr>
              <th>Pel·lícula</th>
              <th>Data i Hora</th>
              <th>Durada</th>
              <th>Ocupació</th>
              <th>Accions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="session in filteredSessions" :key="session.id">
              <td>{{ session.movieTitle }}</td>
              <td>{{ session.dateTime }}</td>
              <td>{{ session.duration }} min</td>
              <td>{{ session.occupancy }}%</td>
              <td>
                <div class="session-actions">
                  <button class="action-button" @click="editSession(session)">Editar</button>
                  <button class="action-button" @click="viewDetails(session)">Detalls</button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="pagination">
        <button @click="prevPage">Anterior</button>
        <span class="pagination-info">Pàgina {{ currentPage }} de {{ totalPages }}</span>
        <button @click="nextPage">Següent</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      sessions: [
        { id: 1, movieTitle: "Interstellar", dateTime: "2025-03-27 18:30", duration: 169, occupancy: 85 },
        { id: 2, movieTitle: "The Dark Knight", dateTime: "2025-03-28 20:00", duration: 152, occupancy: 75 },
        { id: 3, movieTitle: "Inception", dateTime: "2025-03-29 17:15", duration: 148, occupancy: 90 },
      ],
      searchQuery: "",
      currentPage: 1,
      itemsPerPage: 5,
    };
  },
  computed: {
    filteredSessions() {
      let filtered = this.sessions;

      if (this.searchQuery) {
        filtered = filtered.filter(session =>
          session.movieTitle.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
          session.dateTime.toLowerCase().includes(this.searchQuery.toLowerCase())
        );
      }

      return filtered.slice((this.currentPage - 1) * this.itemsPerPage, this.currentPage * this.itemsPerPage);
    },
    totalPages() {
      return Math.ceil(this.sessions.length / this.itemsPerPage);
    }
  },
  methods: {
    filterSessions() {
      this.currentPage = 1;
    },
    createSession() {
      console.log("Crear nova sessió");
    },
    editSession(session) {
      console.log("Editar sessió", session);
    },
    viewDetails(session) {
      console.log("Veure detalls de la sessió", session);
    },
    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
      }
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
      }
    }
  }
};
</script>

<style scoped>
/* Estilos comunes */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
  background-color: #f4f4f4;
}

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

.filter-bar {
  display: flex;
  gap: 10px;
  margin-bottom: 20px;
}

.filter-bar input {
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 5px;
  width: 250px;
}

.sessions-table {
  width: 100%;
  background-color: white;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  overflow: hidden;
}

.sessions-table table {
  width: 100%;
  border-collapse: collapse;
}

.sessions-table th,
.sessions-table td {
  padding: 12px 15px;
  text-align: left;
  border-bottom: 1px solid #f1f1f1;
}

.sessions-table thead {
  background-color: #f4f4f4;
  font-weight: bold;
}

.session-actions {
  display: flex;
  gap: 10px;
}

.action-button {
  background-color: #0a4b96;
  color: white;
  border: none;
  padding: 6px 12px;
  border-radius: 4px;
  cursor: pointer;
  font-size: 12px;
}

.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 10px;
  margin-top: 20px;
}

.pagination button {
  background-color: #0a4b96;
  color: white;
  border: none;
  padding: 8px 15px;
  border-radius: 5px;
  cursor: pointer;
}

.pagination-info {
  color: #666;
}
</style>
