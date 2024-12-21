@extends('layouts.layout')

@section('title') Article @endsection

@section('content')

<div class="col-start-2 w-full px-5 py-3 rounded-full flex justify-between items-center text-black mb-10">

  <div class="flex justify-between w-full items-center gap-5">
    <blockquote class="relative">
      <i class="ph-bold ph-quotes text-3xl"></i>
      <div class="relative z-10">
        <p class="text-gray-800 font-semibold text-2xl sm:text-xl"><em>
            Suara anda, Solusi kami.👍
          </em></p>
      </div>
    </blockquote>
    <div class="hs-tooltip flex justify-center items-center">
      <p class="w-full">Peraturan</p>
      <button type="button" class="group w-14 hover:bg-red-800 shadow-lg hover:border hover:border-white duration-300 hs-tooltip-toggle size-10 inline-flex justify-center items-center gap-2 rounded-full bg-red-600  text-gray-600  hover:border-blu-600 focus:outline-none focus:bg-blue-50 focus:bogray-50lue-200 focus:text-blue-600 " aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-vertically-centered-modal" data-hs-overlay="#hs-vertically-centered-modal">
        <i class="ph ph-warning-circle text-2xl  text-white"></i>
        <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity font-bold inline-block absolute invisible z-10 py-2 px-4 bg-gray-900 text-xs text-white rounded shadow-sm" role="tooltip">
          PERATURAN !
        </span>
      </button>
    </div>
  </div>
</div>

@if (Session::get('success'))
      <div class="m-5 bg-teal-500 text-md w-full text-white rounded-lg p-4" role="alert" tabindex="-1" aria-labelledby="hs-solid-color-success-label">
          <span id="hs-solid-color-success-label " class="font-bold flex justify-start items-center"><i class="ph ph-check-circle text-2xl"></i> {{ Session::get('success') }} Selamat Datang {{  Auth::user()->role }}</span> 
      </div>
@endif

<form action="{{ route('report.search') }}" method="get">
  @csrf
  <div class="flex justify-end items-center gap-5 mb-10">
    <select id="search-provinsi" name="search_provinsi" class="py-3 px-4 pe-9 shadow-md block w-2/6 border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none ">
      <option selected="">Tekan ini Untuk melihat Provinsi</option>
    </select>
    <button type="submit" name="search_btn" class=" shadow-md py-3 px-5 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
      Search
    </button>
  </div>
</form>

