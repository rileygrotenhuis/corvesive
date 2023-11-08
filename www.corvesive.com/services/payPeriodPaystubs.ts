class PayPeriodPaystubsService {
  async getPayPeriodPaystub(payPeriodId: Number) {
    const response = await fetch(
      `${useRuntimeConfig().public.apiUrl}/pay-periods/${payPeriodId}/paystubs`,
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

  async attachPaystubToPayPeriod(
    payPeriodId: Number,
    paystubId: Number,
    amount: Number
  ) {
    const response = await fetch(
      `${
        useRuntimeConfig().public.apiUrl
      }/pay-periods/${payPeriodId}/paystubs/${paystubId}`,
      {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          Authorization: `Bearer ${useCookie('corvesive_access_token').value}`,
        },
        body: JSON.stringify({
          amount: amount * 100,
        }),
      }
    );
    return await response.json();
  }

  async updatePayPeriodPaystub(
    payPeriodId: Number,
    paystubId: Number,
    amount: Number
  ) {
    const response = await fetch(
      `${
        useRuntimeConfig().public.apiUrl
      }/pay-periods/${payPeriodId}/paystubs/${paystubId}`,
      {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          Authorization: `Bearer ${useCookie('corvesive_access_token').value}`,
        },
        body: JSON.stringify({
          amount: amount * 100,
        }),
      }
    );
    return await response.json();
  }

  async detachPaystubFromPayPeriod(payPeriodId: Number, paystubId: Number) {
    const response = await fetch(
      `${
        useRuntimeConfig().public.apiUrl
      }/pay-periods/${payPeriodId}/paystubs/${paystubId}`,
      {
        method: 'DELETE',
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

export default PayPeriodPaystubsService;
