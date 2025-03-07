<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          {{-- __("You're logged in!") --}}
          <div class="card shadow-sm px-5 py-5" style="width:24rem;">
            <a href="{{ route('prospecto.show') }}" class="btn btn-primary d-inline-block">Ir a la Proforma</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
