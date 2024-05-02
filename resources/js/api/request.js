export default async function (uri, body = {}) {
    const headers = {
        Accept: 'application/json',
        'Content-Type': 'application/json;charset=utf-8',
    }

    const data = {
        method: 'post',
        headers,
        body: body ? JSON.stringify(body) : '',
    }

    return await fetch(uri, data).then(response => response.json())
}
