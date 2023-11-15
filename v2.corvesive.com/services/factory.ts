class HttpFactory {
  async call<T>(method: string, url: string, data?: object) {
    const response = await fetch(
      `${useNuxtApp().$config.public.apiUrl + url}`,
      {
        method: method,
        headers: {
          Accept: 'application/json',
          'Content-Type': 'application/json',
          Authorization: `Bearer ${useCookie('corvesive_access_token').value}`,
        },
        body: JSON.stringify(data),
      }
    );

    if (response.status !== 204) {
      return await response.json();
    }
  }
}

export default HttpFactory;
