<template>
  <div class="admin-layout">
    <!-- Sidebar -->
    <slideBar />

    <!-- Main Content -->
    <div class="main-content">
      <h2>Lista de Sesiones</h2>

      <table>
        <thead>
          <tr>
            <th>Película</th>
            <th>Fecha</th>
            <th>Hora Inicio</th>
            <th>Duración</th>
            <th>Ocupación</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="session in sessions" :key="session.id">
            <td>{{ session.movie?.title || 'Película desconocida' }}</td>
            <td>{{ formatDate(session.date) }}</td>
            <td>{{ formatTime(session.time) }}</td>
            <td>{{ session.movie?.duration ? session.movie.duration + ' min' : 'Desconocida' }}</td>
            <td>54%</td> <!-- Puedes cambiarlo si tienes datos reales de ocupación -->
            <td>
              <button class="action-button" @click="editSession(session)">Editar</button>
              <button class="action-button" @click="viewDetails(session)">Detalles</button>
            </td>
          </tr>
        </tbody>
      </table>

      <p v-if="loading">Cargando sesiones...</p>
      <p v-if="error" class="error">{{ error }}</p>
    </div>
  </div>
</template>

<script setup>
import { onMounted } from 'vue'
import { useSessionStore } from '@/stores/sessions'
import slideBar from '@/components/layout/slideBar'

const sessionStore = useSessionStore()
const { sessions, loading, error, fetchAllSessions } = sessionStore

onMounted(() => {
  fetchAllSessions()
})

const formatDate = (date) => {
  if (!date) return 'Fecha no disponible'
  return new Date(date).toLocaleDateString('es-ES', { year: 'numeric', month: 'long', day: 'numeric' })
}

const formatTime = (time) => time || 'Hora no disponible'

const editSession = (session) => {
  console.log('Editar sesión:', session)
}

const viewDetails = (session) => {
  console.log('Ver detalles de sesión:', session)
}
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

.main-content {
  flex-grow: 1;
  padding: 20px;
  background-color: #f4f4f4;
}

h2 {
  margin-bottom: 15px;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 10px;
}

th, td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

th {
  background-color: #f4f4f4;
}

.action-button {
  background-color: #0a4b96;
  color: white;
  border: none;
  padding: 8px 12px;
  border-radius: 5px;
  cursor: pointer;
  margin-right: 5px;
}

.error {
  color: red;
}
</style>
