<div class="shadow rounded p-4 border bg-white flex-1" style="height: 32rem;" wire:poll.5000ms>
    <livewire:livewire-pie-chart key="{{ $pieChartModel->reactiveKey() }}" :pie-chart-model="$pieChartModel" />
</div>