@extends('layouts.layout')

@section('title') Buat laporan @endsection

@section('content')

<h1 class="text-4xl text-center mb-20 mt-3 flex justify-center items-center font-semibold">
    <i class="ph ph-chat-circle-text"></i> 
    Buat Pengaduan.
</h1>

{{-- File akan diambil melalui request enctype --}}
<form action="{{ route('report.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    @if (Session::get('failed'))
        <p class="text-md text-red-600 font-semibold mt-2">*{{ Session::get('failed') }}</p>
    @endif

    {{-- {{$errors}} --}}
    <div class="flex gap-4 justify-center mx-auto w-full">
        <div class="w-full flex flex-col gap-3">
            <label for="province">Provinsi</label>
            <select name="province" id="province" class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none "></select>
            @error('province')
                <p class="text-sm text-red-600 font-semibold mt-2">*{{ $message }}</p>
            @enderror
        </div>

        <div class="w-full flex flex-col gap-3">
            <label for="regency">Kota / kabupaten</label>
            <select name="regency" id="regency" class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none ">
                <option value="" disable selected  hidden >Pilih Jika provinsi sudah di pilih !</option>
            </select>
            @error('regency')
                <p class="text-sm text-red-600 font-semibold mt-2">*{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="flex gap-4 justify-center mx-auto w-full">
        <div class="w-full flex flex-col gap-3">
            <label class="mt-3" for="subdistrict">Kecamatan</label>
            <select name="subdistrict" id="subdistrict" class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none ">
                <option value="" disable selected  hidden >Pilih Jika kota / kabupaten sudah di pilih !</option>
            </select>
            @error('subdistrict')
                <p class="text-sm text-red-600 font-semibold mt-2">*{{ $message }}</p>
            @enderror
        </div>

        <div class="w-full flex flex-col gap-3">
            <label class="mt-3" for="village">Kelurahan</label>
            <select name="village" id="village" class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none ">
                <option value="" disable selected  hidden >Pilih Jika kecamatan sudah di pilih !</option>
            </select>
            @error('village')
                <p class="text-sm text-red-600 font-semibold mt-2">*{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="flex-col">
        <div class="w-full flex flex-col gap-3">
            <label class="mt-3" for="type">type</label>
            <select name="type" id="type" class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none ">
                <option value="" disabled hidden selected >Pilih Tipe</option>
                <option value="kejahatan" {{  old('type') == 'kejahatan' ? 'selected' : ''}}>Kejahatan</option>
                <option value="pembangunan" {{  old('type') == 'pembangunan' ? 'selected' : ''}}>Pembangunan</option>
                <option value="sosial" {{  old('type') == 'sosial' ? 'selected' : ''}}>Sosial</option>
            </select>
            @error('type')
                <p class="text-sm text-red-600 font-semibold mt-2">*{{ $message }}</p>
            @enderror
        </div>

        <div class="w-full flex flex-col gap-3 mt-4">
            <label for="title" class="block text-sm font-medium">Judul</label>
            <input type="text" name="title" id="title" class=" border py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none " placeholder="Masukan judul laporan">
        </div>
    
        <div class="w-full flex flex-col gap-3">
            <label class="mt-3" for="description" class="block text-sm font-medium mb-2 ">Detail Keluhan</label>
            <textarea id="description" name="description" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none " rows="3" placeholder="Tambahkan detail keluhan disini..." data-hs-textarea-auto-height=""></textarea>
            @error('description')
                <p class="text-sm text-red-600 font-semibold mt-2">*{{ $message }}</p>
            @enderror
        </div>
    
        <div class="flex flex-col my-7 gap-5">
            <label for="image">gambar pendukung</label>
            <div class="max-w-sm">
                <form>
                  <label class="block">
                    <span class="sr-only">Choose profile photo</span>
                    <input type="file" name="image" id="image" class="block w-full text-sm text-gray-500 file:me-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 file:disabled:opacity-50 file:disabled:pointer-events-none">
                  </label>
                </form>
            </div>
            @error('image')
                <p class="text-sm text-red-600 font-semibold mt-2">*{{ $message }}</p>
            @enderror
        </div>

        <div class="my-10 flex w-full justify-between">
            <label for="statement" class="flex  p-3 {{ $errors->has('statement') ? 'w-2/4' : 'w-1/4 ' }} items-center bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 ">
                <input type="checkbox" value="1" id="statement" name="statement" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none " id="hs-checkbox-in-form">
                <span class="text-sm text-gray-500 ms-3 dark:text-neutral-400">Laporan yang disampaikan sesuai dengan kebenaran</span>
                @error('statement')
                    <p class="text-sm text-red-600 font-semibold ml-3">* {{ $message }}</p>
                @enderror
            </label>
            <button type="submit" class="flex justify-center items-center font-poppins text-md py-2 px-10  gap-x-2 font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                Buat Keluhan<i class="ph ph-paper-plane-tilt text-lg"></i>
            </button>
        </div>
    </div>
</form>

<script src="{{ asset('js/api-create.js') }}"></script>

@endsection