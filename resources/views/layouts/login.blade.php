<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            .button-login{
                background: #30CAEE !important;
            }
        </style>
    </head>
    <body class="bg-gray-100 flex items-center justify-center h-screen">

        <div class="w-full flex flex-col justify-center items-center max-w-md bg-white rounded-lg shadow-lg p-8">
            <!-- <h2 class="text-2xl font-bold mb-6 text-center">Login</h2> -->
            <img src="{{asset('assets/img/logo.png')}}" alt="" class="h-32">

            @if ($errors->has('email'))
                <p class="text-red-500 text-sm mt-1">{{ $errors->first('email') }}</p>
            @endif


            <form class="w-full" method="POST" action="{{ route('login.post') }}">
                @csrf

                <div class="mb-4 w-full">
                    <label for="email" class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" name="email" id="email" value="{{old('email')}}" required  class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-400">
                </div>

                <div class="mb-4 relative">
                    <label for="password" class="block text-sm font-medium mb-1">Password</label>

                    <input type="password" name="password" id="password" required
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-400 pr-10">

                    <button type="button" id="togglePassword" class="absolute right-2 top-9 text-gray-600 hover:text-black">
                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>


                <button type="submit"
                    class="w-full button-login hover:button-login text-white font-semibold py-2 px-4 rounded transition">
                    Login
                </button>
            </form>
        </div>

        <script>
            const togglePassword = document.querySelector('#togglePassword');
            const passwordField = document.querySelector('#password');
            const eyeIcon = document.querySelector('#eyeIcon');

            togglePassword.addEventListener('click', function () {
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);

                // Ganti ikon (eye / eye-off)
                eyeIcon.innerHTML = type === 'password'
                    ? `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`
                    : `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.975 9.975 0 012.803-4.362M6.423 6.423A9.955 9.955 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.958 9.958 0 01-4.338 5.036M3 3l18 18" />`;
            });
        </script>

    </body>
</html>
