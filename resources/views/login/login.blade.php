<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- CSS - TailwindCSS --}}
    @vite('resources/css/app.css')
    {{-- JS - Priline.co --}}
    @vite('resources/js/app.js')
    {{-- ICON --}}
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <title>Login</title>
</head>

<body style="background-image: url('{{ asset('img/login-bg.jpg') }}'); background-position: bottom right, center; ">

    <div class="h-screen max-w-[55%] relative bg-white p-10 gap-3 overflow-hidden">
        <h1 class="text-4xl absolute top-32 left-0 right-0 font-semibold italic flex items-center justify-center">Login.</h1>
        <div class="w-full h-full flex justify-center items-center">
            <div class="w-full h-full flex flex-col justify-center gap-5">
                <img src="{{ asset('gif/user.gif') }}" class=" w-full flex justify-center items-center mx-auto rounded-xl shadow-md" alt="">
            </div>
    
            <div class="flex flex-col w-full justify-center px-5 mx-auto">
                <div class="max-w-full space-y-3 gap-7 flex flex-col">
                    @if (Session::get('success'))
                        <p class="text-md font-semibold text-green-600 mt-2"> - {{ Session::get('success') }}.</p>
                    @endif
                    @if (Session::get('failed'))
                        <p class="text-lg font-semibold text-red-600 mt-2"> - {{ Session::get('failed') }}.</p>
                    @endif
                    {{-- FORM LOGIN : Register --}}
                    <form action="" method="post" id="form-login">
                        @csrf
                        <div>
                            <div class="relative">
                                <input type="email" id="email" name="email" value="{{ old('email') }}" class="mb-3 py-3 px-4 ps-11 block w-full duration-200 border border-gray-100 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Masukan Email Anda">
                                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                    <i class="ph ph-user text-lg"></i>
                                </div>
                            </div>
                            @error('email')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                        <!-- Form Group -->
                        <div class="w-full">
                            <div class="relative">
                                <input id="hs-toggle-password" value="{{ old('password') }}" type="password" name="password" class="ps-11 duration-200 border border-gray-100 shadow-sm rounded-lg py-3 pe-10 block w-full text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Masukan password">
                                <i class="ph ph-key text-lg absolute inset-y-0 start-0 flex items-center ps-4"></i>
                                <button type="button" data-hs-toggle-password='{"target": "#hs-toggle-password" }' class="absolute inset-y-0 end-0 flex items-center justify-between z-20 px-3 cursor-pointer text-gray-400 rounded-e-md focus:outline-none focus:text-blue-600 ">
                                <i class="ph ph-eye hidden hs-password-active:block "></i>
                                <i class="ph ph-eye-slash hs-password-active:hidden"></i>
                              </button>
                            </div>
                        </div>
                            @error('password')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex gap-3 justify-center items-center mt-10 text-center">
                            <button type="submit" onclick="setAction('register')" class="font-poppins w-2/6 mx-auto  px-3 py-2 hover:text-white items-center gap-x-2 text-sm font-medium rounded-lg  border border-blue-500 text-black hover:bg-blue-600 focus:outline-none focus:bg-blue-700 duration-150 disabled:opacity-50 disabled:pointer-events-none">
                                Buat Akun 
                            </button>
                            <h3 class="font-semibold w-1/4 flex justify-center items-center gap-1">
                                <span class="text-black bg-gray-400 bg-opacity-50 w-1/2 h-1 rounded-full"></span>
                                <p class="text-black text-opacity-50">OR</p>
                                <span class="text-black bg-gray-400 bg-opacity-50 w-1/2 h-1 rounded-full"></span>
                            </h3>
                            <button type="submit" onclick="setAction('login')" class=" font-poppins w-2/6 mx-auto px-3 py-2  items-center gap-x-2 text-sm font-medium rounded-lg border border-blue-500 bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:bg-blue-700 duration-150 disabled:opacity-50 disabled:pointer-events-none">
                                Login.
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
        </div>
        </div>
    <script>
        function setAction(action) {
            document.getElementById('form-login').action = action === 'login' ? '{{ route('auth') }}' : '{{ route('register') }}';
        }
    </script>
</body>
</html>