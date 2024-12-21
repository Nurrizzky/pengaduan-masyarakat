@extends('layouts.layout')

@section('title')
    Staff
@endsection

@section('content')
    <header class="flex flex-wrap sm:justify-start sm:flex-nowrap mb-10 w-full bg-gray-300 rounded-full text-sm py-3">
        <nav class="max-w-[85rem] w-full mx-auto px-4 flex flex-wrap basis-full items-center justify-between">
            <a class="sm:order-1 flex-none text-xl font-semiboldfocus:outline-none focus:opacity-80">Pengaduan</a>
            <div class="sm:order-3 flex items-center gap-x-2">
                <a href="{{ route('logout') }}"
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                    <i class="ph ph-sign-out text-xl "></i>
                    Logout
                </a>
            </div>
        </nav>
    </header>

    @if (Session::get('success'))
        <div class="bg-teal-50 border-t-2 mb-10 border-teal-500 rounded-lg p-4" role="alert" tabindex="-1"
            aria-labelledby="hs-bordered-success-style-label">
            <div class="flex">
                <div class="shrink-0">
                    <!-- Icon -->
                    <span
                        class="inline-flex justify-center items-center size-8 rounded-full border-4 border-teal-100 bg-teal-200">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path>
                            <path d="m9 12 2 2 4-4"></path>
                        </svg>
                    </span>
                    <!-- End Icon -->
                </div>
                <div class="ms-3">
                    <h3 id="hs-bordered-success-style-label" class="text-gray-800 font-semibold ">
                        Successfully updated.
                    </h3>
                    <p class="text-sm text-gray-700 ">
                        You have successfully updated your response preferences.
                    </p>
                </div>
            </div>
        </div>
    @endif
    @if (Session::get('failed'))
        <div class="bg-red-50 border-s-4 border-red-500 p-4 mb-10" role="alert" tabindex="-1" aria-labelledby="hs-bordered-red-style-label">
        <div class="flex">
            <div class="shrink-0">
            <!-- Icon -->
            <span class="inline-flex justify-center items-center size-8 rounded-full border-4 border-red-100 bg-red-200 text-red-800">
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 6 6 18"></path>
                <path d="m6 6 12 12"></path>
                </svg>
            </span>
            <!-- End Icon -->
            </div>
            <div class="ms-3">
            <h3 id="hs-bordered-red-style-label" class="text-gray-800 font-semibold ">
                {{ Session::get('failed') }}
            </h3>
            <p class="text-sm text-gray-700 ">
                Your response has been declined.
            </p>
            </div>
        </div>
        </div>
    @endif

    <div class="w-full container mx-auto bg-white shadow-xl rounded-2xl overflow-hidden">
        <!-- Header Section -->
        <div class="w-full px-6 py-5 bg-gradient-to-r from-blue-500 to-purple-600 flex justify-between items-center">
            <h2 class="text-3xl font-bold text-white">Reports Dashboard</h2>
            <div class="flex space-x-4">
                <div class="relative">
                    <input type="text" placeholder="Search reports..."
                        class="pl-10 pr-4 py-2 w-64 rounded-lg bg-white/20 text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-3 text-white" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <div class="hs-dropdown relative inline-flex">
                    <button id="hs-dropdown-default"
                        class="hs-dropdown-toggle bg-white/20 text-white px-4 py-2 rounded-lg hover:bg-white/30 transition-colors flex items-center space-x-2"
                        aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Export (.xlsx)</span>
                    </button>
                    <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full"
                        role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-default">
                        <div class="p-1 space-y-0.5">
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                href="#">
                                seluruh Data
                            </a>
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                href="#">
                                Berdasarkan tanggal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="overflow-x-auto w-full">
            <table class="min-w-full">
                <thead class="bg-gray-100">
                    {{-- TH --}}
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Description</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase flex justify-center items-center gap-3 tracking-wider">
                            Jumlah Vote
                            <div>
                                <a href="{{ route('staff.voting_count', ['voting' => 'asc']) }}"
                                    class="bg-transparent cursor-pointer">
                                    <i class="ph ph-arrow-circle-up text-2xl text-black"></i>
                                </a>
                                <a href="{{ route('staff.voting_count', ['voting' => 'desc']) }}"
                                    class="bg-transparent cursor-pointer ">
                                    <i class="ph ph-arrow-circle-down text-2xl text-black"></i>
                                </a>
                            </div>
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                        </th>
                    </tr>
                </thead>
                @if ($reports->isEmpty())
                    <tbody>
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500">No reports found. 😇</td>
                        </tr>
                    </tbody>
                @endif

                <tbody class="divide-y divide-gray-200">
                    <!-- Repeat for each report -->
                    @foreach ($reports as $key => $value)
                        <tr class="hover:bg-gray-50 transition-colors group">
                            <td class="px-3 py-4 whitespace-nowrap">
                                {{ $key + 1 }}
                            </td>
                            <td class="px-3 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex flex-col justify-center gap-2 h-24 w-16">
                                        <img aria-haspopup="dialog" aria-expanded="false"
                                            aria-controls="hs-scale-animation-modal-{{ $value->id }}"
                                            data-hs-overlay="#hs-scale-animation-modal-{{ $value->id }}"
                                            class="w-full rounded-lg object-cover transform group-hover:scale-110 transition-transform"
                                            src="{{ asset('storage/' . $value->image) }}" alt="{{ $value->title }}">
                                    </div>
                                    {{-- Modal image --}}
                                    <div id="hs-scale-animation-modal-{{ $value->id }}"
                                        class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
                                        role="dialog" tabindex="-1"
                                        aria-labelledby="hs-scale-animation-modal-label-{{ $value->id }}">
                                        <div
                                            class=" fhs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
                                            <div
                                                class="w-full flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                                                <div
                                                    class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
                                                    <h3 id="hs-scale-animation-modal-label-{{ $value->id }}"
                                                        class="font-bold text-gray-800 dark:text-white">
                                                        {{ $value->title }}
                                                    </h3>
                                                    <button type="button"
                                                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                                                        aria-label="Close" data-hs-overlay="#hs-scale-animation-modal">
                                                        <span class="sr-only">Close</span>
                                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M18 6 6 18"></path>
                                                            <path d="m6 6 12 12"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                                <div class="p-4 overflow-y-auto">
                                                    <img src="{{ asset('storage/' . $value->image) }}"
                                                        class="rounded-md w-full mt-1 ">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-3 py-4 whitespace-nowrap">
                                {{ $value->user->email }}
                            </td>
                            <td class="text-sm px-3 py-4 whitespace-nowrap">
                                {{ $value->province }} /
                                {{ $value->regency }} /
                                {{ $value->village }}
                            </td>
                            <td class="px-3 py-4">
                                <div class="text-sm text-gray-500 truncate max-w-xs">
                                    {{ $value->description }}
                                </div>
                            </td>
                            <td class="px-3 py-4">
                                <div class="text-sm text-gray-500 truncate max-w-xs">
                                    {{ count($value->voting) }}
                                </div>
                            </td>
                            <td class="px-3 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="hs-dropdown relative inline-flex">
                                    <button type="button" onclick="followUp({{ $value->id }})"
                                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-gray-500 text-white hover:bg-gray-600 focus:outline-none focus:bg-gray-600 disabled:opacity-50 disabled:pointer-events-none"
                                        aria-haspopup="dialog" aria-expanded="false" aria-controls="follow_up"
                                        data-hs-overlay="#follow_up">
                                        Aksi
                                        <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="m6 9 6 6 6-6" />
                                        </svg>
                                    </button>

                                    {{-- DROPDOWNS ACTION --}}
                                    <div id="follow_up"
                                        class="hs-overlay hs-overlay-open:opacity-100 hs-overlay-open:duration-500 hidden size-full fixed top-0 start-0 z-[80] opacity-0 overflow-x-hidden transition-all overflow-y-auto pointer-events-none"
                                        role="dialog" tabindex="-1" aria-labelledby="follow_up-label">
                                        <div class="sm:max-w-lg sm:w-full m-3 sm:mx-auto">
                                            <div
                                                class="flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                                                <div
                                                    class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
                                                    <h3 id="follow_up-label"
                                                        class="font-bold text-gray-800 dark:text-white">
                                                        Tindak Lanjut
                                                    </h3>
                                                    <button type="button"
                                                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                                                        aria-label="Close" data-hs-overlay="#follow_up">
                                                        <span class="sr-only">Close</span>
                                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M18 6 6 18"></path>
                                                            <path d="m6 6 12 12"></path>
                                                        </svg>
                                                    </button>
                                                </div>

                                                {{-- Modal ACTION --}}
                                                <form action="" id="followUpForm" method="post">
                                                    @csrf
                                                    <div class="p-4 overflow-y-auto">
                                                        <label for="hs-select-label"
                                                            class="block text-sm font-medium mb-2 dark:text-white">Tanggapan</label>
                                                        <select id="hs-select-label" name="response"
                                                            class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                                            <option value="REJECT" selected>Tolak</option>
                                                            <option value="ON_PROSESS">Proses Penyelesaian/Perbaikan</option>
                                                        </select>
                                                    </div>
                                                    <div class="flex justify-end items-center gap-x-2 py-3 px-4">
                                                        <button type="button"
                                                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                                                            data-hs-overlay="#follow_up">
                                                            Batal
                                                        </button>
                                                        <button type="submit"
                                                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                                            Buat
                                                        </button>
                                                        
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>



        <script>
            function followUp(reportId) {
                let url = "{{ route('staff.followUp', ':id') }}";
                url = url.replace(':id', reportId);

                let form = document.getElementById('followUpForm');
                form.setAttribute('action', url);
            }
        </script>
    @endsection
