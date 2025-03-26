<template>
    <div class="admin-layout">
      <!-- Sidebar -->
      <div class="sidebar">
        <div class="sidebar-logo">CINÉPOLIS PEDRALBES</div>
        <ul class="sidebar-menu">
          <li><NuxtLink to="/admin" class="block p-3 rounded">Dashboard</NuxtLink></li>
          <li><NuxtLink to="/admin/sessions" class="block p-3 rounded">Gestió de Sessions</NuxtLink></li>
          <li><NuxtLink to="/admin/movies" class="block p-3 rounded">Pel·lícules</NuxtLink></li>
          <li><NuxtLink to="/admin/tickets" class="block p-3 rounded">Entrades</NuxtLink></li>
          <li><NuxtLink to="/admin/users" class="block p-3 rounded  active">Usuaris</NuxtLink></li>
          <li><NuxtLink to="/admin/settings" class="block p-3 rounded">Configuració</NuxtLink></li>
        </ul>
      </div>
  
      <!-- Main Content -->
      <div class="main-content">
        <div class="header">
          <div class="header-title">Gestió d'Usuaris</div>
          <button class="button-primary" @click="createUser">Nou Usuari</button>
        </div>
  
        <!-- Filter and Table -->
        <div class="filter-bar">
          <select v-model="statusFilter">
            <option>Tots els estatus</option>
            <option>Actiu</option>
            <option>Inactiu</option>
            <option>Pendent</option>
          </select>
          <input v-model="searchQuery" type="text" placeholder="Cerca per nom, correu o DNI" />
          <button class="button-primary" @click="filterUsers">Filtrar</button>
        </div>
  
        <div class="users-table">
          <table>
            <thead>
              <tr>
                <th>Nom</th>
                <th>Correu Electrònic</th>
                <th>DNI</th>
                <th>Data de Registre</th>
                <th>Telèfon</th>
                <th>Estatus</th>
                <th>Accions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="user in filteredUsers" :key="user.dni">
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.dni }}</td>
                <td>{{ user.registrationDate }}</td>
                <td>{{ user.phone }}</td>
                <td>
                  <span :class="['user-status', user.statusClass]">{{ user.status }}</span>
                </td>
                <td>
                  <div class="user-actions">
                    <button class="action-button" @click="editUser(user)">Editar</button>
                    <button class="action-button" @click="viewDetails(user)">Detalls</button>
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
        users: [
          { name: "Joan Pérez García", email: "joan.perez@email.com", dni: "12345678A", registrationDate: "01/01/2025", phone: "+34 666 123 456", status: "Actiu", statusClass: "status-active" },
          { name: "Maria García López", email: "maria.garcia@email.com", dni: "87654321B", registrationDate: "15/02/2025", phone: "+34 777 234 567", status: "Inactiu", statusClass: "status-inactive" },
          { name: "Lluís Martínez Pons", email: "lluis.martinez@email.com", dni: "56781234C", registrationDate: "10/03/2025", phone: "+34 888 345 678", status: "Pendent", statusClass: "status-pending" },
        ],
        statusFilter: "Tots els estatus",
        searchQuery: "",
        currentPage: 1,
        itemsPerPage: 5,
      };
    },
    computed: {
      filteredUsers() {
        let filtered = this.users;
  
        if (this.statusFilter !== "Tots els estatus") {
          filtered = filtered.filter(user => user.status === this.statusFilter);
        }
  
        if (this.searchQuery) {
          filtered = filtered.filter(user =>
            user.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
            user.email.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
            user.dni.toLowerCase().includes(this.searchQuery.toLowerCase())
          );
        }
  
        return filtered.slice((this.currentPage - 1) * this.itemsPerPage, this.currentPage * this.itemsPerPage);
      },
      totalPages() {
        return Math.ceil(this.users.length / this.itemsPerPage);
      }
    },
    methods: {
      filterUsers() {
        this.currentPage = 1;
      },
      createUser() {
        console.log("Crear nou usuari");
      },
      editUser(user) {
        console.log("Editar usuari", user);
      },
      viewDetails(user) {
        console.log("Veure detalls de l'usuari", user);
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
  
  .filter-bar input,
  .filter-bar select {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
  }
  
  .users-table {
    width: 100%;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
  }
  
  .users-table table {
    width: 100%;
    border-collapse: collapse;
  }
  
  .users-table th,
  .users-table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #f1f1f1;
  }
  
  .users-table thead {
    background-color: #f4f4f4;
    font-weight: bold;
  }
  
  .user-status {
    display: inline-block;
    padding: 5px 10px;
    border-radius: 15px;
    font-size: 12px;
    font-weight: bold;
  }
  
  .status-active {
    background-color: #4CAF50;
    color: white;
  }
  
  .status-inactive {
    background-color: #F44336;
    color: white;
  }
  
  .status-pending {
    background-color: #FF9800;
    color: white;
  }
  
  .user-actions {
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
  