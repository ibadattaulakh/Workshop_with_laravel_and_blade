@if(session('success'))
  <div class="bg-green-500 text-white px-4 py-2 rounded mb-4" dusk="flash-success">
    {{ session('success') }}
  </div>
@endif

@if(session('error'))
  <div class="bg-red-500 text-white px-4 py-2 rounded mb-4" dusk="flash-error">
    {{ session('error') }}
  </div>
@endif

