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
    <header class="bg-slate-800/50 backdrop-blur-sm border-b border-slate-700 sticky top-0 z-50 flex place-content-between">
        <div class="container mx-auto px-6 py-4">
            <h1 class="text-3xl font-bold bg-linear-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent"><a href="/">API Request Manager</a></h1>
            <p class="text-slate-400 text-sm mt-1">Manage your API keys and fetch data effortlessly</p>
        </div>
        <!-- Login and Register buttons. On right side of screen -->
        <div class="absolute top-4 right-6 flex gap-4 space-x-4 container">
            <?php if (App\Session::isLoggedIn()): ?>
                <p class="text-slate-400 text-sm text-center mb-2">Logged in as <span class="font-semibold text-slate-200"><?= htmlspecialchars(App\Session::getUser()['username']) ?></span></p>
                <form method="POST" action="/logout" class="absolute top-4 right-6">
                    <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-colors">Logout</button>
                </form>
            <?php else: ?>
                <a href="/login" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">Login</a>
                <a href="/register" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-colors">Register</a>
            <?php endif; ?>
        </div>
    </header>

    <nav class="bg-slate-800/50 backdrop-blur-sm border-b border-slate-700">
        <div class="container mx-auto px-6 py-3 grid sm:grid-cols-2 gap-4 place-items-center">
            <a href="/" class="text-slate-600 hover:text-white font-medium transition-colors" type="button">Home</a>
            <a href="/test" class="text-slate-300 hover:text-white font-medium transition-colors" type="button">Test Page</a>
        </div>
    </nav>