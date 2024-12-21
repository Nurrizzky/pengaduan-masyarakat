@extends('layouts.layout')

@section('title') Detail Laporan  @endsection

@section('content')
    <div class="flex  gap-4">
        <div class="sticky h-full top-5 bg-gradient-to-br w-1/3 from-white to-gray-100 border border-gray-200 rounded-xl shadow-lg overflow-hidden transition hover:shadow-xl">
            <div class="relative w-full h-['400px']">
                <img class="top-0 left-0 w-full h-full object-cover bg-center rounded-t-xl" src="{{ asset('storage/' . $reports->image) }}" alt="Card Image">
                </div>
                <div class="p-6 flex flex-col gap-4">
                    <div class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-lg text-sm font-medium bg-blue-100 text-blue-800 ">
                    #{{ $reports->type }}
                    </div>
                    <h1 class="text-xl font-semibold text-gray-800 truncate">
                        {{ $reports->title }}
                    </h1>
                    <h3 class="text-md mb-5 text-gray-500 truncate">
                        {{ $reports->description }}
                    </h3>
                <div class="flex items-center justify-between text-gray-600 text-sm">
                    <div class="flex items-center gap-2">
                        <i class="ph ph-at"></i>
                        {{ $reports->user->email }}
                    </div>
                    <p class="text-xs text-gray-500">{{ $reports->created_at->diffForHumans() }}</p>
                </div>
                <div class="flex items-center gap-4 text-gray-500 text-sm">
                    <div class="flex items-center gap-1">
                        <i class="ph ph-eye"></i>
                        {{ $reports->viewers }} Views
                    </div>
                    <div class="flex items-center gap-1">
                        <i class="ph ph-chat-centered-dots"></i>
                        {{ $reports->comments->count('comment_id') }} Comments
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br w-2/3 p-5 from-white to-gray-100 border border-gray-200 rounded-xl shadow-lg overflow-hidden transition hover:shadow-xl">
            <h2 class="font-medium text-lg text-gray-800 mb-2">Komentar : </h2>
            <div class="max-h-[400px] overflow-y-auto
                        [&::-webkit-scrollbar]:w-2
                        [&::-webkit-scrollbar-track]:rounded-full
                        [&::-webkit-scrollbar-track]:bg-gray-100
                        [&::-webkit-scrollbar-thumb]:rounded-full
                        [&::-webkit-scrollbar-thumb]:bg-gray-300
                         bg-white border h-[400px] border-gray-200 shadow-sm rounded-xl p-4 space-y-3">
                <div class="space-y-1.5">
                    @foreach ($reports->comments as $index => $value)    
                    <ul class="space-y-5">
                        <li class="w-full flex gap-x-2 sm:gap-x-4 me-11">
                            <i class="ph-fill ph-user mt-1 h-fit text-xl rounded-xl"></i>
                            
                            <div class="bg-gray-100 relative border w-full border-gray-200 rounded-2xl p-4 space-y-3 ">
                                <h3 class="mb-2 -ml-3 -mt-2 px-3 py-1 text-sm w-full flex justify-between rounded-xl text-gray-600">
                                    <p>{{ $reports->user->email }}</p>
                                    <p>{{ $value->created_at->diffForHumans() }}</p>
                                </h3>
                                <div class="bg-white border w-full border-gray-200 rounded-2xl p-4 space-y-3">
                                    <h2 class="font-medium text-gray-800 ">
                                        {{ $value->comment }}
                                    </h2>  
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="mt-10 ">
                <h3 class="font-medium text-xl text-gray-800 ">Tambah Komentar</h3>
                <div class="mt-3">
                    <form action="{{ route('comment.create') }}" method="POST">
                        @csrf
                        <input type="hidden" name="reportId" value="{{ $reports->id }}">
                        <div class="flex items-center justify-center">
                            <i class="ph ph-user mt-1 h-fit text-2xl rounded-xl mr-3"></i>
                            <input name="comments" id="comment" class="py-3 px-4 block w-full border-gray-600 border my-10 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none " placeholder="Tambahkan Komentar disni...."></input>
                        </div>
                        <button type="submit" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                            Buat Komentar
                        </button>
                    </form>
                </div>
            </div>
            <!-- End Card -->
        </div>
    </div>

@endsection
