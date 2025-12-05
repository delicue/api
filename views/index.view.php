<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Request Manager</title>
    <link href="./css/main.css" rel="stylesheet">
</head>
<body class="bg-linear-to-br from-slate-900 via-slate-800 to-slate-900 min-h-screen text-slate-100">
    <!-- Navigation Header -->
    <header class="bg-slate-800/50 backdrop-blur-sm border-b border-slate-700 sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4">
            <h1 class="text-3xl font-bold bg-linear-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent">API Request Manager</h1>
            <p class="text-slate-400 text-sm mt-1">Manage your API keys and fetch data effortlessly</p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-12">
        <!-- API Key Section -->
        <section class="bg-slate-800 rounded-lg border border-slate-700 p-8 mb-8 shadow-xl hover:shadow-2xl transition-shadow">
            <div class="sm:flex sm:items-center sm:justify-between mb-6">
                <h2 class="text-2xl font-bold text-white mb-2 sm:mb-0">API Key Management</h2>
                <span class="px-3 py-1 bg-blue-500/20 border border-blue-500/50 rounded-full text-blue-300 text-sm font-medium">Authentication</span>
            </div>
            
            <div class="space-y-4">
                <button id="request-api-key" type="button" class="w-full cursor-grab bg-linear-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white font-semibold py-3 rounded-lg transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-slate-800">
                    Generate New API Key
                </button>

                <!-- API Key Display -->
                <pre id="api-key-response" class="bg-slate-700 rounded-lg border border-slate-600 p-4 text-slate-100 overflow-x-auto max-h-40"></pre>
                
                <div class="space-y-2">
                    <label for="api-key" class="block text-sm font-medium text-slate-300">Your API Key</label>
                    <input type="text" id="api-key" placeholder="Your API key will appear here..." class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                </div>
            </div>
        </section>

        <!-- Data Fetch Section -->
        <section class="mb-8">
            <h2 class="text-2xl font-bold text-white mb-6">Fetch Data</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Fetch Users Button -->
                <button id="fetch-users" class="group bg-linear-to-br from-emerald-600 to-emerald-500 hover:from-emerald-700 hover:to-emerald-600 text-white font-semibold py-4 rounded-lg transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 focus:ring-offset-slate-800 shadow-lg hover:shadow-emerald-500/20">
                    <span class="text-lg">👥 Fetch Users</span>
                </button>
                
                <!-- Fetch Posts Button -->
                <button id="fetch-posts" class="group bg-linear-to-br from-purple-600 to-purple-500 hover:from-purple-700 hover:to-purple-600 text-white font-semibold py-4 rounded-lg transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-slate-800 shadow-lg hover:shadow-purple-500/20">
                    <span class="text-lg">📝 Fetch Posts</span>
                </button>
            </div>
        </section>

        <!-- Display Areas -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Users Display -->
            <div id="users-display" class="bg-slate-800 rounded-lg border border-slate-700 p-6 shadow-xl overflow-hidden">
                <div class="flex items-center gap-2 mb-4 pb-4 border-b border-slate-700">
                    <span class="text-2xl">👥</span>
                    <h3 class="text-xl font-bold text-white">Users</h3>
                </div>
                <pre id="users-data" class="bg-slate-900 rounded p-4 text-sm text-emerald-400 font-mono overflow-auto max-h-96 border border-slate-700">Waiting for data...</pre>
            </div>

            <!-- Posts Display -->
            <div id="posts-display" class="bg-slate-800 rounded-lg border border-slate-700 p-6 shadow-xl overflow-hidden">
                <div class="flex items-center gap-2 mb-4 pb-4 border-b border-slate-700">
                    <span class="text-2xl">📝</span>
                    <h3 class="text-xl font-bold text-white">Posts</h3>
                </div>
                <pre id="posts-data" class="bg-slate-900 rounded p-4 text-sm text-purple-400 font-mono overflow-auto max-h-96 border border-slate-700">Waiting for data...</pre>
            </div>
        </div>
    </main>

    <!-- Scripts -->
    <script src="js/api-handler.js"></script>
</body>
</html>