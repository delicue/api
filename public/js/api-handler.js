function fetchApi(url, triggerElementId, event, targetElementId) {
    const triggerElement = document.getElementById(triggerElementId);
    triggerElement.addEventListener(event, async () => {
        try {
            const apiKeyInput = document.getElementById('api-key');
            console.log(encodeURI(apiKeyInput.value));
            const response = await fetch(encodeURI(`${url}?apiKey=${apiKeyInput.value}`));
            const data = await response.json();
            document.getElementById(targetElementId).textContent = JSON.stringify(data, null, 4);
        } catch (error) {
            console.error('Error fetching users:', error);
        }
    });
}

fetchApi(`/users`, 'fetch-users', 'click', 'users-data');
fetchApi('/posts', 'fetch-posts', 'click', 'posts-data');
fetchApi('/request-api-key', 'request-api-key', 'click', 'api-key-response');