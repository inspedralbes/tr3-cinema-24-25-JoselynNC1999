<template>
  <div class="admin-layout">
    <!-- Barra lateral -->
    <slideBar />

    <!-- Contingut principal -->
    <div class="main-content">
      <h2>Llista de Sessions</h2>

      <table>
        <thead>
          <tr>
            <th>Pel·lícula</th>
            <th>Data</th>
            <th>Hora d'Inici</th>
            <th>Durada</th>
            <th>Ocupació</th>
            <th>Accions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="session in sessions" :key="session.id">
            <td>{{ session.movie?.title || 'Pel·lícula desconeguda' }}</td>
            <td>{{ formatDate(session.date) }}</td>
            <td>{{ formatTime(session.time) }}</td>
            <td>{{ session.movie?.duration ? session.movie.duration + ' min' : 'Desconeguda' }}</td>
            <td>54%</td> <!-- Ajusta segons dades reals -->
            <td>
              <button class="action-button" @click="editSession(session)">Editar</button>
              <button class="action-button" @click="viewDetails(session)">Detalls</button>
            </td>
          </tr>
        </tbody>
      </table>

      <p v-if="loading">Carregant sessions...</p>
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
  if (!date) return 'Data no disponible'
  return new Date(date).toLocaleDateString('ca-ES', { year: 'numeric', month: 'long', day: 'numeric' })
}

const formatTime = (time) => time || 'Hora no disponible'

const editSession = (session) => {
  console.log('Editar sessió:', session)
}

const viewDetails = (session) => {
  console.log('Veure detalls de la sessió:', session)
}
</script>

<style scoped>
.admin-layout {
  display: flex;
  height: 100vh;
}

.main-content {
  flex-grow: 1;
  padding: 20px;
  background-color: #f4f4f4;
}

h2 {
  margin-bottom: 15px;
  color: #0a4b96;
  border-bottom: 2px solid #0a4b96;
  padding-bottom: 10px;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 10px;
  background: white;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

th, td {
  border: 1px solid #ddd;
  padding: 12px;
  text-align: left;
}

th {
  background-color: #0a4b96;
  color: white;
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

.action-button:hover {
  background-color: #083b75;
}

.error {
  color: red;
}
</style>
