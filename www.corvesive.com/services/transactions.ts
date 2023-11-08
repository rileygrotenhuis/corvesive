class TransactionsService {
  async getPayPeriodTransactions(payPeriodId: Number) {
    const response = await fetch(
      `${
        useRuntimeConfig().public.apiUrl
      }/pay-periods/${payPeriodId}/transactions`,
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

  async createBillTransaction(payPeriodId: Number, payPeriodBillId: Number) {
    const response = await fetch(
      `${
        useRuntimeConfig().public.apiUrl
      }/pay-periods/${payPeriodId}/bills/${payPeriodBillId}/transaction`,
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

  async createBudgetTransaction(
    payPeriodId: Number,
    payPeriodBudgetId: Number,
    amount: Number
  ) {
    const response = await fetch(
      `${
        useRuntimeConfig().public.apiUrl
      }/pay-periods/${payPeriodId}/budgets/${payPeriodBudgetId}/transaction`,
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

  async makePayPeriodDeposit(
    payPeriodId: Number,
    amount: Number,
    notes: String
  ) {
    const response = await fetch(
      `${useRuntimeConfig().public.apiUrl}/pay-periods/${payPeriodId}/deposit`,
      {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          Authorization: `Bearer ${useCookie('corvesive_access_token').value}`,
        },
        body: JSON.stringify({
          amount: amount * 100,
          notes: notes,
        }),
      }
    );
    return await response.json();
  }

  async updateTransaction(
    payPeriodId: Number,
    transactionId: Number,
    amount: Number,
    notes: String
  ) {
    const response = await fetch(
      `${
        useRuntimeConfig().public.apiUrl
      }/pay-periods/${payPeriodId}/transactions/${transactionId}`,
      {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          Authorization: `Bearer ${useCookie('corvesive_access_token').value}`,
        },
        body: JSON.stringify({
          amount: amount * 100,
          notes: notes,
        }),
      }
    );
    return await response.json();
  }

  async deleteTransaction(payPeriodId: Number, transactionId: Number) {
    const response = await fetch(
      `${
        useRuntimeConfig().public.apiUrl
      }/pay-periods/${payPeriodId}/transactions/${transactionId}`,
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
}

export default TransactionsService;
