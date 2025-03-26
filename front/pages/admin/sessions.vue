<template>
  <div>
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
          <td>54%</td> <!-- Aquí puedes cambiarlo si tienes datos reales de ocupación -->
          <td>
            <button @click="editSession(session)">Editar</button>
            <button @click="viewDetails(session)">Detalles</button>
          </td>
        </tr>
      </tbody>
    </table>

    <p v-if="loading">Cargando sesiones...</p>
    <p v-if="error" class="error">{{ error }}</p>
  </div>
</template>

<script>
import { onMounted } from 'vue'
import { useSessionStore } from '@/stores/sessions'

export default {
  setup() {
    const sessionStore = useSessionStore()
    const { sessions, loading, error, fetchAllSessions } = sessionStore

    onMounted(() => {
      fetchAllSessions()
    })

    const formatDate = (date) => {
      if (!date) return 'Fecha no disponible'
      return new Date(date).toLocaleDateString('es-ES', { year: 'numeric', month: 'long', day: 'numeric' })
    }

    const formatTime = (time) => {
      if (!time) return 'Hora no disponible'
      return time // Ya viene en formato "HH:MM"
    }

    const editSession = (session) => {
      console.log('Editar sesión:', session)
      // Aquí puedes implementar la lógica para editar la sesión
    }

    const viewDetails = (session) => {
      console.log('Ver detalles de sesión:', session)
      // Implementa la lógica para ver detalles de la sesión
    }

    return {
      sessions,
      loading,
      error,
      formatDate,
      formatTime,
      editSession,
      viewDetails
    }
  }
}
</script>

<style scoped>
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

.error {
  color: red;
}
</style>


<style scoped>
.admin-layout { display: flex; height: 100vh; }
.sidebar { width: 250px; background-color: #0a4b96; color: white; padding: 20px; }
.sidebar-menu a.active { background-color: rgba(255, 255, 255, 0.2); }
.main-content { flex-grow: 1; padding: 20px; background-color: #f4f4f4; }
.button-primary { background-color: #0a4b96; color: white; border: none; padding: 10px; border-radius: 5px; cursor: pointer; }
.sessions-table table { width: 100%; border-collapse: collapse; }
.session-actions { display: flex; gap: 10px; }
</style>
