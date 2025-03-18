import { useAuthStore } from '@/stores/auth';

export function useAuth() {
  const authStore = useAuthStore();

  return {
    token: authStore.token,
    user: authStore.user,
    register: authStore.register,
    login: authStore.login,
    logout: authStore.logout
  };
}
