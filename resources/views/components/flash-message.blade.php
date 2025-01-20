@if(session('success'))
  <!-- Success Message -->
  <div x-data="{ show: true }" x-init="setTimeout(() => show =false, 2000)" x-show= "show" class="fixed top-0 bg-laravel transform -translate-x-[50%] left-1/2 text-white px-48 py-3">

      <!-- Success Icon -->
      <i class="fas fa-check"></i>

      <!-- Success Message -->
      <span class="ml-2">{{ session('success') }}</span>
  </div>
    {{-- <p class="message flex items-center justify-center text-xl text-center pb-5" >{{ session('success') }}</p> --}}
@endif