class BillsService {
  async getBills() {
    const response = await fetch(`${useRuntimeConfig().public.apiUrl}/bills`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json',
        Authorization: `Bearer ${useCookie('corvesive_access_token').value}`,
      },
    });
    return await response.json();
  }

  async createBill(issuer, name, amount, dueDate, notes) {
    const response = await fetch(`${useRuntimeConfig().public.apiUrl}/bills`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json',
        Authorization: `Bearer ${useCookie('corvesive_access_token').value}`,
      },
      body: JSON.stringify({
        issuer: issuer,
        name: name,
        amount: amount * 100,
        due_date: dueDate,
        notes: notes,
      }),
    });
    return await response.json();
  }

  async updateBill(billId, issuer, name, amount, dueDate, notes) {
    const response = await fetch(
      `${useRuntimeConfig().public.apiUrl}/bills/${billId}`,
      {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          Authorization: `Bearer ${useCookie('corvesive_access_token').value}`,
        },
        body: JSON.stringify({
          issuer: issuer,
          name: name,
          amount: amount * 100,
          due_date: dueDate,
          notes: notes,
        }),
      }
    );
    return await response.json();
  }

  async deleteBill(billId) {
    await fetch(`${useRuntimeConfig().public.apiUrl}/bills/${billId}`, {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json',
        Authorization: `Bearer ${useCookie('corvesive_access_token').value}`,
      },
    });
  }
}

export default BillsService;
