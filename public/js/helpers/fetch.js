async function getFetchPromise(csrf, url, value = '') {

    let message = {
        value : value,
        '_token': csrf // добавляем CSRF токен
    };
    return fetch(url,
        {
            headers: {
                'Content-Type': 'application/json'
            },
            method: 'POST',
            body: JSON.stringify(message),
        }
    )  // return this promise

    .then(response => response.json())

}

