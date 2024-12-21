<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <title>Landing Page</title>
</head>
<body style="background-image: url('{{ asset('img/login-bg.jpg') }}'); background-position: bottom right, center; ">

    <div class="h-screen max-w-[55%]  bg-white container p-7 flex justify-end items-center bg-opacity-10 backdrop-blur-xl">
        <div class="flex flex-col gap-2 bg-white text-black shadow-lg rounded-xl z-10 h-full justify-center px-10 mx-auto">
            <div class=" w-full">
                {{-- @if(Session::get('failed'))
                    <p>{{ Session::get('failed') }}</p>
                @enderror --}}
                <h1 class="font-medium text-5xl my-5 -mt-2 ">📣 Pengaduan Masyarakat.</h1>
                <img src="{{ asset('gif/Website.gif') }}" class="w-2/5 flex justify-center items-center shadow-sm rounded-md" alt="gif">
                <p class="w-[60%] font-light text-md my-2 max-md:text-sm">Web aspirasi dan pengaduan masyarakat adalah platform digital yang memfasilitasi warga untuk menyampaikan ide, aspirasi, atau pengaduan kepada pihak terkait, seperti pemerintah daerah, lembaga publik, atau organisasi tertentu. Web ini bertujuan untuk meningkatkan partisipasi masyarakat dalam pembangunan dan memberikan solusi terhadap berbagai permasalahan secara transparan dan efisien.</p>
            </div>
            <div>
                
                <a href="{{ route('login') }}" class=" font-poppins py-3 px-8 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent shadow-md bg-blue-500 text-white hover:bg-blue-800 focus:outline-none focus:bg-blue-700 duration-150 disabled:opacity-50 disabled:pointer-events-none">
                    Bergabung 🤝
                </a>
            </div>
        </div>
    </div>

</body>
</html>