class PayPeriodsService {
  async getPayPeriods() {
    const response = await fetch(
      `${useRuntimeConfig().public.apiUrl}/pay-periods`,
      {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          Authorization: `Bearer ${useCookie('corvesive_access_token').value}`,
        },
      }
    );
    return await response.json();
  }

  async getPayPeriod(payPeriodId) {
    const response = await fetch(
      `${useRuntimeConfig().public.apiUrl}/pay-periods/${payPeriodId}`,
      {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          Authorization: `Bearer ${useCookie('corvesive_access_token').value}`,
        },
      }
    );
    return await response.json();
  }

  async createPayPeriod(startDate, endDate) {
    const response = await fetch(
      `${useRuntimeConfig().public.apiUrl}/pay-periods`,
      {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          Authorization: `Bearer ${useCookie('corvesive_access_token').value}`,
        },
        body: JSON.stringify({
          start_date: startDate,
          end_date: endDate,
        }),
      }
    );
    return await response.json();
  }

  async updatePayPeriod(payPeriodId, startDate, endDate) {
    const response = await fetch(
      `${useRuntimeConfig().public.apiUrl}/pay-periods/${payPeriodId}`,
      {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          Authorization: `Bearer ${useCookie('corvesive_access_token').value}`,
        },
        body: JSON.stringify({
          start_date: startDate,
          end_date: endDate,
        }),
      }
    );
    return await response.json();
  }

  async deletePayPeriod(payPeriodId) {
    await fetch(
      `${useRuntimeConfig().public.apiUrl}/pay-periods/${payPeriodId}`,
      {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          Authorization: `Bearer ${useCookie('corvesive_access_token').value}`,
        },
      }
    );
  }

  async completePayPeriod(payPeriodId) {
    await fetch(
      `${useRuntimeConfig().public.apiUrl}/pay-periods/${payPeriodId}/complete`,
      {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          Authorization: `Bearer ${useCookie('corvesive_access_token').value}`,
        },
      }
    );
  }

  async incompletePayPeriod(payPeriodId) {
    await fetch(
      `${
        useRuntimeConfig().public.apiUrl
      }/pay-periods/${payPeriodId}/incomplete`,
      {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          Authorization: `Bearer ${useCookie('corvesive_access_token').value}`,
        },
      }
    );
  }

  async setPayPeriodToCurrent(payPeriodId) {
    const response = await fetch(
      `${useRuntimeConfig().public.apiUrl}/pay-periods/${payPeriodId}/current`,
      {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          Authorization: `Bearer ${useCookie('corvesive_access_token').value}`,
        },
      }
    );
    return await response.json();
  }
}

export default PayPeriodsService;
