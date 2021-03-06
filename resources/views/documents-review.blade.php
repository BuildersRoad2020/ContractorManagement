<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Review') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            @can('admin', App\Models\Users::class)
            <livewire:document-review />
            

            @endcan
            </div>
        </div>
        <div class="my-2"> </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <livewire:document-review-technician />

            </div>

        </div>
    </div>
</x-app-layout>
