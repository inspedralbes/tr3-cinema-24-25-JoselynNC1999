<template>
    <div class="admin-layout">
      <!-- Sidebar -->
      <div class="sidebar">
        <div class="sidebar-logo">CINEMA PEDRALBES</div>
        <ul class="sidebar-menu">
          <li><NuxtLink to="/admin" class="block p-3 rounded">Dashboard</NuxtLink></li>
          <li><NuxtLink to="/admin/sessions" class="block p-3 rounded">Gestió de Sessions</NuxtLink></li>
          <li><NuxtLink to="/admin/movies" class="block p-3 rounded">Pel·lícules</NuxtLink></li>
          <li><NuxtLink to="/admin/tickets" class="block p-3 rounded">Entrades</NuxtLink></li>
          <li><NuxtLink to="/admin/users" class="block p-3 rounded">Usuaris</NuxtLink></li>
          <li><NuxtLink to="/admin/settings" class="block p-3 rounded active">Configuració</NuxtLink></li>
        </ul>
      </div>
  
      <!-- Main Content -->
      <div class="main-content">
        <div class="header">
          <div class="header-title">Configuració</div>
        </div>
  
        <div class="configuration-section">
          <h2>Configuració General</h2>
          <form>
            <div class="form-group">
              <label>Nom del Cinema</label>
              <input type="text" v-model="cinema.name" placeholder="Introdueix el nom del cinema" />
            </div>
            <div class="form-group">
              <label>Adreça</label>
              <input type="text" v-model="cinema.address" placeholder="Introdueix l'adreça del cinema" />
            </div>
            <div class="form-group">
              <label>Correu Electrònic de Contacte</label>
              <input type="email" v-model="cinema.contactEmail" placeholder="Introdueix el correu de contacte" />
            </div>
            <div class="form-group">
              <label>Telèfon de Contacte</label>
              <input type="tel" v-model="cinema.contactPhone" placeholder="Introdueix el telèfon" />
            </div>
          </form>
        </div>
  
        <div class="configuration-section">
          <h2>Configuració de Vendes</h2>
          <form>
            <div class="form-group">
              <label>Mètodes de Pagament</label>
              <div class="checkbox-container">
                <input type="checkbox" v-model="paymentMethods.card" />
                <label>Targeta</label>
                <input type="checkbox" v-model="paymentMethods.cash" />
                <label>Efectiu</label>
                <input type="checkbox" v-model="paymentMethods.mobilePay" />
                <label>Mobile Pay</label>
              </div>
            </div>
            <div class="form-group">
              <label>Descomptes Actius</label>
              <select v-model="discounts">
                <option value="none">Cap</option>
                <option value="students">Estudiants (-20%)</option>
                <option value="seniors">Jubilats (-15%)</option>
                <option value="family">Familiar (-25%)</option>
              </select>
            </div>
            <div class="form-group">
              <label>IVA</label>
              <input type="number" v-model="tax" min="0" max="100" step="1" /> %
            </div>
          </form>
        </div>
  
        <div class="configuration-section">
          <h2>Configuració d'Usuaris</h2>
          <form>
            <div class="form-group">
              <label>Política de Registre</label>
              <select v-model="userRegistrationPolicy">
                <option value="open">Registre Obert</option>
                <option value="approval">Registre amb Aprovació</option>
                <option value="closed">Registre Tancat</option>
              </select>
            </div>
            <div class="form-group">
              <label>Política de Contrasenyes</label>
              <div class="checkbox-container">
                <input type="checkbox" v-model="passwordPolicy.minLength" />
                <label>Longitud Mínima (8 caràcters)</label>
                <input type="checkbox" v-model="passwordPolicy.complexity" />
                <label>Complexitat (majúscules, minúscules, números)</label>
              </div>
            </div>
          </form>
        </div>
  
        <div class="save-button">
          <button class="button-primary" @click="saveChanges">Desar Canvis</button>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  
  // Estado reactivo para almacenar los datos
  const cinema = ref({
    name: 'Cinépolis Pedralbes',
    address: 'Avinguda Diagonal, 123, Barcelona',
    contactEmail: 'info@cinemapedralbes.cat',
    contactPhone: '+34 933 456 789',
  });
  
  const paymentMethods = ref({
    card: true,
    cash: true,
    mobilePay: false,
  });
  
  const discounts = ref('students');
  const tax = ref(21);
  const userRegistrationPolicy = ref('approval');
  const passwordPolicy = ref({
    minLength: true,
    complexity: true,
  });
  
  // Función para guardar los cambios
  const saveChanges = () => {
    console.log('Changes saved', {
      cinema: cinema.value,
      paymentMethods: paymentMethods.value,
      discounts: discounts.value,
      tax: tax.value,
      userRegistrationPolicy: userRegistrationPolicy.value,
      passwordPolicy: passwordPolicy.value,
    });
  };
  </script>
  
  <style scoped>
  /* Estilos anteriores adaptados */
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }
  
  body {
    font-family: Arial, sans-serif;
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
  
  .configuration-section {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    padding: 20px;
  }
  
  .configuration-section h2 {
    border-bottom: 2px solid #0a4b96;
    padding-bottom: 10px;
    margin-bottom: 20px;
    color: #0a4b96;
  }
  
  .form-group {
    margin-bottom: 15px;
  }
  
  .form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
  }
  
  .form-group input,
  .form-group select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
  }
  
  .form-group .checkbox-container {
    display: flex;
    align-items: center;
    gap: 10px;
  }
  
  .form-group .checkbox-container input {
    width: auto;
    margin-right: 10px;
  }
  
  .save-button {
    display: flex;
    justify-content: flex-end;
    margin-top: 20px;
  }
  </style>
  