{{-- Hasil --}}
<div class="container grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mx-auto px-6 sm:px-8 lg:px-12 py-10">
  @if (count($reports) == 0)
      <div class="flex justify-center items-center w-full">
          <span class="text-2xl font-bold text-gray-700">Tidak ada Pengaduan</span>
      </div>
  @else
      @foreach ($reports as $index => $value)
      <a href="{{ route('report.detail', $value->id) }}" title="{{ $value->description }}">
        <div>
            <div class="border backdrop-blur-2xl  bg-opacity-10 shadow-md bg-white hover:bg-gradient-to-tr hover:from-gray-100 hover:to-white border-gray-200 rounded-xl overflow-hidden transition-shadow duration-300 hover:shadow-xl">
              <div class="relative w-full h-72">
                  <img class="absolute top-0 left-0 w-full h-full object-cover rounded-t-xl" src="{{ asset('storage/' . $value->image) }}" alt="Card Image">
                </div>
                <div class="p-6 flex flex-col gap-4">
                    <div class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-lg text-sm font-medium bg-blue-100 text-blue-800 shadow-md">
                      #{{ $value->type }}
                    </div>
                  <h1 class="text-xl font-semibold text-gray-800 truncate">
                      {{ $value->title }}
                  </h1>
                  <h3 class="text-md mb-5 text-gray-500 truncate">
                      {{ $value->description }}
                  </h3>
                  <div class="flex items-center justify-between text-gray-600 text-sm">
                      <div class="flex items-center gap-0.5">
                        By <i class="ph ph-at"></i>
                        {{ $value->user->email }}
                      </div>
                      <p class="text-xs text-gray-500">{{ $value->created_at->diffForHumans() }}</p>
                  </div>
                  <div class="flex items-center gap-4 text-gray-500 text-sm">
                      <div class="flex items-center gap-1">
                        <i class="ph ph-eye"></i>
                          {{ $value->viewers }} Views
                      </div>
                      <div class="flex items-center gap-1">
                        <i class="ph ph-chat-centered-dots"></i>
                          {{ $value->comments->count('comment_id') }} Comments
                      </div>
                      <div class="flex items-center gap-1">
                        <form action="{{ route('report.vote', $value->id) }}" id="voting_form_{{ $value->id }}" method="post">
                          @csrf
                          <label class="relative block cursor-pointer select-none">
                              <input type="checkbox" id="voting_{{ $value->id }}" name="vote"
                                  class="absolute opacity-0 h-0 w-0 peer"
                                  @if (in_array(auth()->user()->id, $value->voting)) checked @endif />

                              <svg id="Layer_1" version="1.0" viewBox="0 0 24 24"
                                  xmlns="http://www.w3.org/2000/svg"
                                  class="relative h-[25px] w-[25px] fill-gray-500 transition-transform duration-300 peer-hover:scale-110 peer-checked:fill-[#E3474F]">
                                  <path
                                      d="M16.4,4C14.6,4,13,4.9,12,6.3C11,4.9,9.4,4,7.6,4C4.5,4,2,6.5,2,9.6C2,14,12,22,12,22s10-8,10-12.4C22,6.5,19.5,4,16.4,4z">
                                  </path>
                              </svg>
                          </label>
                      </form>

                      <!-- Like Count -->
                      <p>{{ is_array($value->voting) ? count($value->voting) : 0 }}</p>
                      </div>
                      {{-- <a href="{{ route('report.vote', $value->id) }}" class="flex items-center gap-1">
                        <i class="ph ph-heart"></i>
                        {{ dd($value->votes) }}
                          {{ $value->votes }} Votes
                      </a> --}}
                  </div>
              </div>
          </div>
        </div>
      </a>
      @endforeach
  @endif

</div>

{{-- #### --}}
{{-- Modal --}}
<div id="hs-vertically-centered-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-vertically-centered-modal-label">
  <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
    <div class="w-full flex flex-col bg-white shadow-xl  border rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 ">
      <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
        <div id="hs-vertically-centered-modal-label" class="flex justify-center items-center gap-3 font-bold text-gray-800 dark:text-white">
          <i class="ph ph-warning-circle text-2xl text-red-600 bg-white rounded-full "></i> <strong>Informasi Pembuatan Pengaduan</strong>
        </div>
        <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" aria-label="Close" data-hs-overlay="#hs-vertically-centered-modal">
          <span class="sr-only">Close</span>
          <i class="ph ph-x text-lg"></i>
        </button>
      </div>
      <div class="p-4 overflow-y-auto">
          <ol  class="text-gray-800 text-lg dark:text-neutral-200 list-decimal list-inside">
              <li>pengaduan bisa dibuat hanya jika Anda telah membuat akun sebelumnya</li>
              <li>Keseluruhan data pada pengaduan bernilai <strong>Benar dan DAPAT DIPERTANGGUNG JAWABKAN</strong></li>
              <li>Seluruh bagian data perlu diisi</li>
              <li>Pengaduan Anda akan ditanggapi alam 2x24 jam</li>
              <li>Periksa tanggapan kami, pada <strong>Dasboard</strong> setelah Anda <strong>Login</strong></li>
              <li>Pembuatan Pengaduan dapat dilakukan pada halaman berikut : <a href="{{ route('report.create') }}" class="text-blue-400">ikuti tautan ini</a></li>
          </ol>
      </div>
      <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t dark:border-neutral-700">
        <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-hs-overlay="#hs-vertically-centered-modal">
          Close
        </button>
      </div>
    </div>
  </div>
</div>

<script>
  $('input[type="checkbox"]').on('change', function() {
      // Mendapatkan report_id dari id checkbox
      var reportId = $(this).attr('id').split('_')[1];

      // Men-submit form terkait dengan reportId tersebut
      $('#voting_form_' + reportId).submit();
});
</script>

<script src="{{ asset('js/api-dashboard.js') }}"></script>

@endsection