<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            @can('admin', App\Models\Users::class)
                <div>
                    <div class="container mx-auto space-y-4 p-4 sm:p-0 mt-8">
                        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                            <livewire:contractor-status-chart />
                            <livewire:contractor-rates-chart />
                        </div>
                    </div>
                </div>

                @livewireChartsScripts
                @endcan

                @can('vendor', App\Models\Users::class)

                <livewire:contractor-dashboard />
                <livewire:contractor-rates />
                @endcan
                @can('technician', App\Models\Users::class)
                <livewire:technician-dashboard />
                @endcan
            </div>
        </div>
    </div>
</x-app-layout>