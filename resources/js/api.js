export function getApiToken() {
  return document.cookie
    .split('; ')
    .find(row => row.startsWith('api_token='))
    ?.split('=')[1];
}

export async function apiFetch(url, options = {}) {
  const token = getApiToken();

  return fetch(url, {
    ...options,
    headers: {
      ...(options.headers || {}),
      'Authorization': `Bearer ${token}`,
      'Accept': 'application/json',
    }
  });
}
