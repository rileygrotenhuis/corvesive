export async function setAccessToken(token: string): Promise<string> {
  return new Promise((resolve) => {
    useCookie('corvesive_access_token').value = token;
    resolve(token);
  });
}
