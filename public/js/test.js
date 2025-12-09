const dataToSend = {
    username: "exampleUser",
    email: "user@example.com"
};

fetch("/characters", {
    method: "POST", // or 'PUT', 'PATCH'
    headers: {
        "Content-Type": "application/json"
    },
    body: JSON.stringify(dataToSend) // Convert the JavaScript object to a JSON string
})
    .then(response => response.json()) // Parse the JSON response
    .then(data => console.log("Success:", data))
    .catch(error => console.error("Error:", error));