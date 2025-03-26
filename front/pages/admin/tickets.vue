<template>
    <div class="admin-layout">
      <!-- Sidebar -->
      <div class="sidebar">
        <div class="sidebar-logo">CINEMA PEDRALBES</div>
        <ul class="sidebar-menu">
          <li><NuxtLink to="/admin" class="block p-3 rounded">Dashboard</NuxtLink></li>
          <li><NuxtLink to="/admin/sessions" class="block p-3 rounded">Gestió de Sessions</NuxtLink></li>
          <li><NuxtLink to="/admin/movies" class="block p-3 rounded">Pel·lícules</NuxtLink></li>
          <li><NuxtLink to="/admin/tickets" class="block p-3 rounded active">Entrades</NuxtLink></li>
          <li><NuxtLink to="/admin/users" class="block p-3 rounded">Usuaris</NuxtLink></li>
          <li><NuxtLink to="/admin/settings" class="block p-3 rounded">Configuració</NuxtLink></li>
        </ul>
      </div>
  
      <!-- Main Content -->
      <div class="main-content">
        <div class="header">
          <div class="header-title">Gestió d'Entrades</div>
          <button class="button-primary" @click="generateReport">Generar Informe</button>
        </div>
  
        <div class="search-bar">
          <input v-model="searchQuery" type="text" placeholder="Cerca per codi o nom" />
          <button class="button-primary" @click="searchTickets">Cercar</button>
        </div>
  
        <div class="tickets-grid">
          <div v-for="ticket in filteredTickets" :key="ticket.code" class="ticket-card">
            <div class="ticket-details">
              <div class="ticket-code">{{ ticket.code }}</div>
              <div class="ticket-movie">{{ ticket.movie }}</div>
              <div class="ticket-info">{{ ticket.date }} | {{ ticket.time }}</div>
              <div class="ticket-status">
                <span :class="getStatusClass(ticket.status)">
                  {{ formatStatus(ticket.status) }}
                </span>
              </div>
              <div class="ticket-actions">
                <button class="action-button" @click="viewTicket(ticket)">Veure</button>
                <button class="action-button" @click="printTicket(ticket)">Imprimir</button>
              </div>
            </div>
          </div>
        </div>
  
        <div class="pagination">
          <button @click="goToPage('previous')">Anterior</button>
          <span class="pagination-info">Pàgina {{ currentPage }} de {{ totalPages }}</span>
          <button @click="goToPage('next')">Següent</button>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        searchQuery: '',
        tickets: [
          {
            code: 'A12345',
            movie: 'Interstellar',
            date: '13/03/2025',
            time: '18:00',
            user: 'Joan Pérez',
            price: 12,
            status: 'valid'
          },
          {
            code: 'B67890',
            movie: 'Dune',
            date: '14/03/2025',
            time: '20:30',
            user: 'Maria García',
            price: 15,
            status: 'used'
          },
          {
            code: 'C24680',
            movie: 'Oppenheimer',
            date: '15/03/2025',
            time: '22:00',
            user: 'Lluís Martínez',
            price: 13,
            status: 'cancelled'
          }
        ],
        currentPage: 1,
        itemsPerPage: 10
      };
    },
    computed: {
      totalPages() {
        return Math.ceil(this.filteredTickets.length / this.itemsPerPage);
      },
      filteredTickets() {
        return this.tickets
          .filter(ticket => {
            return (
              ticket.code.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
              ticket.user.toLowerCase().includes(this.searchQuery.toLowerCase())
            );
          })
          .slice((this.currentPage - 1) * this.itemsPerPage, this.currentPage * this.itemsPerPage);
      }
    },
    methods: {
      generateReport() {
        // Placeholder for generating the report logic
        alert('Generant informe...');
      },
      searchTickets() {
        // Placeholder for searching tickets logic
      },
      getStatusClass(status) {
        switch (status) {
          case 'valid':
            return 'ticket-status status-valid';
          case 'used':
            return 'ticket-status status-used';
          case 'cancelled':
            return 'ticket-status status-cancelled';
          default:
            return '';
        }
      },
      formatStatus(status) {
        switch (status) {
          case 'valid':
            return 'Vàlid';
          case 'used':
            return 'Utilitzat';
          case 'cancelled':
            return 'Cancel·lat';
          default:
            return '';
        }
      },
      viewTicket(ticket) {
        // Placeholder for view ticket logic
        alert('Veient entrada ' + ticket.code);
      },
      printTicket(ticket) {
        // Placeholder for print ticket logic
        alert('Imprimint entrada ' + ticket.code);
      },
      goToPage(direction) {
        if (direction === 'previous' && this.currentPage > 1) {
          this.currentPage--;
        } else if (direction === 'next' && this.currentPage < this.totalPages) {
          this.currentPage++;
        }
      }
    }
  };
  </script>
  
  <style scoped>
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
  
  .tickets-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 20px;
  }
  
  .ticket-card {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
  }
  
  .ticket-details {
    padding: 15px;
  }
  
  .ticket-code {
    font-weight: bold;
    margin-bottom: 5px;
  }
  
  .ticket-movie {
    color: #666;
    margin-bottom: 10px;
  }
  
  .ticket-status {
    margin-bottom: 10px;
  }
  
  .ticket-actions {
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
  