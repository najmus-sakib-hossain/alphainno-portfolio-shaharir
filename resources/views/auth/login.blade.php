<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page - Shahriar</title>
    <!-- Load Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom styles for better aesthetics and focus states */
        body {
            background-image: url('https://i.imgur.com/K3pW1sS.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-color: rgba(0, 0, 0, 0.8);
            background-blend-mode: darken;
        }
        .login-card {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.5), 0 10px 10px -5px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease-in-out;
            background-color: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .login-card:hover {
            transform: translateY(-4px);
        }
        .login-card h1,
        .login-card label,
        .login-card p,
        .login-card input::placeholder,
        .login-card .text-gray-900 {
            color: #f3f4f6;
            text-shadow: 0px 0px 5px rgba(0,0,0,0.8);
        }
        .login-card .text-gray-500 {
            color: #d1d5db;
            text-shadow: 0px 0px 3px rgba(0,0,0,0.5);
        }
        .input-field {
            background-color: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.3);
            color: #f3f4f6;
        }
        .input-field:focus {
            border-color: #9CA3AF;
            box-shadow: 0 0 0 2px rgba(156, 163, 175, 0.5);
        }
        .error-message {
            color: #f87171;
            text-shadow: 0px 0px 3px rgba(0,0,0,0.5);
        }
    </style>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>
<body class="bg-gray-900 min-h-screen flex items-center justify-center font-sans p-4 transition-colors duration-300">
    <!-- Notification/Message Box -->
    <div id="messageBox" class="fixed top-0 left-1/2 -translate-x-1/2 p-4 mt-4 rounded-lg text-white opacity-0 transition-opacity duration-500 z-50 shadow-xl"></div>

    <!-- Login Card -->
    <div class="login-card w-full max-w-xs p-8 space-y-4 rounded-2xl transition-all duration-300">
        <!-- Avatar Section -->
        <div class="flex flex-col items-center">
            <img class="w-16 h-16 rounded-full border-4 border-gray-400 shadow-md object-cover"
                 src="https://placehold.co/80x80/1F2937/ffffff?text=U"
                 alt="User Avatar"
                 onerror="this.onerror=null; this.src='https://placehold.co/80x80/1F2937/ffffff?text=User'">
            <h1 class="mt-3 text-xl font-bold text-gray-900 transition-colors duration-300">Welcome Back</h1>
            <p class="text-gray-500 text-xs transition-colors duration-300">Login to continue to your account.</p>
        </div>

        <!-- Login Form -->
        <form id="loginForm" method="POST" action="{{ route('login') }}" class="space-y-3">
            @csrf

            <!-- Email Field -->
            <div>
                <label for="email" class="block text-xs font-medium text-gray-700 mb-1">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="you@example.com"
                       class="input-field w-full px-3 py-1.5 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400 text-sm">
                @error('email')
                    <p class="error-message text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Field with Toggle -->
            <div>
                <label for="password" class="block text-xs font-medium text-gray-700 mb-1">Password</label>
                <div class="relative">
                    <input type="password" id="password" name="password" required placeholder="********"
                           class="input-field w-full px-3 py-1.5 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400 text-sm pr-10">
                    <button type="button" id="passwordToggle"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none transition-colors duration-200">
                        <svg id="eyeIcon" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg id="eyeSlashIcon" class="w-4 h-4 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7a9.97 9.97 0 011.669.197m.793 4.137A3 3 0 1110 12m4.5 4.5L19.5 7.5" />
                        </svg>
                    </button>
                </div>
                @error('password')
                    <p class="error-message text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center text-xs">
                <input id="remember-me" name="remember" type="checkbox"
                       class="h-3 w-3 text-gray-400 rounded border-gray-300 focus:ring-gray-400">
                <label for="remember-me" class="ml-2 block text-gray-900">Remember me</label>
            </div>

            <!-- Sign In Button -->
            <button type="submit" id="signInButton"
                    class="w-full flex justify-center items-center py-1.5 px-3 border border-transparent rounded-lg shadow-sm text-sm font-light text-white bg-gray-900 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition-all duration-200 disabled:opacity-50">
                <span id="buttonText">Sign In</span>
                <svg id="loadingSpinner" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const loginForm = document.getElementById('loginForm');
            const signInButton = document.getElementById('signInButton');
            const buttonText = document.getElementById('buttonText');
            const loadingSpinner = document.getElementById('loadingSpinner');
            const messageBox = document.getElementById('messageBox');

            // Password Toggle elements
            const passwordInput = document.getElementById('password');
            const passwordToggle = document.getElementById('passwordToggle');
            const eyeIcon = document.getElementById('eyeIcon');
            const eyeSlashIcon = document.getElementById('eyeSlashIcon');

            // Password Toggle Logic
            passwordToggle.addEventListener('click', () => {
                const isPasswordVisible = passwordInput.type === 'password';
                passwordInput.type = isPasswordVisible ? 'text' : 'password';
                eyeIcon.classList.toggle('hidden');
                eyeSlashIcon.classList.toggle('hidden');
                passwordInput.focus();
            });

            // Message Box Logic
            function showMessage(message, type = 'success') {
                let bgColor = 'bg-green-500';
                if (type === 'error') {
                    bgColor = 'bg-red-500';
                } else if (type === 'info') {
                    bgColor = 'bg-blue-500';
                }
                messageBox.textContent = message;
                messageBox.className = `fixed top-0 left-1/2 -translate-x-1/2 p-4 mt-4 rounded-lg text-white opacity-100 transition-opacity duration-500 z-50 shadow-xl ${bgColor}`;
                setTimeout(() => {
                    messageBox.classList.remove('opacity-100');
                    messageBox.classList.add('opacity-0');
                }, 3000);
            }

            // Show Laravel session messages
            @if (session('status'))
                showMessage('{{ session('status') }}', 'success');
            @endif
            @if (session('error'))
                showMessage('{{ session('error') }}', 'error');
            @endif

            // Form Submission Logic
            loginForm.addEventListener('submit', (e) => {
                const email = document.getElementById('email').value.trim();
                const password = document.getElementById('password').value.trim();
                if (!email || !password) {
                    e.preventDefault();
                    showMessage('Please enter both email and password.', 'error');
                    return;
                }
                signInButton.disabled = true;
                buttonText.textContent = 'Processing...';
                loadingSpinner.classList.remove('hidden');
            });
        });
    </script>
</body>
</html>