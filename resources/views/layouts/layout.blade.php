<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- FAVICON --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon/favicon.ico') }}">
    {{-- SumberDaya CSS - TailwindCSS --}}
    @vite('resources/css/app.css')
    {{-- CDN Jquery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    {{-- SumberDaya JS - Priline.co --}}
    @vite('resources/js/app.js')
    {{-- ICON --}}
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <title>@yield('title')</title>
</head>

<body
    class="dark:bg-[#101110] [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-track]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500">

    {{-- CONTENT --}}
    <div class="container mx-auto py-5 ">
        @yield('content')
    </div>
    {{-- NAVIGASI --}}
    <div
        class="animate-bottom w-fit flex flex-col justify-between items-center py-5 my-2 mx-auto bottom-0 left-0 right-0 fixed">
        <div
            class="bg-white backdrop-blur-xl bg-opacity-90 border border-spacing-1 border-opacity-30  border-gray-200 px-2.5 py-2.5 rounded-full shadow-inner shadow-gray-300 dark:custom-shadow-3d dark:bg-black dark:border-gray-800">
            <div class="w-full flex justify-center items-center gap-5">
                {{-- Home --}}
                <div class="hs-tooltip inline-block">
                    <a href="{{ Auth::user()->role == 'guest' ? route('dashboard') : (Auth::user()->role == 'staff' ? route('staff.dashboard_staff') : route('head.dashboard_head')) }}"
                        type="button"
                        class="group hover:scale-105  dark:shadow-gray-950 shadow-gray-400  bg-gray-800 shadow-md  duration-300 hover:bg-gray-800  hs-tooltip-toggle size-10 inline-flex justify-center items-center rounded-full  text-gray-50 text-opacity-50 focus:outline-none focus:bg-emerald-600 hover:text-black focus:text-black ">
                        <i class="ph ph-house text-2xl group-hover:text-gray-100 group-hover:text-opacity-100"></i>
                        <span
                            class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block invisible z-10 py-2 px-4  bg-gray-800 text-xs font-medium text-white rounded shadow-md"
                            role="tooltip">
                            Home
                        </span>
                    </a>
                </div>
                @if (Auth::user()->role == 'guest')
                    {{-- MY REPORT --}}
                    <div class="hs-tooltip inline-block">
                        <a href="{{ route('report.report') }}" type="button"
                            class="group bg-gray-800 hover:scale-105 dark:shadow-gray-950 shadow-gray-400  shadow-md  duration-300 hover:bg-gray-600  hs-tooltip-toggle size-10 inline-flex justify-center items-center rounded-full  text-gray-50 text-opacity-50 focus:outline-none focus:bg-emerald-600 hover:text-black focus:text-black ">
                            <i
                                class="ph ph-warning text-2xl group-hover:text-gray-100 group-hover:text-opacity-100"></i>
                            <span
                                class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-2 px-4  bg-gray-800 text-xs font-medium text-white rounded shadow-md"
                                role="tooltip">
                                Pengaduan
                            </span>
                        </a>
                    </div>
                    {{-- BUAT REPORT --}}
                    <div class="hs-tooltip inline-block">
                        <a href="{{ route('report.create') }}" type="button"
                            class="group bg-gray-800 hover:scale-105 dark:shadow-gray-950 shadow-gray-400 shadow-md  duration-300 hover:bg-gray-600  hs-tooltip-toggle size-10 inline-flex justify-center items-center rounded-full  text-gray-50 text-opacity-50 focus:outline-none focus:bg-emerald-600 hover:text-black focus:text-black">
                            <i
                                class="ph ph-note-pencil text-2xl group-hover:text-gray-100 group-hover:text-opacity-100"></i>
                            <span
                                class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-2 px-4  bg-gray-800 text-xs font-medium text-white rounded shadow-md"
                                role="tooltip">
                                Buat laporan
                            </span>
                        </a>
                    </div>
                @endif
                {{-- ### --}}
                {{-- NAV KHUSUS HEADSTAFF --}}
                {{-- ### --}}
                @if (Auth::user()->role == 'head_staff')
                    <div class="hs-tooltip inline-block">
                        <a href="{{ route('head.chart') }}" type="button"
                            class="group bg-gray-800 hover:scale-105 shadow-gray-950  shadow-md  duration-300 hover:bg-gray-600  hs-tooltip-toggle size-10 inline-flex justify-center items-center rounded-full  text-gray-50 text-opacity-50 focus:outline-none focus:bg-emerald-600 hover:text-black focus:text-black">
                            <i
                                class="ph ph-chart-line text-2xl group-hover:text-gray-100 group-hover:text-opacity-100"></i>
                            <span
                                class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-2 px-4  bg-gray-800 text-xs font-medium text-white rounded shadow-md"
                                role="tooltip">
                                Chart
                            </span>
                        </a>
                    </div>
                @endif

                <button type="button"
                    class="hs-dark-mode-active:hidden block hs-dark-mode font-medium text-gray-800 rounded-full hover:bg-gray-200 focus:outline-none focus:bg-gray-200 dark:text-neutral-200 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                    data-hs-theme-click-value="dark">
                    <span class="group inline-flex shrink-0 justify-center items-center size-9">
                        <i class="ph ph-sun-dim text-2xl"></i>
                    </span>
                </button>
                <button type="button"
                    class="hs-dark-mode-active:block hidden hs-dark-mode font-medium text-gray-800 rounded-full hover:bg-gray-200 focus:outline-none focus:bg-gray-200 dark:text-neutral-200 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                    data-hs-theme-click-value="light">
                    <span class="group inline-flex shrink-0 justify-center items-center size-9">
                        <i class="ph ph-moon text-2xl"></i>
                    </span>
                </button>
            </div>
        </div>
    </div>

    <script>
        const navLinks = document.querySelectorAll('a');
        // Dapatkan URL saat ini
        const url = window.location.href;

        // Loop setiap link dan cek apakah URL-nya sesuai dengan URL saat ini
        navLinks.forEach(link => {
            if (link.href === url) {
                link.classList.add('bg-slate-500');
                link.classList.remove('text-opacity-50');
                link.classList.add('text-opacity-100');
                link.classList.remove('bg-gray-800');
                link.classList.remove('text-gray-950');
                link.classList.add('text-white');
            } else {
                link.classList.remove('bg-black');
            }
        });
        const html = document.querySelector('html');

        const isLightOrAuto = localStorage.getItem('hs_theme') === 'light' || (localStorage.getItem('hs_theme') ===
            'auto' && !window.matchMedia('(prefers-color-scheme: dark)').matches);
        const isDarkOrAuto = localStorage.getItem('hs_theme') === 'dark' || (localStorage.getItem('hs_theme') === 'auto' &&
            window.matchMedia('(prefers-color-scheme: dark)').matches);

        if (isLightOrAuto && html.classList.contains('dark')) html.classList.remove('dark');
        else if (isDarkOrAuto && html.classList.contains('light')) html.classList.remove('light');
        else if (isDarkOrAuto && !html.classList.contains('dark')) html.classList.add('dark');
        else if (isLightOrAuto && !html.classList.contains('light')) html.classList.add('light');
    </script>

    {{-- <script src="{{ asset('js/dark-mode.js') }}"></script> --}}

</body>

</html>
