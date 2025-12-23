/* Login */
function requestLogin(url, elements) {
    const { usernameInputId, loginButtonId, messageDisplayId } = elements;
    const loginButton = document.getElementById(loginButtonId);
    loginButton.addEventListener('click', async () => {
        try {
            const usernameInput = document.getElementById(usernameInputId);
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ username: usernameInput.value }),
            });
            const data = await response.json();
            document.getElementById(messageDisplayId).textContent = data.message;
        } catch (error) {
            console.error('Error during login:', error);
        }
    });
}