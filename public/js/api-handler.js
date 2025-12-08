function fetchApi(url, triggerElementId, event, targetElementId) {
    const triggerElement = document.getElementById(triggerElementId);
    triggerElement.addEventListener(event, async () => {
        try {
            // Get the API key from the input field
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
// fetchApi('/request-api-key', 'request-api-key', 'click', 'api-key-response');

/* Request API Key */
function requestApiKey(url, triggerElementId, event, targetElementId) {
    const triggerElement = document.getElementById(triggerElementId);
    triggerElement.addEventListener(event, async () => {
        try {
            const response = await fetch(url, {
                method: 'POST',
            });
            const data = await response.text();
            console.log(data);
            document.getElementById(targetElementId).textContent = data;
        } catch (error) {
            console.error('Error requesting API key:', error);
        }
    });
}

requestApiKey('/request-api-key', 'request-api-key', 'click', 'api-key-response');