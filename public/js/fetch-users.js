// Fetch users from the API
function api(baseUri, queryParams = { key: '' }, { triggerElement, affectedElement, event }) {
    // 1. Define your base URL
    const baseUrl = 'https://api.example.com/data';

    // 2. Create an object containing your query parameters
    const params = {
        search: 'keyword',
        filter: 'category',
        sort: 'date'
    };

    // 3. Create a URLSearchParams object from your parameters
    const urlParams = new URLSearchParams(params);

    // 4. Combine the base URL with the stringified query parameters
    const apiUrl = `${baseUrl}?${urlParams.toString()}`;
    document.getElementById(triggerElement).addEventListener(event, async () => {
        const apiKey = document.getElementById(affectedElement).value;
        try {
            const response = await fetch(`/users?key=${encodeURIComponent(apiKey)}`, { 
            });
            const data = await response.json();
            document.getElementById('users-data').textContent = JSON.stringify(data, null, 2);
        } catch (error) {
            console.error('Error fetching users:', error);
        }
    });
}

api('/users', {
    key:
})