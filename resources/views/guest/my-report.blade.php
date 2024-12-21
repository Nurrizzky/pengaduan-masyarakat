@extends('layouts.layout')

@section('title')
    Laporan saya
@endsection

@section('content')

    <header class="flex flex-wrap sm:justify-start sm:flex-nowrap mb-10 w-full bg-gray-300 rounded-full text-sm py-3">
        <nav class="max-w-[85rem] w-full mx-auto px-4 flex flex-wrap basis-full items-center justify-between">
            <a class="sm:order-1 flex-none text-xl font-semiboldfocus:outline-none focus:opacity-80">My Report</a>
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
        <div class="w-full mx-auto">
            <p class="text-xl text-green-600 mx-auto font-semibold mt-2"> - {{ Session::get('success') }} - </p>
        </div>
    @endif

    @if (Session::get('failed'))
        <div class="w-full mx-auto">
            <p class="text-xl text-red-600 mx-auto font-semibold mt-2"> - {{ Session::get('failed') }} - </p>
        </div>
    @endif

    @if (empty($cekReport))
        <div class="flex justify-center items-center w-full">
            <span class="text-2xl font-bold text-gray-700">Tidak ada Pengaduan</span>
        </div>
    @else
        <h3>Email : {{ Auth::user()->email }}</h3>
        @foreach ($cekReport as $index => $value)
            <div class="hs-accordion hs-accordion-active:border-gray-200 bg-white border my-3 rounded-xl"
                id="hs-active-bordered-heading-one">
                <button
                    class="hs-accordion-toggle hs-accordion-active:text-blue-600 inline-flex justify-between items-center gap-x-3 w-full font-semibold text-start text-gray-800 py-4 px-5 hover:text-gray-500 disabled:opacity-50 disabled:pointer-events-none "
                    aria-expanded="false" aria-controls="hs-basic-active-bordered-collapse-one">
                    {{ $value->created_at->diffForHumans() }}
                    <svg class="hs-accordion-active:hidden block size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14"></path>
                        <path d="M12 5v14"></path>
                    </svg>
                    <svg class="hs-accordion-active:block hidden size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14"></path>
                    </svg>
                </button>
                <div id="hs-basic-active-bordered-collapse-one"
                class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300"
                role="region" aria-labelledby="hs-active-bordered-heading-one">
                <div class="pb-4 px-5">
                    
                    <div id="bar-with-underline-1" role="tabpanel" aria-labelledby="bar-with-underline-item-1">
                        <div class="text-gray-500 py-5 flex justify-start items-start gap-5">
                            <img src="{{ asset('storage/' . $value->image) }}" alt="" class="w-1/4 rounded-md">
                            
                            <div class="w-full">
                                <div class=" flex justify-between items-center w-full">
                                    <h1 class="text-xl font-semibold text-gray-800">Judul : {{ $value->title }}</h1>
                                    <div
                                    class="my-3 bg-blue-500 w-fit flex justify-center items-center text-white text-sm tracking-wide px-3 py-1 rounded-full shadow-md">
                                    # {{ $value->type }} <br>
                                </div>
                            </div>
                            <h3 class="text-md text-gray-600 truncate w-1/2">
                                <strong>Deskripsi : </strong> {{ $value->description }}
                            </h3>
                            
                            <p class="lowercase">
                                <strong class="text-black">Lokasi :</strong>
                                {{ $value->province }} /
                                {{ $value->regency }} /
                                {{ $value->village }}
                            </p>
                            <div>
                                <strong class="text-black">Status :</strong>
                                @if ($value->response == null)
                                <p>BELUM ADA TANGGAPAN</p>
                                @else
                                @if ($value->response->response_status == 'REJECT')
                                <p
                                                    class="bg-red-300 w-fit px-3 py-1 rounded-full my-5 font-semibold text-black text-opacity-80 flex items-center justify-center">
                                                    <i class="ph ph-x text-xl mr-2 font-semibold"></i>{{ $value->response->response_status }}
                                                </p>
                                            @elseif ($value->response->response_status == 'ON_PROSESS')
                                                <p
                                                    class="bg-yellow-100 w-fit px-3 py-1 rounded-full my-5 font-semibold text-black text-opacity-80 flex items-center justify-center">
                                                    <i class="ph ph-arrows-clockwise text-xl mr-2 font-semibold"></i>{{ $value->response->response_status }}
                                                </p>
                                            @elseif ($value->response->response_status == 'DONE')
                                                <p
                                                    class="bg-green-300 shadow-md w-fit px-3 py-1 rounded-full my-5 font-semibold text-black text-opacity-80 flex items-center justify-center">
                                                    <i class="ph ph-check text-xl mr-2 font-semibold"></i>{{ $value->response->response_status }}
                                                </p>
                                            @else
                                                <p class="bg-gray-200 w-fit px-3 py-1 rounded-full my-5 font-semibold text-black text-opacity-80">
                                                   BELUM ADA TANGGAPAN
                                                </p>
                                            @endif
                                        @endif

                                    </div>
                                    <div>
                                        {{-- <form action="{{ route('report.delete', $value->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" value="{{ $value->id }}">
                                            <button type="submit" class="text-sm text-red-500 hover:text-red-400">
                                                <i class="ph ph-trash"></i> Hapus
                                            </button>
                                        </form> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif


@endsection
