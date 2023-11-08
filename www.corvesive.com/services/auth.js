class AuthService {
  async register(firstName, lastName, email, phoneNumber, password, passwordConfirmation) {
    const response = await fetch(`${useRuntimeConfig().public.apiUrl}/register`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json'
      },
      body: JSON.stringify({
        first_name: firstName,
        last_name: lastName,
        email: email,
        phone_number: phoneNumber,
        password: password,
        password_confirmation: passwordConfirmation
      })
    });
    return await response.json();
  }

  async login(email, password) {
    const response = await fetch(`${useRuntimeConfig().public.apiUrl}/login`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json'
      },
      body: JSON.stringify({
        email: email,
        password: password
      })
    });
    return await response.json();
  }

  async logout() {
    await fetch(`${useRuntimeConfig().public.apiUrl}/logout`, {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json',
        Authorization: `Bearer ${useCookie('corvesive_access_token').value}`
      }
    });
  }
}

export default AuthService;
