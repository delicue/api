/* Login */
function handleLoginForm(elements = { usernameInputId, passwordInputId, formdId, messageDisplayId }) {
    const { usernameInputId, passwordInputId, formId, messageDisplayId } = elements;
    const form = document.getElementById(formId);

    console.log('Login form handler initialized with elements:', elements);
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        console.log('Login button clicked');
        try {
            const usernameInput = document.getElementById(usernameInputId);
            const passwordInput = document.getElementById(passwordInputId);
            console.log('Username:', usernameInput.value);
            console.log('Password:', passwordInput.value);
            const response = await fetch('login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ username: usernameInput.value, password: passwordInput.value }),
            });
            const data = await response.json();
            console.log('Login response:', data);
            document.getElementById(messageDisplayId).textContent = data.message;
        } catch (error) {
            console.error('Error during login:', error);
        }
    });
}

const loginElements = {
    usernameInputId: 'username',
    passwordInputId: 'password',
    formId: 'loginForm',
    messageDisplayId: 'messageDisplay',
};

handleLoginForm(loginElements);