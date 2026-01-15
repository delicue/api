/* Login */
function handleLoginForm() {
    const form = document.getElementById('loginForm');
    // const formData = new FormData(form);
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        console.log('Login button clicked');
        try {
            // const username = formData.get('username');
            // const password = formData.get('password');
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const messageDisplayId = 'messageDisplay';
            console.log('Username:', username);
            console.log('Password:', password);
            const response = await fetch('login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ username: username, password: password }),
            });
            const data = await response.json();
            console.log('Login response:', data);
            document.getElementById(messageDisplayId).textContent = data.message;
            window.location.href = '/';
        } catch (error) {
            console.error('Error during login:', error);
        }
    });
}

handleLoginForm();