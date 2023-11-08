class AccountService {
  async me() {
    const response = await fetch(
      `${useRuntimeConfig().public.apiUrl}/account/me`,
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

  async updateAccount(firstName, lastName, email, phoneNumber) {
    const response = await fetch(
      `${useRuntimeConfig().public.apiUrl}/account`,
      {
        method: "PUT",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
          Authorization: `Bearer ${useCookie("corvesive_access_token").value}`,
        },
        body: JSON.stringify({
          first_name: firstName,
          last_name: lastName,
          email: email,
          phone_number: phoneNumber,
        }),
      },
    );
    return await response.json();
  }

  async onboard() {
    const response = await fetch(
      `${useRuntimeConfig().public.apiUrl}/account/onboard`,
      {
        method: "PUT",
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

export default AccountService;
