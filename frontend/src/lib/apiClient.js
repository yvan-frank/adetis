const BASE_URL = '/api';

async function request(path, options = {}) {
    // FormData (upload de fichier) doit repartir sans Content-Type explicite
    // — le navigateur fixe lui-même `multipart/form-data; boundary=...`,
    // qu'un header JSON manuel écraserait et casserait l'upload.
    const isFormData = options.body instanceof FormData;

    const res = await fetch(`${BASE_URL}${path}`, {
        credentials: 'include',
        ...options,
        headers: isFormData ? options.headers : { 'Content-Type': 'application/json', ...options.headers },
    });

    if (!res.ok) {
        const body = await res.json().catch(() => ({}));
        const error = new Error(body.error || `Erreur API ${res.status}`);
        error.status = res.status;
        error.fields = body.fields;
        throw error;
    }

    return res.json();
}

export const apiClient = {
    get: (path) => request(path),
    post: (path, data) => request(path, { method: 'POST', body: JSON.stringify(data) }),
    put: (path, data) => request(path, { method: 'PUT', body: JSON.stringify(data) }),
    delete: (path, data) => request(path, { method: 'DELETE', body: data !== undefined ? JSON.stringify(data) : undefined }),
    postForm: (path, formData) => request(path, { method: 'POST', body: formData }),
};
