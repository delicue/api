function handleRegisterForm(){
    const form = document.getElementById('registerForm');
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        console.log('Register button clicked');
        try {
            const formData = new FormData(form);
            const username = formData.get('username');
            const password = formData.get('password');
            const response = await fetch('/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ username, password })
            })
            const data = await response.json();
            console.log('Register response:', data);
            document.getElementById('messageDisplay').textContent = data.message;
            window.location.href = '/login';
        } catch (error) {
            console.error('Error during registration:', error);
        }
    });
}

handleRegisterForm();