/* Login */
function requestLogin(url, elements = { usernameInputId, passwordInputId, loginButtonId, messageDisplayId }) {

    const { usernameInputId, passwordInputId, loginButtonId, messageDisplayId } = elements;
    const loginButton = document.getElementById(loginButtonId);
    
    loginButton.addEventListener('click', async () => {
        try {
            const usernameInput = document.getElementById(usernameInputId);
            const passwordInput = document.getElementById(passwordInputId);
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ username: usernameInput.value, password: passwordInput.value }),
            });
            const data = await response.json();
            document.getElementById(messageDisplayId).textContent = data.message;
        } catch (error) {
            console.error('Error during login:', error);
        }
    });
}

const loginElements = {
    usernameInputId: 'username',
    passwordInputId: 'password',
    loginButtonId: 'loginButton',
    messageDisplayId: 'messageDisplay',
};

requestLogin('/login', loginElements);