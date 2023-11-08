class PayPeriodBillsService {
  async getPayPeriodBills(payPeriodId) {
    const response = await fetch(
      `${useRuntimeConfig().public.apiUrl}/pay-periods/${payPeriodId}/bills`,
      {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          Authorization: `Bearer ${useCookie('corvesive_access_token').value}`
        }
      }
    );
    return await response.json();
  }

  async attachBillToPayPeriod(payPeriodId, billId, amount, dueDate) {
    const response = await fetch(
      `${useRuntimeConfig().public.apiUrl}/pay-periods/${payPeriodId}/bills/${billId}`,
      {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          Authorization: `Bearer ${useCookie('corvesive_access_token').value}`
        },
        body: JSON.stringify({
          amount: amount * 100,
          due_date: dueDate
        })
      }
    );
    return await response.json();
  }

  async updatePayPeriodBill(payPeriodId, billId, amount, dueDate) {
    const response = await fetch(
      `${useRuntimeConfig().public.apiUrl}/pay-periods/${payPeriodId}/bills/${billId}`,
      {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          Authorization: `Bearer ${useCookie('corvesive_access_token').value}`
        },
        body: JSON.stringify({
          amount: amount * 100,
          due_date: dueDate
        })
      }
    );
    return await response.json();
  }

  async detachBillFromPayPeriod(payPeriodId, billId) {
    const response = await fetch(
      `${useRuntimeConfig().public.apiUrl}/pay-periods/${payPeriodId}/bills/${billId}`,
      {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          Authorization: `Bearer ${useCookie('corvesive_access_token').value}`
        }
      }
    );
    return await response.json();
  }
}

export default PayPeriodBillsService;
