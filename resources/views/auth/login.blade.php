<html dir="rtl" lang="en" class="h-full bg-white font-iran-sans">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @Vite(['resources/fonts/iran-sans/fontiran.css', 'resources/css/app.css'])
    <title>ورود به حساب کاربری</title>
</head>

<body class="h-full font-iran-sans">
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">ورود به حساب کاربری</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="{{ route('auth.login.form') }}" method="POST">
                @csrf
                <div>
                    <label for="email" class="block text-sm/6 font-medium text-gray-900">ادرس ایمیل</label>
                    <div class="mt-2">
                        <input type="email" name="email" id="email" autocomplete="email"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @error('email')
                            <span class="text-rose-400 text-sm block my-2">{{ $message }}</span>
                        @enderror
                        @session('email')
                            <span class="text-rose-400 text-sm block my-2">{{ $value }}</span>
                         @enderror
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm/6 font-medium text-gray-900">رمز عبور</label>
                    </div>
                    <div class="mt-2">
                        <input type="password" name="password" id="password" autocomplete="current-password"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @error('password')
                            <span class="text-rose-400 text-sm block my-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">ورود
                        
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>