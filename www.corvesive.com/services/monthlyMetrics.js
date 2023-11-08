class MonthlyMetricsService {
  async getMonthlyMetrics() {
    const response = await fetch(
      `${useRuntimeConfig().public.apiUrl}/monthly/metrics`,
      {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
          Authorization: `Bearer ${useCookie("corvesive_access_token").value}`,
        },
      },
    );
    return await response.json();
  }
}

export default MonthlyMetricsService;
