function request(method, url, argument = {}) {

    method = method.toUpperCase();

    let xhr = new XMLHttpRequest();

    xhr.open(method, url, true);

    return new Promise((resolve, reject) => {

        if (method != 'GET' && method != 'POST') {
            reject('Pas le bon format de requête');
        }

        if (method === 'POST') {
            //Envoie les informations du header adaptées avec la requête
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            let post = '';
            for (const key in argument) {
                if (post != '') {
                    post += `&`;
                }
                post += `${key}=${encodeURIComponent(argument[key])}`;
            }

            xhr.send(post);
        } else {
            xhr.send(null)
        }
        xhr.addEventListener('readystatechange', function () {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                resolve(xhr.responseText);
            }
        });
    });
}
