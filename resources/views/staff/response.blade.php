@extends('layouts.layout')

@section('title')
    Respone
@endsection

@section('content')
    <header class="flex flex-wrap sticky top-2 left-0 right-0 mx-auto shadow-inner px-2 sm:justify-start sm:flex-nowrap mb-10 w-2/3 bg-gray-300 rounded-full text-sm py-3">
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

    <div class="container mx-auto px-4 py-8 mt-2">
        <div class="flex flex-col lg:flex-row gap-8 items-start">
            <!-- Report Card Section -->
            <div class="lg:w-3/5">
                <div class="bg-gradient-to-br from-white to-gray-50 p-8 rounded-3xl shadow-2xl hover:shadow-3xl transition-all duration-500">
                    <div class="flex flex-col gap-8">
                        <!-- Image Section -->
                        <div class="relative group">
                            <div class="overflow-hidden rounded-2xl aspect-[16/9]">
                                <img 
                                    src="{{ asset('storage/' . $reports->image) }}" 
                                    alt="Report Cover" 
                                    class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700"
                                >
                            </div>
                            
                        </div>
    
                        <!-- Content Section -->
                        <div class="space-y-6">
                            <!-- Header -->
                            <div class="space-y-4">
                                <h2 class="text-3xl font-bold text-gray-800 leading-tight hover:text-gray-600 transition-colors duration-300">
                                    {{ $reports->title }}
                                </h2>
                                <div class="flex items-center gap-4">
                                    <div class="h-12 w-12 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center text-white font-semibold text-lg shadow-lg">
                                        {{ strtoupper(substr($reports->user->email, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">Created by</p>
                                        <p class="text-gray-800 font-semibold">{{ $reports->user->email }}</p>
                                    </div>
                                </div>
                            </div>
    
                            <!-- Description -->
                            <div class="prose prose-gray max-w-none">
                                <p class="text-gray-600 leading-relaxed truncate">
                                    {{ $reports->description }}
                                </p>
                            </div>
    
                            <!-- Tags -->
                            <div class="flex flex-wrap gap-2 pt-4 border-t border-gray-100">
                                <span class="px-4 py-1.5 bg-blue-50 text-blue-600 rounded-full text-sm font-medium hover:bg-blue-100 transition-colors duration-200">
                                    {{ $reports->type }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Timeline Section -->
            <div class="lg:w-2/5 bg-white rounded-3xl shadow-xl p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-6 px-4">Activity Timeline</h3>
                <div class="space-y-1 overflow-y-auto h-96">
                    {{-- @foreach ($responseProgress as $response)
                        {{ $response->response_status }}
                    @endforeach --}}
                    <!-- Timeline Items -->
                    <div class="flex gap-x-3">
                        <div class="w-16 text-end">
                            <span class="text-xs font-medium text-gray-500">20 Desember 2024</span>
                        </div>
                        <div class="relative last:after:hidden after:absolute after:top-7 after:bottom-0 after:start-3.5 after:w-px after:-translate-x-[0.5px] after:bg-gray-200">
                            <div class="relative z-10 w-7 h-7 flex justify-center items-center">
                                <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                            </div>
                        </div>
                        <div class="grow pt-0.5 pb-8">
                            <h4 class="flex gap-x-1.5 font-semibold text-gray-800">
                                <svg class="shrink-0 w-4 h-4 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                </svg>
                                Updated Progress
                            </h4>
                            <p class="mt-1 text-sm text-gray-600">
                                tes
                            </p>
                        </div>
                    </div>
    
                    <!-- Repeat similar structure for other timeline items -->
            </div>

            <div class="flex justify-end mt-10 gap-3">
                <button type="button"  aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-basic-modal" data-hs-overlay="#hs-basic-modal" class="py-3 px-4 inline-flex items-center justify-end gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 focus:outline-none focus:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
                    <i class="ph ph-check text-lg"></i> nyatakan selesai
                </button>
                <button type="button" onclick="responseProgres({{ $reports->response->id }})" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-basic-modal" data-hs-overlay="#hs-basic-modal" class="py-3 px-4 inline-flex items-center justify-end gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                    <i class="ph ph-plus text-lg"></i> tambah
                </button>
            </div>
        </div>
        




    {{-- Modal --}}

    <div id="hs-basic-modal" class="hs-overlay hs-overlay-open:opacity-100 hs-overlay-open:duration-500 hidden size-full fixed top-0 start-0 z-[80] opacity-0 overflow-x-hidden transition-all overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-basic-modal-label">
        <div class="sm:max-w-lg sm:w-full m-3 sm:mx-auto">
          <div class="flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
            <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
              <h3 id="hs-basic-modal-label" class="font-bold text-gray-800 dark:text-white">
                Tambah Progress
              </h3>
              <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" aria-label="Close" data-hs-overlay="#hs-basic-modal">
                <span class="sr-only">Close</span>
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M18 6 6 18"></path>
                  <path d="m6 6 12 12"></path>
                </svg>
              </button>
            </div>
            <form action="" id="response_progres_form" method="post">
                @csrf
                <div class="p-4 overflow-y-auto">
                    <label for="followUp" class="mb-4 block text-sm font-medium dark:text-gray-300">Tanggapan<span
                            class="text-red-500">*</span></label>
                    <textarea id="followUp" name="followUp" required
                        class="py-3 px-4 w-full border border-gray-600 rounded-lg text-sm focus:border-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-50 dark:bg-gray-700 dark:text-gray-200"
                        rows="4" placeholder="Ketikkan progres saat ini..."></textarea>
                </div>
                <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t dark:border-neutral-700">
                    <button type="button"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                        data-hs-overlay="#response_progres">
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
      </div>


<script>
    function responseProgres(id) {
        let url = "{{ route('staff.store', ':id') }}";
        url = url.replace(':id', id);
        let form = document.getElementById('response_progres_form');
        form.setAttribute('action', url);
    }
</script>
@endsection
