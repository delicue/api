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

function login() {
    const loginForm = document.getElementById('loginForm');
    if (!loginForm) return;
    
    loginForm.addEventListener('submit', async (event) => {
        // Prevent default form submission behavior
        event.preventDefault();

        try {
            const usernameInput = document.getElementById('username');
            const passwordInput = document.getElementById('password');
            
            if (!usernameInput.value || !passwordInput.value) {
                console.error('Username and password are required');
                return;
            }
            
            const response = await fetch('/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `username=${encodeURIComponent(usernameInput.value)}&password=${encodeURIComponent(passwordInput.value)}`,
            });
            if (response.redirected) {
                window.location.href = response.url;
            } else {
                const data = await response.text();
                console.log('Login failed:', data);
            }
        } catch (error) {
            console.error('Error during login:', error);
        }
    });
}

document.addEventListener('DOMContentLoaded', login);

fetchApi(`/users`, 'fetch-users', 'click', 'users-data');
fetchApi('/posts', 'fetch-posts', 'click', 'posts-data');
requestApiKey('/request-api-key', 'request-api-key', 'click', 'api-key-response');