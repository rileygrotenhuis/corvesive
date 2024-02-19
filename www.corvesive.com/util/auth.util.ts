export async function setAccessToken(token: string): Promise<string> {
  return new Promise((resolve) => {
    useCookie('corvesive_access_token', {
      maxAge: 60 * 60 * 24 * 7,
      path: '/',
    }).value = token;
    resolve(token);
  });
}
