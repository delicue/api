<?php partial('header'); ?>

<div class="container mx-auto flex items-center justify-center py-16 px-4">
    <div class="w-full max-w-md bg-slate-800/60 backdrop-blur rounded-lg border border-slate-700 p-8 shadow-lg">
        <h2 class="text-2xl font-semibold text-white mb-2 text-center">Welcome</h2>
        <p class="text-slate-300 text-sm mb-6 text-center">Create an account</p>

        <?php if (isset($error)): ?>
            <div class="mb-4 text-red-200 bg-red-600/20 border border-red-500 rounded p-2"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form id="loginForm" action="POST" class="space-y-4">
            <div>
                <label for="username" class="block text-sm font-medium text-slate-200 mb-1">Username</label>
                <input type="text" id="username" name="username" autocomplete="username" required class="w-full px-4 py-2 rounded-lg bg-slate-700 text-slate-100 border border-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-slate-200 mb-1">Password</label>
                <input type="password" id="password" name="password" autocomplete="current-password" required class="w-full px-4 py-2 rounded-lg bg-slate-700 text-slate-100 border border-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div class="flex items-center justify-between">
                <label class="flex items-center text-sm text-slate-300"><input type="checkbox" name="remember" class="mr-2">&nbsp;Remember me</label>
                <a href="/forgot" class="text-sm text-blue-400 hover:underline">Forgot?</a>
            </div>
            <div id="messageDisplay" class="text-sm text-red-400"></div>
            <input id="loginButton" type="submit" class="w-full mx-auto cursor-pointer py-2 bg-blue-600 hover:bg-blue-700 rounded-lg font-semibold transition" value="Log In" />
        </form>

        <p class="mt-4 text-center text-sm text-slate-400">No account? <a href="/register" class="text-emerald-400 hover:underline">Create one</a></p>
    </div>
</div>

<script src="js/register.js"></script>

<?php partial('footer'); ?>