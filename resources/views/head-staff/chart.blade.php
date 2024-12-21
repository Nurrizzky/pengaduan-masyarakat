@extends('layouts.layout')

@section('title') Chart Head Staff @endsection

@section('content')

    <header class="flex flex-wrap sm:justify-start sm:flex-nowrap mb-10 w-full bg-gray-300 rounded-full text-sm py-3">
        <nav class="max-w-[85rem] w-full mx-auto px-4 flex flex-wrap basis-full items-center justify-between">
        <a class="sm:order-1 flex-none text-xl font-semiboldfocus:outline-none focus:opacity-80">Kelola Akun Staff</a>
        <div class="sm:order-3 flex items-center gap-x-2">
            <a href="{{ route('logout') }}" class="duration-150 py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-white shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700  dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                <i class="ph ph-sign-out text-xl "></i>
                Logout
            </a>
        </div>
        </nav>
    </header>

@endsection


