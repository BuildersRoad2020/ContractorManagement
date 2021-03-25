<div class="shadow rounded p-4 border bg-white flex-1" style="height: 32rem;">
    <livewire:livewire-column-chart key="{{ $columnChartModel->reactiveKey() }}" :column-chart-model="$columnChartModel"  wire:poll.500ms/>
</div>