<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request API Key</title>
    <link href="./css/main.css" rel="stylesheet">
</head>
<body class="place-items-center">
    <h1>Welcome to the API Request Page</h1>
    <p>Use the buttons below to fetch data from the API.</p>

    <div class="container mx-auto">
        <h2>Request API Key</h2>
        <button id="request-api-key">Request API Key</button>
        <!-- Enter your API key -->
        <div>
            <label for="api-key">API Key:</label>
            <input type="text" id="api-key" placeholder="Enter your API key here">
        </div>

        <!-- Buttons to fetch data -->
        <button id="fetch-users">Fetch Users</button>
        <button id="fetch-posts">Fetch Posts</button>
        
        <!-- Display Areas -->
        <div id="users-display">
            <h2>Users</h2>
            <pre id="users-data"></pre>
        </div>
        <div id="posts-display">
            <h2>Posts</h2>
            <pre id="posts-data"></pre>
        </div>
    </div>
    <!-- Show One User using a template -->
    <!-- <template id="user-data">
        <h2>User Data</h2>
        <div id="user-info">
            <div id="user-id"></div>
            <div id="user-name"></div>
            <div id="user-email"></div>
        </div>
    </template> -->
    <!-- Scripts -->
    <script src="js/api.js"></script>
    <script src="js/fetch-users.js" async></script>
    <script src="js/fetch-posts.js" async></script>
</body>
</html>