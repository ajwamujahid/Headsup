
<!DOCTYPE html>
<html lang="en" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="Qb4QBb8wkVH42NKIX1QMX2k0Z0aAw0sZQwuQMSwO">

        <title>HeadsUp</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <link rel="preload" as="style" href="https://headsup.trevinosauto.com/build/assets/app-Crok822L.css" /><link rel="modulepreload" href="https://headsup.trevinosauto.com/build/assets/app-DeKemmCm.js" /><link rel="stylesheet" href="https://headsup.trevinosauto.com/build/assets/app-Crok822L.css" /><script type="module" src="https://headsup.trevinosauto.com/build/assets/app-DeKemmCm.js"></script>    </head>
    <body class="h-full bg-gray-50 font-sans antialiased">
        <div class="min-h-screen flex flex-col items-center justify-center p-4 sm:p-6">
            <div class="w-full max-w-md">
                <div class="bg-white border border-gray-200 rounded-xl shadow-md p-8">
                    <div class="flex flex-col items-center space-y-3 w-full mb-6">
        <h1 class="text-2xl font-bold tracking-tight text-gray-800">Headsup</h1>
        <p class="text-sm text-muted-foreground">Sign in to manage your headsup</p>
    </div>

    <!-- Session Status -->
    
    <div class="w-full">
       
            <form method="POST" action="{{ route('login.submit') }}" class="space-y-5">
                @csrf
            {{-- <input type="hidden" name="_token" value="Qb4QBb8wkVH42NKIX1QMX2k0Z0aAw0sZQwuQMSwO" autocomplete="off">
            <!-- Email Address --> --}}

            <div class="space-y-2">
                <label for="email" class="text-sm font-medium leading-none text-gray-700">Email Address</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                    </div>
                    <input
                        id="email"
                        class="flex h-12 w-full rounded-md border border-gray-300 bg-transparent pl-10 px-3 py-2 text-sm shadow-sm transition-colors placeholder:text-gray-400 focus:border-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400"
                        type="email"
                        name="email"
                        placeholder="admin@example.com"
                        value=""
                        required
                        autofocus
                        autocomplete="username"
                    />
                </div>
                            </div>

            <!-- Password -->
            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <label for="password" class="text-sm font-medium leading-none text-gray-700">Password</label>
                                            <a class="text-sm text-gray-700 hover:text-gray-900" href="#">
                            Forgot Password?
                        </a>
                                    </div>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    </div>
                    <input
                        id="password"
                        class="flex h-12 w-full rounded-md border border-gray-300 bg-transparent pl-10 px-3 py-2 text-sm shadow-sm transition-colors placeholder:text-gray-400 focus:border-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400"
                        type="password"
                        name="password"
                        placeholder="••••••"
                        required
                        autocomplete="current-password"
                    />
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" onclick="togglePasswordVisibility()"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                    </div>
                </div>
                            </div>

            <!-- Remember Me -->
            <div class="flex items-center space-x-2">
                <input 
                    id="remember_me" 
                    type="checkbox"
                    class="h-4 w-4 rounded border-gray-300 text-gray-600 focus:ring-gray-500"
                    name="remember"
                />
                <label for="remember_me" class="text-sm text-gray-600">Remember me</label>
            </div>

            <button type="submit" class="flex w-full items-center justify-center bg-gray-900 text-white font-medium h-12 px-5 rounded-md hover:bg-gray-800 mt-3 shadow-sm">
                <span>Sign In</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </button>

            <div class="mt-8 pt-6 border-t border-gray-200 text-center text-sm text-gray-500">
                <div class="flex justify-center items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/></svg>
                    <span>Protected by advanced security</span>
                </div>
                <div class="mt-1">Secure Login</div>
            </div>
        </form>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        }
    </script>
                </div>
            </div>
        </div>
    </body>
</html>
