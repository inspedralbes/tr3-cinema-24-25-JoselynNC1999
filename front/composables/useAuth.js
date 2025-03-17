export function useAuth() {
    const token = useCookie('token'); // Guardar el token en una cookie
  
    const register = async (user) => {
      try {
        const response = await $fetch('http://127.0.0.1:8000/api/register', {
          method: 'POST',
          body: user
        });
        token.value = response.token;
        return response;
      } catch (error) {
        console.error(error);
        throw error;
      }
    };
  
    const login = async (credentials) => {
      try {
        const response = await $fetch('http://127.0.0.1:8000/api/login', {
          method: 'POST',
          body: credentials
        });
        token.value = response.token;
        return response;
      } catch (error) {
        console.error(error);
        throw error;
      }
    };
  
    const logout = async () => {
      try {
        await $fetch('http://127.0.0.1:8000/api/logout', {
          method: 'POST',
          headers: { Authorization: `Bearer ${token.value}` }
        });
        token.value = null;
      } catch (error) {
        console.error(error);
      }
    };
  
    return { token, register, login, logout };
  }
  