class PaystubsService {
  async getPaystubs() {
    const response = await fetch(`${useRuntimeConfig().public.apiUrl}/paystubs`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json',
        Authorization: `Bearer ${useCookie('corvesive_access_token').value}`
      }
    });
    return await response.json();
  }

  async createPaystub(issuer, amount, notes) {
    const response = await fetch(`${useRuntimeConfig().public.apiUrl}/paystubs`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json',
        Authorization: `Bearer ${useCookie('corvesive_access_token').value}`
      },
      body: JSON.stringify({
        issuer: issuer,
        amount: amount * 100,
        notes: notes
      })
    });
    return await response.json();
  }

  async updatePaystub(paystubId, issuer, amount, notes) {
    const response = await fetch(`${useRuntimeConfig().public.apiUrl}/paystubs/${paystubId}`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json',
        Authorization: `Bearer ${useCookie('corvesive_access_token').value}`
      },
      body: JSON.stringify({
        issuer: issuer,
        amount: amount * 100,
        notes: notes
      })
    });
    return await response.json();
  }

  async deletePaystub(paystubId) {
    await fetch(`${useRuntimeConfig().public.apiUrl}/paystubs/${paystubId}`, {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json',
        Authorization: `Bearer ${useCookie('corvesive_access_token').value}`
      }
    });
  }
}

export default PaystubsService;
