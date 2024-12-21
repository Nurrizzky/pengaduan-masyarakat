@extends('layouts.layout')

@section('title') Head Staff @endsection

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

<div class="container">
  <div class="max-w-lg space-y-3">
    <form action=" {{ route('head.store') }}" method="POST">
      @csrf
      @if (Session::get('failed'))
        <h1>{{ Session::get('failed') }}</h1>
      @endif
      @if (Session::get('success'))
        <h1>{{ Session::get('success') }}</h1>
      @endif
      <label for="email" class="block text-sm font-medium mb-2 ">Email address</label>
      <div class="relative">
        <input type="text" id="email" name="email" class="py-3 px-4 ps-11 block w-full border border-gray-300 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none " placeholder="you@site.com">
        <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
          <svg class="shrink-0 size-4 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect width="20" height="16" x="2" y="4" rx="2"></rect>
            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
          </svg>
        </div>
      </div>
      <div>
        <label for="password" class="block text-sm font-medium mb-2 mt-3">Password</label>
        <div class="relative">
          <input type="text" id="password" name="password" class="py-3 px-4 ps-11 block w-full border border-gray-300 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none " placeholder="you@site.com">
          <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
            <svg class="shrink-0 size-4 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect width="20" height="16" x="2" y="4" rx="2"></rect>
              <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
            </svg>
          </div>
        </div>
    </div>
    <button type="submit" class="mt-10 font-poppins w-2/6 mx-auto px-3 py-2  items-center gap-x-2 text-sm font-medium rounded-lg border border-blue-500 bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:bg-blue-700 duration-150 disabled:opacity-50 disabled:pointer-events-none">
      buat akun
    </button>
  </form>
</div>

<div class="container mt-10">
  <div class="flex flex-col">
    <div class="-m-1.5 overflow-x-auto">
      <div class="p-1.5 min-w-full inline-block align-middle">
        <h1 class="mb-5 text-md font-semibold">DATA AKUN STAFF</h1>
        <div class="border rounded-lg overflow-hidden ">
          <table class="min-w-full divide-y divide-gray-200 ">
            <thead>
              <tr>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Name</th>
                <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Action</th>
              </tr>
            </thead>
            
            <tbody class="divide-y divide-gray-200 ">
              @foreach ($usersStaff as $user)
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 ">{{ $user->email }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                  {{-- {{ dd($user->id) }} --}}
                  <form action="{{ route('head.reset', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="inline-flex items-center gap-x-2 text-md font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none">Reset</button>
                  </form>
                  <form action="{{ route('head.delete', $user->id) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="inline-flex items-center gap-x-2 text-md font-semibold rounded-lg border border-transparent text-red-600 hover:text-red-800 focus:outline-none focus:text-red-800 disabled:opacity-50 disabled:pointer-events-none">Delete</button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection